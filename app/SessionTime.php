<?php

namespace App;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class SessionTime extends Model
{
    protected $dates = [
        'date_shown', 'datetime_shown'
    ];

    protected $casts = [
        'hall_places' => Json::class,
    ];
}
