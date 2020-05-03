<?php

namespace App;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class SessionTime extends Model
{
    public $timestamps = false;
    
    protected $dates = [
        'date_shown', 'datetime_shown'
    ];

    protected $casts = [
        'hall_places' => 'array',
    ];

    public static function getSessionDates($filmId)
    {
        return self::select('date_shown')->distinct('date_shown')->where([
            ['film_id', '=', $filmId],
            ['date_shown', '>=', date('Y-m-d')]
        ])->get();
    }
}
