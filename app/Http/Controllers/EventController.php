<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Classes;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    protected $event;
    protected $class;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->event = new Event();
        $this->class = new Classes();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = $this->event->getList();   
        //dd($event->toArray());     
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $this->event->create($request->toArray());
        $message = 'Class has been saved succesfully!';
        return redirect()->route('event.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $text
     * @return \Illuminate\Http\Response
     */
    public function show($text)
    {
        //
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
        return view('event.edit', ['event' => $event, 'classes' => $classes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $event = $this->event->findOrFail($id);        
        $event->fill($request->toArray());
        $event->save();

        $message = 'Event has been updated succesfully!';
        return redirect()->route('event.index')->with('status', $message);
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
