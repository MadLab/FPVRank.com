<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlickoValue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating', 'rd', 'volatility', 'mu','phi', 'sigma', 'systemconstant', 'pi2'
    ];
}
