<?php

namespace App\Http\Controllers;

use App\GlickoValue;
use Illuminate\Http\Request;
use App\Http\Requests\GlickoValuesRequest;

class GlickoValueController extends Controller
{
    protected $glickoValue;    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->glickoValue = new GlickoValue();        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default = GlickoValue::select('*')->get()->last();

        return view('glickoValues.index')->with('obj', $default);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GlickoValuesRequest $request)
    {
        $glickoValue = $this->glickoValue->create([
            'rating' => $request->rating,
            'rd' => $request->rd,
            'volatility' => $request->volatility,
            'mu' => $request->mu,
            'sigma' => $request->sigma,
            'systemconstant' => $request->systemconstant,
            'pi2' => $request->pi2,                      
        ]);

        $message = 'Glicko Values has been saved succesfully!';
        return redirect()->route('glicko.index')->with('status', $message)->with('type', 'success');
    }    
}
