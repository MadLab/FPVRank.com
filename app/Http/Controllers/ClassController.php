<?php

namespace App\Http\Controllers;

use App\Classes;
use App\CountryList;
use App\Http\Requests\ClassRequest;
use App\Http\Requests\JSONRequest;


class ClassController extends Controller
{
    protected $class;
    protected $country;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->class = new Classes();
        $this->country = new CountryList();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = $this->class->getList();
        $countries = $this->country->getData();
        return view('class.index', ['classes' => $class, 'countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = $this->class->all()->last();
        $countries = $this->country->getData();
        return view('class.create', ['lastClassId' => isset($class->classId) ? $class->classId : null, 'countries' => $countries]);
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
        return redirect()->route('class.create')->with('status', $message)->with('type', 'success');
    }
    /**
     * Store a newly created resource with JSON data
     * @param  App\Http\Requests\ClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storejson(JSONRequest $request)
    {
        try {
            $json = json_decode(file_get_contents($request->jsonurl), true);
            if ($json == null) {
                $message = 'Please enter a valid JSON URL!';
                return redirect()->route('class.create')->with('status', $message)->with('type', 'danger');
            } else {
                $classes = $this->class->all();
                foreach ($json as $val) {
                    if ($classes->contains('classId', '=', $val['classId'])) {
                        $class = $classes->where('classId', '=', $val['classId'])->first();
                        $class->name = $val['name'];
                        $class->description = $val['description'];
                        $class->created_at = date("Y-m-d H:i:s");
                        $class->save();
                    } else {
                        $this->class->create($val);
                    }
                }
                $message = 'Classes have been saved succesfully!';
                return redirect()->route('class.create')->with('status', $message)->with('type', 'success');
            }
        } catch (\Throwable $th) {
            $message = 'An error has ocurred! '.$th->getMessage();            
            return redirect()->route('class.create')->with('status', $message)->with('type', 'danger');
        }
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
        $countries = $this->country->getData();
        return response()->view('class._classtable', ['classes' => $classes, 'countries' => $countries], 200);
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
        $countries = $this->country->getData();
        return view('class.edit', ['class' => $class, 'countries' => $countries]);
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
        $check = $this->class->where('classId', '=', $request->classId)->first();
        if ($id == $request->classId || $check == null) {
            $class->fill($request->toArray());
            $class->save();
            $message = 'Class has been updated succesfully!';
        return redirect()->route('class.index')->with('status', $message)->with('type', 'success');
        } else {
            $message = 'This ID is already taken!';
            return back()->withInput()->with('status', $message)->with('type', 'danger');
        }
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
