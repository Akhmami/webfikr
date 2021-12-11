<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
// use App\Jobs\UpdateBalance;
use App\Events\Paymented;
use App\Jobs\PaymentLog;
use App\Libraries\VA;
use App\Models\Billing;
// use App\Models\Balance;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Mail;

class CallbackController extends BaseController
{
    public function index()
    {
        $va = new VA;
        $data = $va->callback();

        PaymentLog::dispatch($data, 'Callback masuk dari BSI Maja');

        if ($data['status'] !== '000') {
            // handling jika gagal
            Mail::raw(json_encode($data), function ($message) {
                $message->to('akhmami@gmail.com')
                    ->subject('handling gagl');
            });
            exit;
        }

        // check history pembayaran
        $history = PaymentHistory::where('payment_ntb', $data['payment_ntb'])->first();
        if ($history) {
            PaymentLog::dispatch($data, 'riwayat pembayaran sudah tersedia, callback dihentikan.');

            echo '{"status":"999", "message":"riwayat pembayaran sudah tersedia"}';
            exit;
        }

        // check to DB
        $billing = Billing::with(['user', 'biller'])->where('trx_id', $data['trx_id'])->first();
        if (!$billing) {
            // Kalo gk ada, kembalikan response 999
            PaymentLog::dispatch($data, 'TRX ID/No. Tagihan tidak tersedia, callback dihentikan.');

            echo '{"status":"999", "message":"Trx_id tidak tersedia"}';
            exit;
        }

        // update billing
        $billing->update([
            'is_paid' => ($data['cumulative_payment_amount'] === $data['trx_amount'] ? 'Y' : 'N'),
        ]);

        $type = substr($billing->trx_id, 0, 3);
        if ($type == 'TOP') {
            $currentAmount_from_last = $billing->user->balance->current_amount ?? 0;
            $current_amount = $currentAmount_from_last + $data['payment_amount'];
            $billing->user->balance()->create([
                'last_amount' => $currentAmount_from_last,
                'type' => 'plus',
                'nominal' => $data['payment_amount'],
                'current_amount' => $current_amount,
                'description' => 'Isi saldo'
            ]);

            PaymentLog::dispatch($data, 'Saldo/TOP UP berhasil ditambahkan.');
        } else {
            $balance_used = $billing->biller->balance_used + $billing->use_balance;
            $cpa_now = $billing->biller()->increment('cumulative_payment_amount', $data['cumulative_payment_amount']);
            $paymented = $cpa_now + $balance_used + $billing->biller->cost_reduction;

            // Update Biller
            $billing->biller()->update([
                'cumulative_payment_amount' => $cpa_now,
                'is_active' => ($paymented >= $billing->biller->amount ? 'N' : 'Y'),
                'balance_used' => $balance_used
            ]);

            if ($balance_used > 0) {
                $billing->user->balance()->decrement('current_amount', ($billing->use_balance ?? 0));
            }

            PaymentLog::dispatch($data, 'Pembayaran Tagihan ' . $type . ' berhasil diproses. kumulatif sekarang: ' . $cpa_now);
        }

        Paymented::dispatch($billing, $data);

        echo '{"status":"000"}';
        exit;
    }
}
