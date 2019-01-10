<?php

namespace App\Traits\User;

trait Scopes
{

    public function scopeName($query)
    {
        $query->where('id', 18)->first();
    }
}
