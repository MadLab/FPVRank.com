<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ranking;
use App\Classes;
use App\Exports\RankingExport;
use Excel;

class HomeController extends Controller
{
    protected $ranking;
    protected $class;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->ranking = new Ranking();
        $this->class = new Classes();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $classes = $this->class->fillSelect();
        $rankings = $this->ranking->getRankingByClass($classes->first()->classId);
        return view('welcome', ['classes' => $classes, 'rankings' => $rankings, 'count' => 1]);
    }
    /**
     * Search ranking
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search($text)
    {
        $rankings = $this->ranking->getRankingByClass($text);
        $classes = $this->class->fillSelect();        
        return view('welcome', ['classes' => $classes, 'rankings' => $rankings, 'count' => 1, 'classId' => $text]);        
    }
    public function ranking()
    {    
        return Excel::download(new RankingExport, 'rankings.xlsx');
        //return response()->json($rankings);
    }
}
