<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotifications extends Model
{
    protected $fillable = [
        'user_id', 'user_chat_id', 'film_name'
    ];
}
