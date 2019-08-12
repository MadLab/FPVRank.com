<?php

namespace App\Http\Controllers;

use App\Event;
use App\Classes;
use App\Pilot;
use App\Result;
use App\Ranking;
use App\Glicko2Player;
use App\Http\Requests\EventRequest;
use Config;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $event;
    protected $class;
    protected $result;
    protected $pilot;
    protected $ranking;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->event = new Event();
        $this->class = new Classes();
        $this->result = new Result();
        $this->pilot = new Pilot();
        $this->ranking = new Ranking();
    }
    /**
     * Do the rankings for the event
     * * @param  int  $eventId
     */
    public function rank($eventId, $classId)
    {
        $noCompetePilots = []; //to save pilots the didnt compete in the event before ranking
        $competePilots = []; //to list pilots and rank them before ranking

        $insertData = []; ///to save rankings after the rank has been set

        $pilotsResults = []; ///to get the pilots that participate
        $pilotsNotInResults = []; ///to get the pilots that didnt participate

        $systemconstant = Config::get('glickoValues.systemconstant');
        $volatility = Config::get('glickoValues.volatility');

        $results = $this->result->byEventId($eventId);
        foreach ($results as $val) {
            array_push($pilotsResults, $val->pilotId);
        }
        $pilotsInclassNoCompete = $this->result->getNoCompetePilots($eventId, $classId, $pilotsResults);
        foreach ($pilotsInclassNoCompete as $val) {
            array_push($pilotsNotInResults, $val->pilotId);
        }
        $rankingCompete = $this->ranking->getCurrentRanking($classId, $pilotsResults);
        $rankingNoCompete = $this->ranking->getCurrentRanking($classId, $pilotsNotInResults);

        foreach ($results as $result) {
            if (count($rankingCompete) == 0) {
                array_push($competePilots, [
                    'oldRankingId' => null, 'pilotId' => $result->pilotId,
                    'position' => $result->position,
                    'glicko' => new Glicko2Player()
                ]);
            } else {
                if ($rankingCompete->contains('pilotId', $result->pilotId)) {
                    $val = $rankingCompete->where('pilotId', $result->pilotId)->first();
                    array_push($competePilots, [
                        'oldRankingId' => null, 'pilotId' => $result->pilotId,
                        'position' => $result->position,
                        'glicko' => new Glicko2Player(
                            $val->rating,
                            $val->rd,
                            $volatility,
                            $val->mu,
                            $val->phi,
                            $val->sigma,
                            $systemconstant
                        )
                    ]);
                    $val->current = 0;
                    $val->save();
                } else {
                    array_push($competePilots, [
                        'oldRankingId' => null, 'pilotId' => $result->pilotId,
                        'position' => $result->position,
                        'glicko' => new Glicko2Player()
                    ]);
                }
            }
        }
        foreach ($rankingNoCompete as $val) {
            array_push($noCompetePilots, [
                'oldRankingId' => 'null', 'pilotId' => $val->pilotId,
                'position' => 0,
                'glicko' => new Glicko2Player(
                    $val->rating,
                    $val->rd,
                    $volatility,
                    $val->mu,
                    $val->phi,
                    $val->sigma,
                    $systemconstant
                )
            ]);
            $val->current = 0;
            $val->save();
        }
        for ($i = 0; $i < count($competePilots); $i++) {
            for ($a = 0; $a < count($competePilots); $a++) {
                if ($competePilots[$i]['pilotId'] != $competePilots[$a]['pilotId']) {
                    if ($competePilots[$i]['position'] < $competePilots[$a]['position']) {
                        $competePilots[$i]['glicko']->AddWin($competePilots[$a]['glicko']);
                    } elseif ($competePilots[$i]['position'] > $competePilots[$a]['position']) {
                        $competePilots[$i]['glicko']->AddLoss($competePilots[$a]['glicko']);
                    }
                }
            }
        }
        for ($i = 0; $i < count($competePilots); $i++) {
            $competePilots[$i]['glicko']->update();
        }
        for ($i = 0; $i < count($noCompetePilots); $i++) {
            $noCompetePilots[$i]['glicko']->update();
        }
        foreach ($competePilots as $val) {
            array_push($insertData, array(
                'pilotId' => $val['pilotId'], 'eventId' => $eventId,
                'classId' => $classId, 'rating' => $val['glicko']->rating,
                'mu' => $val['glicko']->mu, 'rd' => $val['glicko']->rd, 'sigma' => $val['glicko']->sigma,
                'phi' => $val['glicko']->phi, 'created_at' => date("Y-m-d H:i:s")
            ));
        }
        foreach ($noCompetePilots as $val) {
            array_push($insertData, array(
                'pilotId' => $val['pilotId'], 'eventId' => $eventId,
                'classId' => $classId, 'rating' => $val['glicko']->rating,
                'mu' => $val['glicko']->mu, 'rd' => $val['glicko']->rd, 'sigma' => $val['glicko']->sigma,
                'phi' => $val['glicko']->phi, 'created_at' => date("Y-m-d H:i:s")
            ));
        }
        Ranking::insert($insertData);
        $eve = $this->event->findOrFail($eventId);
        $eve->dateRanked = date("Y-m-d H:i:s");
        $eve->save();

        $message = 'Event has been ranked succesfully!';
        return redirect()->route('event.edit', ['id' => $eventId])->with('statusSuccess', $message);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $event = $this->event->getList();
        return view('event.index', ['events' => $event]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = $this->class->fillSelect();
        return view('event.create', ['classes' => $classes]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        //to validate if there is atleast one row of results
        $count = 0;
        foreach ($request->pilotId as $key) {
            if ($key != 'null') {
                $count++;
            }
        }
        ///if there is a row insert the data
        if ($count != 0) {
            $event = $this->event->findOrFail($id);
            $event->name = $request->name;
            $event->location = $request->location;
            $event->date = $request->date;
            $event->classId = $request->classId;
            $event->save();

            for ($i = 0; $i < count($request->pilotId); $i++) {
                if ($request->pilotId[$i] != "null") {
                    if ($request->resultId[$i] != "null") {
                        $result = $this->result->findOrFail($request->resultId[$i]);
                        $result->pilotId = $request->pilotId[$i];
                        $result->position = $request->position[$i];
                        $result->notes = $request->notes[$i];
                        $result->save();
                    } else {
                        $this->result->create([
                            'eventId' => $event->eventId,
                            'pilotId' => $request->pilotId[$i],
                            'position' => $request->position[$i],
                            'notes' => $request->notes[$i],
                        ]);
                    }
                }
            }

            $message = 'Event has been updated succesfully!';
            return redirect()->route('event.edit', ['id' => $event->eventId])->with('statusSuccess', $message);
        } else { ///if there is no row, return messsage error
            $message = 'Add atleast one result!';
            return back()->withInput()->with('statusDanger', $message);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        //to validate if there is atleast one row of results
        $count = 0;
        foreach ($request->pilotId as $key) {
            if ($key != 'null') {
                $count++;
            }
        }
        ///if there is a row insert the data
        if ($count != 0) {
            $event = $this->event->create([
                'name' => $request->name,
                'location' => $request->location,
                'date' => $request->date,
                'classId' => $request->classId,

            ]);
            for ($i = 0; $i < count($request->pilotId); $i++) {
                if ($request->pilotId[$i] != "null") { }
            }
            $message = 'Event has been saved succesfully!';
            return redirect()->route('event.edit', ['id' => $event->eventId])->with('statusSuccess', $message);
        } else { ///if there is no row, return messsage error
            $jsonString = file_get_contents($request->jsonfile);
            $json = json_decode($jsonString, true);
            $pilots = $this->pilot->all();
            $event = $this->event->create([
                'name' => $request->name,
                'location' => $request->location,
                'date' => $request->date,
                'classId' => $request->classId,

            ]);
            $count = 1;
            foreach ($json as $key => $val) {
                if ($pilots->contains('name', $val['pilotUserName'])) {
                    $pi = $pilots->where('name', $val['pilotUserName'])->first();
                    $this->result->create([
                        'eventId' => $event->eventId,
                        'pilotId' => $pi->pilotId,
                        'position' => $count,
                        'notes' => 'notes',
                    ]);
                } else {
                    $pilot = $this->pilot->create([
                        'name' => $val['pilotUserName'],
                        'username' => 'username'
                    ]);
                    $this->result->create([
                        'eventId' => $event->eventId,
                        'pilotId' => $pilot->pilotId,
                        'position' => $count,
                        'notes' => 'notes',
                    ]);
                }
                $count++;
            }
            $message = 'Add atleast one result!(json saved) testing purposes';
            return back()->withInput()->with('statusDanger', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $text
     * @return \Illuminate\Http\Response
     */
    public function show($text)
    {
        $events = $this->event->search($text);
        return response()->view('event._eventtable', ['events' => $events], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->event->findOrFail($id);
        $classes = $this->class->fillSelect();
        $results = $this->result->byEventId($event->eventId);
        $pilots = $this->pilot->fillSelect();        
        return view('event.edit', [
            'pilots' => $pilots, 'results' => $results, 'event' => $event, 'classes' => $classes,
            'formCount' => count($results), 'count' => count($results)
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
