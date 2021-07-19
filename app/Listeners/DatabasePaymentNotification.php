<?php

namespace App\Listeners;

use App\Events\Paymented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DatabasePaymentNotification
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
     * @param  Paymented  $event
     * @return void
     */
    public function handle(Paymented $event)
    {
        //
    }
}
