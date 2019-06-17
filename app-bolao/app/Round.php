<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = [
        'betting_name',
        'title',
        'date_start',
        'date_end'
    ];

    public function betting()
    {
        return $this->belongsTo('App\Betting');
    }
}
