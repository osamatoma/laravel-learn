<?php

namespace App\Listeners;

use App\Events\RegisterDone;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOffers
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
     * @param  RegisterDone  $event
     * @return void
     */
    public function handle(RegisterDone $event)
    {
        //
    }
}