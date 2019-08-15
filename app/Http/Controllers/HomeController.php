<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Ranking;
use App\Classes;
use App\Event;
use App\Pilot;
use App\Result;
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
    }
    public function json()
    {
        //$data = $this->class->all();
        $data = $this->pilot->all();

        return response()->json($data, 200);
    }
    /**
     * Show view with the pilot info
     */
    public function pilotinfo($pilotId, $type)
    {
        $pilot = $this->pilot->findOrFail($pilotId);
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
        return response()->view('_pilotinfo', [
            'pilot' => $pilot, 'resultsPilot' => $results,
            'info' => $info, 'type' => $type
        ], 200);
    }
    /**
     * return table view with the event
     */
    public function getEvent($eventId){
        $event = $this->event->findOrFail($eventId);
        $results = $this->result->fillNavs();

        return response()->view('event_public._navscontent', ['type'=>'welcome', 'event' => $event, 'results' => $results], 200);
    }
    /**
     * Search for events in public page
     */
    public function eventinfo($text, $date1, $date2)
    {
        if ($text == 'null' && $date1 == 'null' && $date2 == 'null') {
            $eventsNavbar = $this->event->fillNavs();
        } else if ($text != 'null' && $date1 == 'null' && $date2 == 'null') {
            $eventsNavbar = $this->event->searchByNameOrClassName($text);
        } else if ($text != 'null' && $date1 != 'null' && $date2 != 'null') {            
            $eventsNavbar = $this->event->searchByNameOrClassNameWithDate($text,$date1,$date2);            
        }
        return response()->view('event_public._navbarcontent', ['events' => $eventsNavbar], 200);
    }
    /**
     * Show the event public view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function event()
    {
        $eventsNavbar = $this->event->fillNavs();
        $results = $this->result->fillNavs();

        return view('event_public.index', ['events' => $eventsNavbar, 'results' => $results ,'type' => 'event']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $classes = $this->class->fillSelect();
        $rankings = $this->ranking->getRankingByClass($classes->first()->classId)->toArray();
        //to add positions
        $position = 1;
        for ($i = 0; $i < count($rankings); $i++) {
            $rankings[$i]['position'] = $position;
            $position++;
        }
        $data = $this->paginator($rankings, $request);


        return view('welcome', ['classes' => $classes, 'rankings' => $data]);
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
     * Search ranking
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchByClass(Request $request, $classId)
    {
        $rankings = $this->ranking->getRankingByClass($classId)->toArray();
        //to add positions
        $position = 1;
        for ($i = 0; $i < count($rankings); $i++) {
            $rankings[$i]['position'] = $position;
            $position++;
        }
        $data = $this->paginator($rankings, $request);
        $classes = $this->class->fillSelect();
        return view('welcome', ['classes' => $classes, 'rankings' => $data, 'classId' => $classId]);
    }
    public function ranking()
    {
        return Excel::download(new RankingExport, 'rankings.xlsx');
        //return response()->json($rankings);
    }
}
