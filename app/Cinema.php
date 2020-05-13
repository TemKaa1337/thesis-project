<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillabel = [
        'name', 'halls', 'description', 'date_created', 'session_times', 'films', 'terminal', 'bar', 'parking', 'metro', 'phones'
    ];
}
