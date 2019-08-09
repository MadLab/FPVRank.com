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
        'name', 'date','classId', 'location', 'dateRanked'
    ];
      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'eventId';
         /**
     * 
     * Get a listing of the resource
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(){
        return $this->select('events.eventId','events.name', 'events.date','classes.name as classId','events.location')
        ->join('classes', 'classes.classId', '=', 'events.classId')->paginate(12);
    }
     /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text){
        return $this->select('events.eventId','events.name', 'events.date','classes.name as classId','events.location')
        ->join('classes', 'classes.classId', '=', 'events.classId')->where('events.name', 'LIKE', $text.'%')
        ->orWhere('classes.name', 'LIKE', $text.'%')->orWhere('events.eventId', '=', $text)->get();
    }
      /**
     * Get a listing of the resource to fill select input
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillSelect(){
        return $this->select('eventId','name')->get();
    }
    /**
     * Get a listing of the resource to rank pilots
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function selectForRank($eventId){
        return $this->select('classId')->where('eventId','=',$eventId)->first();
    }

}
