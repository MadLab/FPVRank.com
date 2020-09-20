<?php

namespace App\Http\Controllers;

use App\Event;
use App\Classes;
use App\Pilot;
use App\Result;
use App\Ranking;
use App\Glicko2Player;
use App\GlickoValue;
use App\Http\Requests\EventRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Requests\JSONRequest;
use Config;
use Illuminate\Http\Request;
use Storage;

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
        $default = GlickoValue::select('*')->get()->last();

        $noCompetePilots = []; //to save pilots the didnt compete in the event before ranking
        $competePilots = []; //to list pilots and rank them before ranking

        $insertData = []; ///to save rankings after the rank has been set

        $pilotsResults = []; ///to get the pilots that participate
        $pilotsNotInResults = []; ///to get the pilots that didnt participate

        $systemconstant = $default->systemconstant;  //Config::get('glickoValues.systemconstant');
        $volatility = $default->volatility; //Config::get('glickoValues.volatility');
        
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
        return redirect()->route('event.edit', ['id' => $eventId])->with('status', $message)->with('type', 'success');
    }

    /**
     * to rank all events again
     * 
     */
        /**
     * Do the rankings for the event
     * * @param  int  $eventId
     */
    private function rankAgain($eventId, $classId)
    {
        $default = GlickoValue::select('*')->get()->last();

        $noCompetePilots = []; //to save pilots the didnt compete in the event before ranking
        $competePilots = []; //to list pilots and rank them before ranking

        $insertData = []; ///to save rankings after the rank has been set

        $pilotsResults = []; ///to get the pilots that participate
        $pilotsNotInResults = []; ///to get the pilots that didnt participate

        $systemconstant = $default->systemconstant;  //Config::get('glickoValues.systemconstant');
        $volatility = $default->volatility; //Config::get('glickoValues.volatility');
        
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
        
        return true;
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
    public function update(EventUpdateRequest $request, $id)
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
            if ($request->photo != null) {
                Storage::disk('s3')->delete($event->imagePath);
                $a = Storage::disk('s3')->put('pilotPicture', $request->file('photo'));
                $event->imagePath = $a;
                $event->imageLocal = 1;
            }
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
            return redirect()->route('event.edit', ['id' => $event->eventId])->with('status', $message)->with('type', 'success');
        } else { ///if there is no row, return messsage error
            $message = 'Add atleast one result!';
            return back()->withInput()->with('status', $message)->with('type', 'danger');
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
                return back()->withInput()->with('status', $message)->with('type', 'danger');
            } else {
                $pilotData = []; //to store the pilots in the database
                $resultData = []; //to store the results in the database
                $eventData = [
                    'eventId' => isset($json['pilots'][0]['raceId']) && !empty($json['pilots'][0]['raceId']) ? $json['pilots'][0]['raceId'] : rand(1, 10000),
                    'name' => isset($json['raceName']) && !empty($json['raceName']) ? $json['raceName'] : 'null',
                    'location' => 'null',
                    'date' => isset($json['startDate']) && !empty($json['startDate']) ? $json['startDate'] : 'null',
                    'classId' => 1,
                    'imagePath' => isset($json['eventImage']) && !empty($json['eventImage']) ? $json['eventImage'] : 'null',
                    'imageLocal' => 0,
                ];
                $pilots = $this->pilot->all();

                $count = 1;

                foreach ($json['pilots'] as $key => $val) {
                    if ($pilots->contains('pilotId', $val['pilotId'])) {
                        $pi = $pilots->where('pilotId', $val['pilotId'])->first();
                        array_push($resultData, array(
                            'eventId' => $eventData['eventId'],
                            'pilotId' => $pi->pilotId,
                            'position' => $count,
                            'notes' => 'null',
                        ));
                    } else {
                        array_push($pilotData, array(
                            'pilotId' => $val['pilotId'],
                            'name' => $val['pilotFirstName'] . ' ' . $val['pilotLastName'],
                            'username' => $val['pilotUserName'],
                            'country' => isset($val['pilotCountry']) && !empty($val['pilotCountry']) ? $val['pilotCountry'] : 'null',
                            'imagePath' => isset($val['pilotProfilePictureUrl']) && !empty($val['pilotProfilePictureUrl']) ? $val['pilotProfilePictureUrl'] : 'null',
                            'imageLocal' => 0,
                            'created_at' => date("Y-m-d H:i:s"),
                        ));
                        array_push($resultData, array(
                            'eventId' => $eventData['eventId'],
                            'pilotId' => $val['pilotId'],
                            'position' => $count,
                            'notes' => 'null',
                        ));
                    }
                    $count++;
                }
                Pilot::insert($pilotData);
                $event = $this->event->create($eventData);
                Result::insert($resultData);
                $message = 'Event has been saved succesfully!';
                return redirect()->route('event.edit', ['id' => $event->eventId])->with('status', $message)->with('type', 'success');
            }
        } catch (\Throwable $th) {
            $message = 'ID must be unique or invalid JSON format, please enter a valid JSON URL!';
            return back()->withInput()->with('status', $message)->with('type', 'danger');
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
            $a = null;
            if ($request->file('photo') != null) {
                $a = Storage::disk('s3')->put('eventPicture', $request->file('photo'));
            }            
            $lastEvent = $this->event->select('eventId')->orderBy('eventId', 'asc')->get()->last();
            $nextEventId = $lastEvent == null ? 1 : $lastEvent->eventId + 1;
            $event = $this->event->create([
                'eventId' => $nextEventId,
                'name' => $request->name,
                'location' => $request->location,
                'date' => $request->date,
                'classId' => $request->classId,
                'imagePath' => $a
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
            return redirect()->route('event.edit', ['id' => $event->eventId])->with('status', $message)->with('type', 'success');
        } else { ///if there is no row, return messsage error
            $message = 'Add atleast one result!';
            return back()->withInput()->with('status', $message)->with('type', 'danger');
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
        if ($event->imageLocal == 1 && $event->imagePath != null) {
            $event->imagePath = Storage::disk('s3')->temporaryUrl(
                $event->imagePath,
                now()->addMinutes(1)
            );
        }
        return view('event.edit', [
            'pilots' => $pilots, 'results' => $results, 'event' => $event, 'classes' => $classes,
            'formCount' => count($results), 'count' => count($results)
        ]);
    }

    public function reRankEvents(){
        Ranking::truncate();
        $events = $this->event->all();
        
        foreach ($events as $key) {
            $key->dateRanked = null;
            $key->save();
            
            $va = $this->rankAgain($key->eventId, $key->classId);            
        }
                        
        $message = 'All events have been ranked succesfully!';
        return redirect()->route('event.index')->with('status', $message)->with('type', 'success');
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
