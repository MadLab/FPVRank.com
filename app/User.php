<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'created_at'
    ];
      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'userId';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     *
     * Get a listing of the resource
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(){
        return $this->select('userId','name', 'email','created_at')->paginate(12);
    }
     /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text){
        return $this->select('userId','name', 'email','created_at')
        ->where('users.name', 'LIKE', $text.'%')->orWhere('userId', '=', $text)->orWhere('email', 'LIKE', $text.'%')->get();
    }

      /**
     * Get a listing of the resource for the dashboard
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillTableDashboard($take){
        return $this->select('userId','name', 'email','created_at')->orderBy('created_at', 'asc')->take($take)->get();
    }
}
