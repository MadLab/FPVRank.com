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
        'pilotId', 'eventId', 'classId', 'rating',
        'mu', 'rd', 'sigma', 'phi',
        'current', 'country', 'totalraces'
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
    public function getCurrentRanking($classId, $data)
    {
        return $this->select('*')->where([['current', '=', 1], ['classId', '=', $classId]])->whereIn('pilotId', $data)->get();
    }
    /**
     * Get a listing of the resource with current ranking = 1 by classId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRankingByClass($classId)
    {
        return $this->select(
            'classes.name as className',
            'classes.classId',
            'pilots.pilotId',
            'pilots.name',
            'pilots.username',
            'rankings.rating',
            'rankings.country'
        )->join('pilots', 'pilots.pilotId', '=', 'rankings.pilotId')->join('classes', 'classes.classId', '=', 'rankings.classId')
            ->where([['rankings.classId', '=', $classId], ['rankings.current', '=', 1]])
            ->orderBy('rankings.rating', 'desc')->get();
    }
    /**
     * Get a listing of the resource with current ranking = 1 by classId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRankingByClassAndCountry($classId, $country)
    {
        return $this->select(
            'classes.name as className',
            'pilots.pilotId',
            'pilots.name',
            'pilots.username',
            'rankings.rating',
            'rankings.country'
        )->join('pilots', 'pilots.pilotId', '=', 'rankings.pilotId')->join('classes', 'classes.classId', '=', 'rankings.classId')
            ->where([
                ['rankings.classId', '=', $classId], ['rankings.current', '=', 1],
                ['rankings.country', '=', $country]
            ])
            ->orderBy('rankings.rating', 'desc')->get();
    }


    /**
     * Get a listing of the resource with current ranking = 1 by classId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchRankings($classId, $text, $country)
    {
        if ($country == 'all') {
            return $this->select(
                'pilots.pilotId',
                'pilots.name',
                'pilots.username',
                'rankings.rating'
            )->join('pilots', 'pilots.pilotId', '=', 'rankings.pilotId')->join('classes', 'classes.classId', '=', 'rankings.classId')
                ->where([['rankings.classId', '=', $classId], ['rankings.current', '=', 1], ['pilots.name', 'LIKE', $text . '%']])
                ->orWhere([['rankings.classId', '=', $classId], ['rankings.current', '=', 1], ['pilots.username', 'LIKE', $text . '%']])
                ->orderBy('rankings.rating', 'desc')->get();
        } else {
            return $this->select(
                'pilots.pilotId',
                'pilots.name',
                'pilots.username',
                'rankings.rating'
            )->join('pilots', 'pilots.pilotId', '=', 'rankings.pilotId')->join('classes', 'classes.classId', '=', 'rankings.classId')
                ->where([['rankings.classId', '=', $classId], ['rankings.current', '=', 1], ['pilots.name', 'LIKE', $text . '%'], ['pilots.country', '=', $country]])
                ->orWhere([['rankings.classId', '=', $classId], ['rankings.current', '=', 1], ['pilots.username', 'LIKE', $text . '%'], ['pilots.country', '=', $country]])
                ->orderBy('rankings.rating', 'desc')->get();
        }
    }
}
