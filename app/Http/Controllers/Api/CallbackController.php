<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
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
        // FROM BNI
        $client_id = config('bsi.client_id');
        $secret_key = config('bsi.secret_key');
        dd($client_id);

        $va = new VA($client_id, $secret_key);

        $data = $va->callback();

        if ($data['status'] !== '000') {
            // handling jika gagal
            echo $data['message'];
        } else {
            // save to DB
            $bill = Billing::with('users')->where('trx_id', $data['trx_id'])->first();

            if (!$bill) {
                echo '{"status":"999", "message":"Trx_id tidak tersedia"}';
            }

            $bill->datetime_payment = $data['datetime_payment'];
            $bill->cumulative_payment_amount = $data['cumulative_payment_amount'];
            $bill->save();

            echo '{"status":"000"}';
        }
    }
}
