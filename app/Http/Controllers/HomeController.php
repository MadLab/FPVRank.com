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
        //$data = $this->pilot->all();

        $data = [
            
            [ 'pilotId' => 8, 'pilotFirstName' => 'Johnn', 'pilotLastName' => 'Solano' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 1, 'pilotFirstName' => 'Jose', 'pilotLastName' => 'Quinonez' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 4, 'pilotFirstName' => 'Robert', 'pilotLastName' => 'Gentel' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 2, 'pilotFirstName' => 'Ever', 'pilotLastName' => 'Rios' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 3, 'pilotFirstName' => 'Ricardo', 'pilotLastName' => 'Garcia' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 9, 'pilotFirstName' => 'Yoel', 'pilotLastName' => 'Zumbado' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 5, 'pilotFirstName' => 'Luis Diego', 'pilotLastName' => 'Cubero' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 10, 'pilotFirstName' => 'Juan Carlos', 'pilotLastName' => 'Cabezas' , 
            'pilotHandle' => 'null' ],  
            
                        
            [ 'pilotId' => 6, 'pilotFirstName' => 'Esteban', 'pilotLastName' => 'Carvajal' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 7, 'pilotFirstName' => 'Manuel', 'pilotLastName' => 'Solano' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 11, 'pilotFirstName' => 'Diego', 'pilotLastName' => 'Somarribas' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 12, 'pilotFirstName' => 'Arturo', 'pilotLastName' => 'Yong' , 
            'pilotHandle' => 'null' ],  
            [ 'pilotId' => 13, 'pilotFirstName' => 'Fernando', 'pilotLastName' => 'Borrase' , 
            'pilotHandle' => 'null' ],  
        ];                          
                        

        return response()->json($data, 200);
    }
    /**
     * get view with pilot
     */
    public function pilot($pilotId)
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
        return view('pilotinfo', [
            'pilot' => $pilot, 'resultsPilot' => $results,
            'info' => $info, 'type' => 'event'
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

        return view('event_public.index', ['eventId' => $eventId, 'events' => $events, 'results' => $results, 'event' =>  $event]);
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

        return view('event_public.index', ['events' => $events, 'results' => $results, 'event' =>  $event]);
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
