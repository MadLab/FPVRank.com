<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Event;
use App\Pilot;
use App\User;
use App\CountryList;
use Auth;
use Hash;
use App\Http\Requests\UserUpdateRequest;

class AdminController extends Controller
{
    protected $user;
    protected $pilot;
    protected $event;
    protected $class;
    protected $country;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = new User();
        $this->pilot = new Pilot();
        $this->event = new Event();
        $this->class = new Classes();
        $this->country = new CountryList();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $take = 4; //number of query rows
        $users = $this->user->fillTableDashboard($take);
        $pilots = $this->pilot->fillTableDashboard($take);
        $events = $this->event->fillTableDashboard($take);
        $classes = $this->class->fillTableDashboard($take);
        $countries = $this->country->getData();

        return view('admin.index', ['users' => $users, 'classes' => $classes, 'events' => $events, 'pilots' => $pilots, 'countries' => $countries]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $id = Auth::user()->userId;
        $user = $this->user->findOrFail($id);

        return view('admin.profile', ['user' => $user]);
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UserUpdateRequest $request)
    {
        $password = $request->password;
        $password_confirm = $request->password_confirmation;
        $userId = Auth::user()->userId;
        if (isset($password)) {
            if (strcmp($password, $password_confirm)  == 0) {
                $user = $this->user->findOrFail($userId);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

                $message = 'Your profile has been updated succesfully!';
                return redirect()->route('profile.edit')->with('status', $message)->with('type', 'success');
            } else {
                $message = 'Passwords don\'t match!';
                return back()->withInput()->with('status', $message)->with('type', 'danger');
            }
        } else {
            $user = $this->user->findOrFail($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $message = 'Your profile has been updated succesfully!';
            return redirect()->route('profile.edit')->with('status', $message)->with('type', 'success');
        }
    }
}
