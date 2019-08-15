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
    /**
     * Get a listing of the resource to fill navbar
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillNavs(){
        return $this->select('events.location', 'events.eventId','events.name', 'events.date', 'classes.name as className')->join('classes', 'events.classId', '=', 'classes.classId')->orderBy('date', 'desc')->get();
    }
    public function searchByNameOrClassName($text){
        return $this->select('events.location', 'events.eventId','events.name', 'events.date', 
        'classes.name as className')->join('classes', 'events.classId', '=', 'classes.classId')
        ->where('events.name', 'LIKE', $text.'%')->orWhere('classes.name', 'LIKE', $text.'%')
        ->orderBy('date', 'desc')->get();
    }
    public function searchByNameOrClassNameWithDate($text,$date1,$date2){        
        return $this->select('events.location', 'events.eventId','events.name', 'events.date', 
        'classes.name as className')->join('classes', 'events.classId', '=', 'classes.classId')        
        ->whereBetween('events.date', [date('Y-m-d h:m:s', strtotime($date1)), date('Y-m-d', strtotime($date2))])
        ->where('events.name', 'LIKE', $text.'%')->orWhere('classes.name', 'LIKE', $text.'%')->whereBetween('events.date', [date('Y-m-d h:m:s', strtotime($date1)), date('Y-m-d', strtotime($date2))])
        ->orderBy('date', 'desc')
        ->get();
    }

}
