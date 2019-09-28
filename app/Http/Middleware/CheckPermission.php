<?php

namespace App\Http\Middleware;

use App\Permission;
use Closure;
use Route;
use Auth;

class CheckPermission
{
    protected $permission;
    public function __construct()
    {
        $this->permission = new Permission();
    }

    public function checkPermission($controller, $type)
    {
        $userId = Auth::user()->userId;
        $permission = $this->permission->select('*')->where([['userId', '=', $userId], ['controller', '=', $controller]])->get()->first();
        if ($type == 'edit') {
            if ($permission->edit == 0) {
                return false;
            } else {
                return true;
            }
        } elseif ($type == 'create') {
            if ($permission->create == 0) {
                return false;
            } else {
                return true;
            }
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch (Route::currentRouteName()) {
                //UserController
            case 'user.edit':
                $status = $this->checkPermission('UserController', 'edit');
                if (!$status) {
                    return redirect()->route('user.index');
                }
                break;
            case 'user.update':
                $status = $this->checkPermission('UserController', 'edit');
                if (!$status) {
                    return redirect()->route('user.index');
                }
                break;
            case 'user.create':
                $status = $this->checkPermission('UserController', 'create');
                if (!$status) {
                    return redirect()->route('user.index');
                }
                break;
            case 'user.store':
                $status = $this->checkPermission('UserController', 'create');
                if (!$status) {
                    return redirect()->route('user.index');
                }
                break;
                ///ClassController
            case 'class.edit':
                $status = $this->checkPermission('ClassController', 'edit');
                if (!$status) {
                    return redirect()->route('class.index');
                }
                break;
            case 'class.update':
                $status = $this->checkPermission('ClassController', 'edit');
                if (!$status) {
                    return redirect()->route('class.index');
                }
                break;
            case 'class.create':
                $status = $this->checkPermission('ClassController', 'create');
                if (!$status) {
                    return redirect()->route('class.index');
                }
                break;
            case 'class.store':
                $status = $this->checkPermission('ClassController', 'create');
                if (!$status) {
                    return redirect()->route('class.index');
                }
                break;
                ///PilotController
            case 'pilot.edit':
                $status = $this->checkPermission('PilotController', 'edit');
                if (!$status) {
                    return redirect()->route('pilot.index');
                }
                break;
            case 'pilot.update':
                $status = $this->checkPermission('PilotController', 'edit');
                if (!$status) {
                    return redirect()->route('pilot.index');
                }
                break;
            case 'pilot.create':
                $status = $this->checkPermission('PilotController', 'create');
                if (!$status) {
                    return redirect()->route('pilot.index');
                }
                break;
            case 'pilot.store':
                $status = $this->checkPermission('PilotController', 'create');
                if (!$status) {
                    return redirect()->route('pilot.index');
                }
                break;
                ///EventController
            case 'event.edit':
                $status = $this->checkPermission('EventController', 'edit');
                if (!$status) {
                    return redirect()->route('event.index');
                }
                break;
            case 'event.update':
                $status = $this->checkPermission('EventController', 'edit');
                if (!$status) {
                    return redirect()->route('event.index');
                }
                break;
            case 'event.create':
                $status = $this->checkPermission('EventController', 'create');
                if (!$status) {
                    return redirect()->route('event.index');
                }
                break;
            case 'event.store':
                $status = $this->checkPermission('EventController', 'create');
                if (!$status) {
                    return redirect()->route('event.index');
                }
                break;

            default:
                # code...
                break;
        }
        return $next($request);
    }
}
