<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonuses extends Model
{
    protected $fillable = [
        'id', 'name', 'days_active'
    ];
}
