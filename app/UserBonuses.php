<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBonuses extends Model
{
    public $timestamps = false;
    protected $dates = [
        'expires_at'
    ];
    
    public function bonus()
    {
        return $this->hasOne('App\Bonuses', 'id', 'bonus_id');
    }
}
