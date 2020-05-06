<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'film_id', 'author', 'comment', 'insert_datetime', 'user_id', 'avatar'
    ];

    protected $dates = [
        'insert_datetime'
    ];
}
