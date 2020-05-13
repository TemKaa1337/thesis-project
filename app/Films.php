<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name', 'preview_image', 'film_page_image', 'description', 'genre', 'date_shown_from', 'date_shown_to', 'producer', 'country', 'year', 'duration', 'actors', 'age_restriction', 'trailer', 'is_shown'
    ];

    protected $dates = [
        'date_shown_from', 'date_shown_to'
    ];
}
