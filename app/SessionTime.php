<?php

namespace App;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class SessionTime extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'film_id', 'date_shown', 'datetime_shown', 'cinema_name', 'hall_places'
    ];

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
