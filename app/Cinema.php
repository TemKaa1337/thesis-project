<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'halls', 'description', 'date_created', 'terminal', 'bar', 'parking', 'metro', 'phones'
    ];

    protected $dates = [
        'date_created'
    ];
}
