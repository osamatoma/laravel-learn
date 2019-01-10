<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User')
                ->withPivot(['name']);
    }
}
