<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotifications extends Model
{
    protected $fillable = [
        'user_id', 'film_id'
    ];

    public function user()
    {
        return $this->hasOne();
    }

    public function film()
    {
        return $this->hasOne();
    }
}
