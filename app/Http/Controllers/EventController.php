<?php

namespace App\Http\Controllers;

use App\Event;
use App\Classes;
use App\Pilot;
use App\Result;
use App\Ranking;
use App\Glicko2Player;
use App\Http\Requests\EventRequest;
use App\Http\Requests\JSONRequest;
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

        $pilots = $this->pilot->all(); ///to get the pilot info

        $results = $this->result->byEventId($eventId);
        foreach ($results as $val) {
            array_push($pilotsResults, $val->pilotId); //to get the pilots that did compete
        }
        //get the pilots that have competed in the same class but not this event
        $pilotsInclassNoCompete = $this->result->getNoCompetePilots($eventId, $classId, $pilotsResults);
        foreach ($pilotsInclassNoCompete as $val) {
            array_push($pilotsNotInResults, $val->pilotId);
        }
        //get the current rankings for both group of pilots
        $rankingCompete = $this->ranking->getCurrentRanking($classId, $pilotsResults);
        $rankingNoCompete = $this->ranking->getCurrentRanking($classId, $pilotsNotInResults);


        foreach ($results as $result) {
            if (count($rankingCompete) == 0) { //if rankings table is empty make all pilots new to competition
                array_push($competePilots, [
                    'totalraces' => 1, 'oldRankingId' => null, 'pilotId' => $result->pilotId,
                    'position' => $result->position,
                    'glicko' => new Glicko2Player()
                ]);
            } else {
                //search if the pilot has current ranking
                if ($rankingCompete->contains('pilotId', $result->pilotId)) {
                    $val = $rankingCompete->where('pilotId', $result->pilotId)->first();
                    array_push($competePilots, [
                        'totalraces' => $val->totalraces + 1, 'oldRankingId' => null, 'pilotId' => $result->pilotId,
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
                } else { //if the pilot doesnt have ranking it means new pilot
                    array_push($competePilots, [
                        'totalraces' => 1, 'oldRankingId' => null, 'pilotId' => $result->pilotId,
                        'position' => $result->position,
                        'glicko' => new Glicko2Player()
                    ]);
                }
            }
        }
        //get the current ranking for the pilots that didnt compete, to update their ranking
        foreach ($rankingNoCompete as $val) {
            array_push($noCompetePilots, [
                'totalraces' => $val->totalraces + 1, 'oldRankingId' => 'null', 'pilotId' => $val->pilotId,
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
        ////add win and loss for every pilot based in their position
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
        ///update ranking for the pilots in the event
        for ($i = 0; $i < count($competePilots); $i++) {
            $competePilots[$i]['glicko']->update();
        }
        //update ranking for the pilots that didnt go to the event
        for ($i = 0; $i < count($noCompetePilots); $i++) {
            $noCompetePilots[$i]['glicko']->update();
        }
        ///adding data to array to update database
        foreach ($competePilots as $val) {
            array_push($insertData, array(
                'totalraces' => $val['totalraces'], 'pilotId' => $val['pilotId'], 'country' => $pilots->where('pilotId', '=', $val['pilotId'])->first()->country, 'eventId' => $eventId,
                'classId' => $classId, 'rating' => $val['glicko']->rating,
                'mu' => $val['glicko']->mu, 'rd' => $val['glicko']->rd, 'sigma' => $val['glicko']->sigma,
                'phi' => $val['glicko']->phi, 'created_at' => date("Y-m-d H:i:s")
            ));
        }
        foreach ($noCompetePilots as $val) {
            array_push($insertData, array(
                'totalraces' => $val['totalraces'], 'pilotId' => $val['pilotId'], 'country' => $pilots->where('pilotId', '=', $val['pilotId'])->first()->country, 'eventId' => $eventId,
                'classId' => $classId, 'rating' => $val['glicko']->rating,
                'mu' => $val['glicko']->mu, 'rd' => $val['glicko']->rd, 'sigma' => $val['glicko']->sigma,
                'phi' => $val['glicko']->phi, 'created_at' => date("Y-m-d H:i:s")
            ));
        }
        //updating database with the new current ranking
        Ranking::insert($insertData);

        ///set the event as "Ranked"
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
     * Store a newly created resource with JSON data
     * 
     * @return \Illuminate\Http\Response
     */
    public function storejson(JSONRequest $request)
    {
        try {
            $json = json_decode(file_get_contents($request->jsonurl), true);
            if ($json == null) {
                $message = 'Please enter a valid JSON URL!';
                return back()->withInput()->with('statusDanger', $message);
            } else {
                $pilotData = []; //to store tyhe pilots in the database
                $resultData = []; //to store the results in the database      
                $eventData = [
                    'eventId' => $json['id'],
                    'name' => $json['name'],
                    'location' => $json['address'] . ", " . $json['city'] . '. ' . $json['state'] . ' - ' . $json['country'],
                    'date' => $json['startDate'],
                    'classId' => 1,
                ];
                $pilots = $this->pilot->all();
                
                $count = 1;
                foreach ($json['raceEntries'] as $key => $val) {
                    if ($pilots->contains('pilotId', $val['pilotId'])) {
                        $pi = $pilots->where('pilotId', $val['pilotId'])->first();
                        array_push($resultData, array(
                            'eventId' => $json['id'],
                            'pilotId' => $pi->pilotId,
                            'position' => $count,
                            'notes' => null,
                        ));
                    } else {
                        array_push($pilotData, array(
                            'pilotId' => $val['pilotId'],
                            'name' => $val['pilotFirstName'] . ' ' . $val['pilotLastName'],
                            'username' => $val['pilotUserName'],
                            'country' => isset($val['pilotCountry']) ? $val['pilotCountry'] : 'CR',
                        ));

                        array_push($resultData, array(
                            'eventId' => $json['id'],
                            'pilotId' => $val['pilotId'],
                            'position' => $count,
                            'notes' => null,
                        ));
                    }
                    $count++;
                }
                $event = $this->event->create($eventData);
                Pilot::insert($pilotData);
                Result::insert($resultData);
                $message = 'Event have been saved succesfully!';
                return redirect()->route('event.edit', ['id' => $event->eventId])->with('statusSuccess', $message);
            }
        } catch (\Throwable $th) {
            $message = 'Please enter a valid JSON URL!';
            return back()->withInput()->with('statusDanger', $message);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EventRequest  $request
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
                if ($request->pilotId[$i] != "null") {
                    $this->result->create([
                        'eventId' => $event->eventId,
                        'pilotId' => $request->pilotId[$i],
                        'position' => $request->position[$i],
                        'notes' => $request->notes[$i],
                    ]);
                }
            }
            $message = 'Event has been saved succesfully!';
            return redirect()->route('event.edit', ['id' => $event->eventId])->with('statusSuccess', $message);
        } else { ///if there is no row, return messsage error            
            $message = 'Add atleast one result!';
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
