<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'date','classId', 'location'
    ];
         /**
     * 
     * Get a listing of the resource
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(){
        return $this->select('events.id','events.name', 'events.date','classes.name as classId','events.location')
        ->join('classes', 'classes.id', '=', 'events.classId')->paginate(12);
    }
     /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text){
        return $this->select('events.id','events.name', 'events.date','classes.name as classId','events.location')
        ->join('classes', 'classes.id', '=', 'events.classId')->where('events.name', 'LIKE', $text.'%')->get();
    }
}
