<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ranking;
use App\Classes;
use Route;

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
        $rankings = $this->ranking->getRankingByClass(1);
        
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
        return response()->view('pilot._pilottable', ['rankings' => $rankings, 'count' => 1], 200);                
    }
    public function ranking(){
        $rankings = $this->ranking->all();
        return response()->json($rankings);
    }
}
