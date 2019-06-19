<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BettingUser extends Model
{
    protected $fillable = [
        'betting_id', 'user_id', 'points'
    ];
}
