<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    protected $dates = [
        'date_shown_from', 'date_shown_to'
    ];
}
