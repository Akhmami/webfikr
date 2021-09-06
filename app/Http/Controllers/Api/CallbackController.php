<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Jobs\UpdateBalance;
use App\Events\Paymented;
use App\Libraries\VA;
use App\Models\Billing;

class CallbackController extends BaseController
{
    public function index()
    {
        $va = new VA;
        $data = $va->callback();

        if ($data['status'] !== '000') {
            // handling jika gagal
            echo $data['message'];
            exit;
        } else {
            // check to DB
            $billing = Billing::with(['user', 'biller'])->where('trx_id', $data['trx_id'])->first();

            if (!$billing) {
                // Kalo gk ada, kembalikan response 999
                echo '{"status":"999", "message":"Trx_id tidak tersedia"}';
                exit;
            } else {
                // update billing
                $billing->update([
                    'is_paid' => ($data['cumulative_payment_amount'] === $data['trx_amount'] ? 'Y' : 'N'),
                ]);

                $type = substr($billing->trx_id, 0, 3);
                if ($type === 'TOP') {
                    UpdateBalance::dispatch($billing->user()->balance->id, $data['payment_amount']);
                } else {
                    $biller_cpa = $billing->biller->cumulative_payment_amount ?? 0;
                    $cpa_now = $biller_cpa + $data['cumulative_payment_amount'];

                    // Update Biller
                    $billing->biller()->update([
                        'cumulative_payment_amount' => $cpa_now,
                        'is_active' => ($cpa_now < $billing->biller->amount ? 'Y' : 'N')
                    ]);
                }

                Paymented::dispatch($billing, $data);

                echo '{"status":"000"}';
                exit;
            }
        }
    }
}
