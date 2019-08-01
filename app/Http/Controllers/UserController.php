<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Hash;

class UserController extends Controller
{
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->getList();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = $request->password;
        $password_confirm = $request->password_confirmation;
        if (strcmp($password, $password_confirm)  == 0) {
            $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $message = 'User has been saved succesfully!';
            return redirect()->route('user.index')->with('status', $message);
        } else {
            $message = 'Passwords don\'t match!';
            return back()->withInput()->with('status', $message);
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
        $users = $this->user->search($text);
        return response()->view('user._usertable', ['users' => $users], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $password = $request->password;
        $password_confirm = $request->password_confirmation;
        
        if(isset($password)){
            if (strcmp($password, $password_confirm)  == 0) {
                $user = $this->user->findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                
                $message = 'User has been updated succesfully!';
                return redirect()->route('user.index')->with('status', $message);
            } else {
                $message = 'Passwords don\'t match!';
                return back()->withInput()->with('status', $message);
            }
        }else{
            $user = $this->user->findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;                
                $user->save();

                $message = 'User has been updated succesfully!';
                return redirect()->route('user.index')->with('status', $message);
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
