<?php

namespace App\Exports;

use App\Ranking;
use Maatwebsite\Excel\Concerns\FromCollection;

class RankingExport implements FromCollection
{
    public function collection()
    {
        return Ranking::select('pilots.name','rankings.*')
        ->join('pilots','pilots.pilotId','=','rankings.pilotId')
        ->where('rankings.current','=',1)->orderBy('rankings.rating','desc')->get();
    }
}