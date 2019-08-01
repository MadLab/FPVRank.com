<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username',
    ];
         /**
     * 
     * Get a listing of the resource
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(){
        return $this->select('id','name', 'username','created_at')->paginate(12);
    }
     /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text){
        return $this->select('id','name', 'username','created_at')
        ->where('name', 'LIKE', $text.'%')->get();
    }
}
