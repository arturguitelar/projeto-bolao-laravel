<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Funções que pertencem a esta permissão.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
