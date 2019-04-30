<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
     * Usuários que pertencem a esta função.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Permissões que pertencem a esta função.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}
