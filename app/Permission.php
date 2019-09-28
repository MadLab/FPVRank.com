<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'edit', 'create', 'controller'
    ];

    /**
     * Get the user permission
     *
     * @param integer $userId
     */
    public function getAllByUser($userId){
        return $this->select('*')->where('userId', '=', $userId)->get();
    }
}
