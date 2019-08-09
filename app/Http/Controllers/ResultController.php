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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->result->getList();           
        return view('result.index', ['results' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = $this->event->fillSelect();
        
        return view('result.create', ['events' => $events]);
    }

    /**
     * Store or edit a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRequest $request)
    {                
        if(isset($request->resultId)){
            $result = $this->result->findOrFail($request->resultId);
            $result->fill($request->toArray());
            $result->save();
            return response()->json(['result' => $result, 'type' => 'editar'], 200);
        }else{
            $result = $this->result->create($request->toArray());
            return response()->json(['result' =>$result, 'type' => 'create'], 200);
        }
        /*$message = 'Class has been saved succesfully!';
        return redirect()->route('result.index')->with('status', $message);*/
        
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $text
     * @return \Illuminate\Http\Response
     */
    public function show($text)
    {
        $results = $this->result->search($text);
        return response()->view('result._resulttable', ['results' => $results], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->result->findOrFail($id);
        
        $events = $this->event->fillSelect();
        $pilots = $this->pilot->fillSelect();
        return view('result.edit', ['events' => $events, 'pilots' => $pilots, 'result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResultRequest $request, $id)
    {
        $result = $this->result->findOrFail($id);        
        $result->fill($request->toArray());
        $result->save();
        $message = 'Result has been updated succesfully!';
        return redirect()->route('result.index')->with('status', $message);
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
