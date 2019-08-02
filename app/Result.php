<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'eventId', 'pilotId','position', 'notes'
    ];
      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'resultId';
       /**
     * 
     * Get a listing of the resource
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(){
        return $this->select('results.resultId','events.name as eventId', 'pilots.name as pilotId','results.position', 'results.notes')
        ->join('events', 'events.eventId', '=', 'results.eventId')->join('pilots', 'pilots.pilotId' , '=', 'results.pilotId')
        ->paginate(12);
    }
     /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text){
        return $this->select('results.resultId','events.name as eventId', 'pilots.name as pilotId','results.position', 'results.notes')
        ->join('events', 'events.eventId', '=', 'results.eventId')->join('pilots', 'pilots.pilotId' , '=', 'results.pilotId')
        ->where('pilots.name', 'LIKE', $text.'%')->orWhere('events.name', 'LIKE', $text.'%')->orWhere('results.resultId', '=', $text)->get();
    }
}
