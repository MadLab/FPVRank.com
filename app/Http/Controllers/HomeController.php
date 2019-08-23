<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Ranking;
use App\Classes;
use App\Event;
use App\Pilot;
use App\Result;
use App\CountryList;
use App\Exports\RankingExport;
use Excel;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    protected $ranking;
    protected $class;
    protected $pilot;
    protected $event;
    protected $result;
    protected $country;
    protected $firstClassId; ///to get the first class and set the navigation
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ranking = new Ranking();
        $this->class = new Classes();
        $this->pilot = new Pilot();
        $this->event = new Event();
        $this->result = new Result();
        $this->country = new CountryList();
        $this->firstClassId = $this->class->all()->first()->classId;
    }
    public function json()
    {
        //$data = $this->class->all();
        //$data = $this->pilot->all();
        



        return response()->json("data", 200);
    }
    /**
     * get view with pilot
     */
    public function pilot($pilotId)
    {
        $pilot = $this->pilot->findOrFail($pilotId);
        $countries = $this->country->getData();
        $results = $this->result->select('results.*', 'events.name as eventName')->where('results.pilotId', '=', $pilotId)->join('events', 'events.eventId', '=', 'results.eventId')->get();
        $ranking = $this->ranking->where([['pilotId', '=', $pilotId], ['current', '=', 1]])->get();
        $info = [];
        foreach ($ranking as $value) {
            $rankinginfo = $this->ranking->getRankingByClass($value->classId)->toArray();
            $position = 1;
            for ($i = 0; $i < count($rankinginfo); $i++) {
                $rankinginfo[$i]['position'] = $position;
                $position++;
            }
            $data = collect($rankinginfo)->where('pilotId', '=', $pilotId)->first();
            array_push($info, $data);
        }
        return view('pilotinfo', [
            'pilot' => $pilot, 'resultsPilot' => $results,
            'info' => $info, 'type' => 'event',
            'countries' => $countries, 'firstClassId' => $this->firstClassId
        ]);
    }
    /**
     * return table view with the event
     */
    public function getEvent($eventId)
    {
        $events = $this->event->getEventsForPublic();
        $results = $this->result->fillNavs();
        $event = $this->event->searchById($eventId);
        $countries = $this->country->getData();

        return view('event_public.event', ['eventId' => $eventId, 'events' => $events, 'results' => $results, 'event' =>  $event,'countries' => $countries, 'firstClassId' => $this->firstClassId]);
    }
    /**
     * Search for events in public page
     */
    public function eventinfo($text, $date1, $date2)
    {
        if ($text == 'null' && $date1 == 'null' && $date2 == 'null') {
            $events = $this->event->getEventsForPublic();
        } else if ($text != 'null' && $date1 == 'null' && $date2 == 'null') {
            $events = $this->event->searchByNameOrClassName($text);
        } else if ($text != 'null' && $date1 != 'null' && $date2 != 'null') {
            $events = $this->event->searchByNameOrClassNameWithDate($text, $date1, $date2);
        } else if ($text == 'null' && $date1 != 'null' && $date2 != 'null') {
            $events = $this->event->searchBetweenDate($date1, $date2);
        }
        return response()->view('event_public._eventtable', ['events' => $events], 200);
    }
    /**
     * Show the event public view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function event()
    {
        $events = $this->event->getEventsForPublic();
        $results = $this->result->fillNavs();
        $event = $this->event->searchById(($events->first())->eventId);

        return view('event_public.index', ['events' => $events, 'results' => $results, 'event' =>  $event, ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $classes = $this->class->fillSelect();
        $countries = $this->country->getData();
        $rankings = $this->ranking->getRankingByClass($classes->first()->classId)->toArray();
        //to add positions
        $position = 1;
        for ($i = 0; $i < count($rankings); $i++) {
            $rankings[$i]['position'] = $position;
            $position++;
        }
        $data = $this->paginator($rankings, $request);


        return view('welcome', ['firstClassId' => $classes->first()->classId, 'classes' => $classes, 'rankings' => $data,'countries' => $countries]);
    }
    /**
     * Paginator for arrays
     * 
     * @return Collection $data
     */
    protected function paginator($array, $request)
    {
        //paginator for array   
        $page = isset($request->page) ? $request->page : 1; // Get the page=1 from the url
        $perPage = 100; // Number of items per page
        $offset = ($page * $perPage) - $perPage;
        $data =  new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url

        );

        return $data;
    }
    /**
     * Search ranking by pilots name, nickname or position
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchRankings(Request $request, $text, $classId)
    {
        $rankings = $this->ranking->getRankingByClass($classId)->toArray();
        $data = [];
        //to add positions
        $position = 1;
        for ($i = 0; $i < count($rankings); $i++) {
            $rankings[$i]['position'] = $position;
            $position++;
        }
        if (is_numeric($text)) {
            $data = collect($rankings)->where('position', $text)->toArray();
        } else if ($text == 'null') {
            $data = $rankings;
        } else {
            $search = $this->ranking->searchRankings($classId, $text)->toArray();
            for ($i = 0; $i < count($rankings); $i++) {
                for ($a = 0; $a < count($search); $a++) {
                    if ($rankings[$i]['pilotId'] == $search[$a]['pilotId']) {
                        array_push($data, $rankings[$i]);
                    }
                }
            }
        }
        $results = $this->paginator($data, $request);
        return response()->view('_rankingtable', ['rankings' => $results], 200);
    }
    /**
     * Search ranking by class and country
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchByClass(Request $request, $classId, $country)
    {
        $rankings = [];
        if($country == "all"){
            $rankings = $this->ranking->getRankingByClass($classId)->toArray();
        }else{
            $rankings = $this->ranking->getRankingByClassAndCountry($classId, $country)->toArray();
        }
        
        $countries = $this->country->getData();        
        //to add positions
        $position = 1;
        for ($i = 0; $i < count($rankings); $i++) {
            $rankings[$i]['position'] = $position;
            $position++;
        }
        $data = $this->paginator($rankings, $request);
        $classes = $this->class->fillSelect();
        return view('welcome', ['classes' => $classes, 'rankings' => $data, 
        'classId' => $classId,'selectedCountry' => $country ,'countries' => $countries, 'firstClassId' => $this->firstClassId]);
    }
    public function ranking()
    {
        return Excel::download(new RankingExport, 'rankings.xlsx');
        //return response()->json($rankings);
    }
}
