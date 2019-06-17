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

    // Nota: em um método acessor é obrigatório seguir o padrão getNomeAttribute
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }
}
