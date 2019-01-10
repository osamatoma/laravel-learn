<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserHasRetrievedListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasRetrieved  $event
     * @return void
     */
    public function handle(\App\Events\UserHasRetrieved  $event)
    {
        // echo "string";
        //dd($event);
    }
}