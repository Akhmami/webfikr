<?php

namespace App\Listeners;

use App\Events\Paymented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Libraries\WA;

class SendPaymentNotification
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
        $type = substr($billing->trx_id, 0, 3);

        if (config('app.env') === 'production') {
            // Send WA
            $wa = new WA($billing->user);
            if ($type == 'PSB') {
                $billing->user()->update(['status_psb_id' => 2]);

                $wa->notifyPsbPaymentCompleted($data);
                return;
            }

            $wa->notifyPayment($data);
        }
    }
}
