<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Betting extends Model
{
    protected $fillable = [
        'user_id', 'title', 'current_round', 'value_result', 'extra_value', 'value_fee'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function rounds()
    {
        return $this->hasMany('App\Round');
    }

    // Nota: em um método acessor é obrigatório seguir o padrão getNomeAttribute
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getTitleAttribute($value)
    {
        return ucwords(mb_strtolower($value, 'UTF-8'));
    }

    public function bettors()
    {
        return $this->belongsToMany('App\Betting');
    }
}
