<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pilot;
use App\Http\Requests\PilotRequest;

class PilotController extends Controller
{
    protected $pilot;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pilot = new Pilot();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pilots = $this->pilot->getList();
        return view('pilot.index', ['pilots' => $pilots]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pilot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PilotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PilotRequest $request)
    {
        $this->pilot->create($request->toArray());
        $message = 'Pilot has been saved succesfully!';
        return redirect()->route('pilot.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $text
     * @return \Illuminate\Http\Response
     */
    public function show($text)
    {
        $pilots = $this->pilot->search($text);
        return response()->view('pilot._pilottable', ['pilots' => $pilots], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pilot = $this->pilot->findOrFail($id);
        return view('pilot.edit', ['pilot' => $pilot]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PilotRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PilotRequest $request, $id)
    {
        $pilot = $this->pilot->findOrFail($id);        
        $pilot->fill($request->toArray());
        $pilot->save();

        $message = 'Pilot has been updated succesfully!';
        return redirect()->route('pilot.index')->with('status', $message);
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
