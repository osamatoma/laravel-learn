<?php

namespace App\Traits\User;

use App\Post;

trait Relations
{

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function forms()
    {
        return $this->belongsToMany('App\Form');
    }

    public function photos()
    {
        return $this->belongsToMany('App\Photo');
    }
}
