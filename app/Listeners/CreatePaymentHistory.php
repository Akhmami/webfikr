<?php

namespace App\Listeners;

use App\Events\Paymented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePaymentHistory
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

        // create payment history
        $paymentHistory = $billing->paymentHistories()->updateOrCreate([
            'payment_ntb' => $data['payment_ntb']
        ], [
            'customer_name' => $data['customer_name'],
            'payment_amount' => $data['payment_amount'],
            'datetime_payment' => $data['datetime_payment']
        ]);

        if ($billing->biller->type === 'SPP') {
            $grade = $billing->user->activeGrade()->first();
            $qty_bln = $billing->biller->qty_spp ?? 0;
            $previous_spp_date = $billing->biller->previous_spp_date;

            // create spp
            for($i = 1; $i <= $qty_bln; $i++) {
                $paymentHistory->spps()->create([
                    'user_id' => $billing->user->id,
                    'grade_id' => $grade->id,
                    'bulan' => date('Y-m-01', strtotime('+'. $i .' month', strtotime($previous_spp_date)))
                ]);
            }
        }
    }
}
