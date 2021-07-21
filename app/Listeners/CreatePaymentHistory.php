<?php

namespace App\Listeners;

use App\Events\Paymented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\GradeUser;

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
            $grade_id = $billing->user->activeGrade()->first()->id;
            $qty_bln = $billing->biller->qty_spp ?? 0;
            $previous_spp_date = $billing->biller->previous_spp_date;
            $grade_user = GradeUser::where('grade_id', $grade_id)
                ->where('user_id', $billing->user_id)->first();

            // create spp
            for($i = 1; $i <= $qty_bln; $i++) {
                $paymentHistory->spps()->create([
                    'grade_user_id' => $grade_user->id,
                    'bulan' => date('Y-m-d', strtotime('+'. $i .' month', strtotime($previous_spp_date)))
                ]);
            }
        }
    }
}
