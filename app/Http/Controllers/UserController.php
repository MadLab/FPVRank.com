<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Permission;
use Hash;
use Session;
use DB;

class UserController extends Controller
{
    protected $user;
    protected $permission;
    public function check()
    { }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User();
        $this->permission = new Permission();
        //$this->check();
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
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $permiData = [
                [
                    'userId' => $user->userId,
                    'edit' => isset($request->userEdit) ? 1 : 0,
                    'create' => isset($request->userCreate) ? 1 : 0,
                    'controller' => 'UserController'
                ],
                [
                    'userId' => $user->userId,
                    'edit' => isset($request->classEdit) ? 1 : 0,
                    'create' => isset($request->classCreate) ? 1 : 0,
                    'controller' => 'ClassController'
                ],
                [
                    'userId' => $user->userId,
                    'edit' => isset($request->pilotEdit) ? 1 : 0,
                    'create' => isset($request->pilotCreate) ? 1 : 0,
                    'controller' => 'PilotController'
                ],
                [
                    'userId' => $user->userId,
                    'edit' => isset($request->eventEdit) ? 1 : 0,
                    'create' => isset($request->eventCreate) ? 1 : 0,
                    'controller' => 'EventController'
                ],
            ];
            Permission::insert($permiData);
            $message = 'User has been saved succesfully!';
            return redirect()->route('user.index')->with('status', $message)->with('type', 'success');
        } else {
            $message = 'Passwords don\'t match!';
            return back()->withInput()->with('status', $message)->with('type', 'danger');
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

        $permissions = $this->permission->getAllByUser($user->userId);

        return view('user.edit', ['user' => $user, 'permissions' => $permissions]);
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
        $permiData = [
            [
                'userId' => $id,
                'edit' => isset($request->userEdit) ? 1 : 0,
                'create' => isset($request->userCreate) ? 1 : 0,
                'controller' => 'UserController'
            ],
            [
                'userId' => $id,
                'edit' => isset($request->classEdit) ? 1 : 0,
                'create' => isset($request->classCreate) ? 1 : 0,
                'controller' => 'ClassController'
            ],
            [
                'userId' => $id,
                'edit' => isset($request->pilotEdit) ? 1 : 0,
                'create' => isset($request->pilotCreate) ? 1 : 0,
                'controller' => 'PilotController'
            ],
            [
                'userId' => $id,
                'edit' => isset($request->eventEdit) ? 1 : 0,
                'create' => isset($request->eventCreate) ? 1 : 0,
                'controller' => 'EventController'
            ],
        ];
        if (isset($password)) {
            if (strcmp($password, $password_confirm)  == 0) {
                $user = $this->user->findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

                $this->updatePermissions($permiData, $user->userId);

                $message = 'User has been updated succesfully!';
                return redirect()->route('user.index')->with('status', $message)->with('type', 'success');
            } else {
                $message = 'Passwords don\'t match!';
                return back()->withInput()->with('status', $message)->with('type', 'danger');
            }
        } else {
            $user = $this->user->findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $this->updatePermissions($permiData, $user->userId);

            $message = 'User has been updated succesfully!';
            return redirect()->route('user.index')->with('status', $message)->with('type', 'success');
        }
    }

    private function updatePermissions($permiData, $userId)
    {
        $permissions = $this->permission->where('userId', '=', $userId)->get();

        $userCtrl = $permissions->where('controller', '=', 'UserController')->first();
        $userCtrl->create = $permiData[0]['create'];
        $userCtrl->edit = $permiData[0]['edit'];
        $userCtrl->save();

        $classCtrl = $permissions->where('controller', '=', 'ClassController')->first();
        $classCtrl->create = $permiData[1]['create'];
        $classCtrl->edit = $permiData[1]['edit'];
        $classCtrl->save();

        $pilotCtrl = $permissions->where('controller', '=', 'PilotController')->first();
        $pilotCtrl->create = $permiData[2]['create'];
        $pilotCtrl->edit = $permiData[2]['edit'];
        $pilotCtrl->save();

        $eventCtrl = $permissions->where('controller', '=', 'EventController')->first();
        $eventCtrl->create = $permiData[3]['create'];
        $eventCtrl->edit = $permiData[3]['edit'];
        $eventCtrl->save();
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
