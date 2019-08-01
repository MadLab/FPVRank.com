<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Requests\ClassRequest;

class ClassController extends Controller
{
    protected $class;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->class = new Classes();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = $this->class->getList();
        return view('class.index', ['classes' => $class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        $this->class->create($request->toArray());
        $message = 'Class has been saved succesfully!';
        return redirect()->route('class.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $text
     * @return \Illuminate\Http\Response
     */
    public function show($text)
    {
        $classes = $this->class->search($text);
        return response()->view('class._classtable', ['classes' => $classes], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = $this->class->findOrFail($id);
        return view('class.edit', ['class' => $class]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ClassRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRequest $request, $id)
    {
        $class = $this->class->findOrFail($id);        
        $class->fill($request->toArray());
        $class->save();

        $message = 'Class has been updated succesfully!';
        return redirect()->route('class.index')->with('status', $message);
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
