<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Events\Paymented;
use App\Libraries\VA;
use App\Models\Billing;

class CallbackController extends BaseController
{
    public function index()
    {
        # code...
    }

    public function development()
    {
        $va = new VA;
        $data = $va->callback();

        if ($data['status'] !== '000') {
            // handling jika gagal
            echo $data['message'];
        } else {
            // check to DB
            $billing = Billing::with(['user', 'biller'])->where('trx_id', $data['trx_id'])->first();
            $biller_cpa = $billing->biller->cumulative_payment_amount;

            if (!$billing) {
                echo '{"status":"999", "message":"Trx_id tidak tersedia"}';
                exit;
            } else {
                // update billing
                $billing->update([
                    'is_paid' => ($data['cumulative_payment_amount'] === $data['trx_amount'] ? 'Y' : 'N'),
                ]);

                // update biller
                $billing->biller()->update([
                    'cumulative_payment_amount' => ($biller_cpa + $data['cumulative_payment_amount']),
                ]);

                Paymented::dispatch($billing, $data);

                echo '{"status":"000"}';
                exit;
            }
        }
    }
}
