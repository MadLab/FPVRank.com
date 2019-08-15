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
        'eventId', 'pilotId', 'position', 'notes'
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
    public function getList()
    {
        return $this->select('results.resultId', 'events.name as eventId', 'pilots.name as pilotId', 'results.position', 'results.notes')
            ->join('events', 'events.eventId', '=', 'results.eventId')->join('pilots', 'pilots.pilotId', '=', 'results.pilotId')
            ->paginate(12);
    }
    /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text)
    {
        return $this->select('results.resultId', 'events.name as eventId', 'pilots.name as pilotId', 'results.position', 'results.notes')
            ->join('events', 'events.eventId', '=', 'results.eventId')->join('pilots', 'pilots.pilotId', '=', 'results.pilotId')
            ->where('pilots.name', 'LIKE', $text . '%')->orWhere('events.name', 'LIKE', $text . '%')->orWhere('results.resultId', '=', $text)->get();
    }
    /**
     * Get a listing of the resource by eventId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function byEventId($eventId)
    {
        return $this->select('resultId', 'eventId', 'pilotId', 'position','notes')
            ->where('eventId', '=', $eventId)->orderBy('position', 'asc')->get();
        /*return $this->select('results.resultId', 'results.eventId', 'results.pilotId', 'results.position', 'rankings.*')
        ->join('rankings', 'rankings.pilotId', '=', 'results.pilotId')
            ->where([['results.eventId', '=', $eventId],['rankings.current','=',1]])
            ->orderBy('results.position', 'asc')->get();*/
    }
    /**
     * Get a listing of the resource to know the pilots from a class that didnt participate on this event
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNoCompetePilots($eventId, $classId, $array)
    {
        return $this->select('results.pilotId')->join('events', 'events.eventId', '=', 'results.eventId')
            ->where([['results.eventId', '!=', $eventId], ['events.classId', '=', $classId]])
            ->whereNotIn('results.pilotId', $array)->groupBy('results.pilotId')->get();
    }
     /**
     * Get a listing of the resource to fill navbar content
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillNavs(){
        return $this->select('results.eventId','results.resultId', 'results.pilotId', 'results.position', 'results.notes', 'pilots.name')
        ->join('pilots', 'pilots.pilotId', '=', 'results.pilotId')->get();
    }
}
