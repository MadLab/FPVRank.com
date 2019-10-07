<?php

namespace App\Http\Controllers;

use App\Event;
use App\Pilot;
use App\Result;
use View;
use App\Http\Requests\ResultRequest;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $event;
    protected $pilot;
    protected $result;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->event = new Event();
        $this->pilot = new Pilot();
        $this->result = new Result();
    }
    /**
     * Return a view with inputs
     */
    public function inputs($count){
        $pilots = $this->pilot->fillSelect();
        $var = null;
        for($i=1; $i < 11; $i++) {
            $var = $var . View::make('event._inputs', ['pilots' => $pilots, 'count' => $count +$i]);
        }
        return response($var);


    }
}
