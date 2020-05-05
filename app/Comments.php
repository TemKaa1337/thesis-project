<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $timestamps = false;
    
    protected $dates = [
        'insert_datetime'
    ];
}
