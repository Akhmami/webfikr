<?php

namespace App\Listeners;

use App\Events\Paymented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PaymentNotification;

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
        $billing = $event->billing;
        $data = $event->data;

        $billing->user->notify(new PaymentNotification($data));
    }
}
