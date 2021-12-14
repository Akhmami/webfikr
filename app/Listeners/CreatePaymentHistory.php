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
        $biller = $billing->biller;
        $data = $event->data;

        // create payment history
        $paymentHistory = $billing->paymentHistories()->updateOrCreate([
            'payment_ntb' => $data['payment_ntb']
        ], [
            'user_id' => $billing->user->id,
            'customer_name' => $data['customer_name'],
            'virtual_account' => $data['virtual_account'],
            'payment_amount' => $data['payment_amount'],
            'datetime_payment' => $data['datetime_payment']
        ]);

        $type = $billing->biller->type ?? null;
        if ($type === 'SPP') {
            $grade = $billing->user->activeGrade()->first();
            $spp_billing = json_decode($billing->spp_pay_month);

            // create spp
            foreach ($spp_billing as $spp) {
                $biller->billerDetails()->whereNull('is_paid')->first()->update([
                    'is_paid' => 'Y'
                ]);

                $paymentHistory->spps()->updateOrCreate([
                    'grade_id' => $grade->id,
                    'bulan' => $spp,
                    'user_id' => $billing->user->id
                ]);
            }
        }
    }
}
