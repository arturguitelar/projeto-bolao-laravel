<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'round_id',
        'title',
        'stadium',
        'team_a',
        'team_b',
        'result',
        'scoreboard_a',
        'scoreboard_b',
        'date'
    ];

    public function round()
    {
        return $this->belongsTo('App\Round');
    }

    public function getDateBrAttribute()
    {
        $date = date_create($this->date);

        return date_format($date, 'd/m/Y H:i:s');
    }

    public function setDateAttribute($value)
    {
        $date = date_create($value);

        $this->attributes['date'] = date_format($date, 'Y-m-d H:i:s');
    }
}
