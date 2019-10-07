<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pilot;
use App\CountryList;
use App\Http\Requests\PilotRequest;
use App\Http\Requests\JSONRequest;
use App\Http\Requests\PilotUpdateRequest;
use Storage;

class PilotController extends Controller
{
    protected $pilot;
    protected $country;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pilot = new Pilot();
        $this->country = new CountryList();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pilots = $this->pilot->getList();
        $countries = $this->country->getData();
        return view('pilot.index', ['pilots' => $pilots, 'countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pilot = $this->pilot->all()->last();
        $countries = $this->country->getData();

        return view('pilot.create', ['lastPilotId' => isset($pilot->pilotId) ? $pilot->pilotId : null, 'countries' => $countries]);
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
                return redirect()->route('pilot.create')->with('status', $message);
            } else {
                $pilots = $this->pilot->all();
                foreach ($json as $val) {
                    if ($pilots->contains('pilotId', '=', $val['pilotId'])) {
                        $pilot = $pilots->where('pilotId', '=', $val['pilotId'])->first();
                        $pilot->name = $val['name'];
                        $pilot->username = $val['username'];
                        $pilot->country = $val['country'];
                        $pilot->imagePath = $val['imagePath'];
                        $pilot->imageLocal = 0;
                        $pilot->created_at = date("Y-m-d H:i:s");
                        $pilot->save();
                    } else {
                        $pi = $this->pilot->create($val);
                        $pi->imageLocal = 0;
                        $pi->save();
                    }
                }
                $message = 'Pilots have been saved succesfully!';
                return redirect()->route('pilot.create')->with('status', $message)->with('type', 'success');
            }
        } catch (\Throwable $th) {
            $message = 'Please enter a valid JSON URL!';
            return redirect()->route('pilot.create')->with('status', $message)->with('type', 'danger');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PilotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PilotRequest $request)
    {
        $a = Storage::disk('s3')->put('pilotPicture', $request->file('photo'));
        $pilot = $this->pilot->create([
            'pilotId' => $request->pilotId,
            'name' => $request->name,
            'username' => $request->username,
            'country' => $request->country,
            'imagePath' => $a,
        ]);

        $message = 'Pilot has been saved succesfully!';
        return redirect()->route('pilot.create')->with('status', $message)->with('type', 'success');
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
        $countries = $this->country->getData();
        return response()->view('pilot._pilottable', ['pilots' => $pilots, 'countries' => $countries], 200);
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
        $countries = $this->country->getData();
        if ($pilot->imageLocal == 1) {
            $pilot->imagePath = Storage::disk('s3')->temporaryUrl(
                $pilot->imagePath,
                now()->addMinutes(1)
            );
        }

        return view('pilot.edit', ['pilot' => $pilot, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PilotRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PilotUpdateRequest $request, $id)
    {
        $pilot = $this->pilot->findOrFail($id);
        $check = $this->pilot->where('pilotId', '=', $request->pilotId)->first();
        if ($id == $request->pilotId || $check == null) {
            if($request->photo != null){
                Storage::disk('s3')->delete($pilot->imagePath);
                $a = Storage::disk('s3')->put('pilotPicture',$request->file('photo'));
                $pilot->imagePath = $a;
                $pilot->imageLocal = 1;
            }
            $pilot->fill($request->toArray());
            $pilot->save();
            $message = 'Pilot has been updated succesfully!';
            return redirect()->route('pilot.index')->with('status', $message)->with('type', 'success');
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
