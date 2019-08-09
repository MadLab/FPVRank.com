<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pilotId', 'eventId','classId', 'rating', 
         'mu', 'rd', 'sigma', 'phi', 
        'current'
    ];
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'rankingId';
        /**
     * Get a listing of the resource with current ranking = 1 and pilotId (=)"IN" $array
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCurrentRanking($classId, $data){
        return $this->select('*')->where([['current','=',1],['classId','=',$classId]])->whereIn('pilotId', $data)->get();
    }
       /**
     * Get a listing of the resource with current ranking = 1 by classId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRankingByClass($classId){
        return $this->select('pilots.name as pilotId', 'pilots.username',
        'rankings.rating')->join('pilots', 'pilots.pilotId','=','rankings.pilotId')->
        join('classes', 'classes.classId', '=', 'rankings.classId')
        ->where([['rankings.classId','=',$classId],['rankings.current','=',1]])
        ->orderBy('rankings.rating', 'desc')->paginate(100);
    }

   
}