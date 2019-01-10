<?php

namespace App\Services;

class Twitter
{
    protected $social;

    public function __construct(Social $social)
    {

        $this->social = $social;
    }

    public function getKey()
    {
        return $this->social->getKey();
    }
}
