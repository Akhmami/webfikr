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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class CallbackController extends BaseController
{
    public function index()
    {
        $va = new VA;
        $data = $va->callback();

        PaymentLog::dispatch($data, 'Callback masuk dari BSI Maja');

        if ($data['status'] !== '000') {
            // handling jika gagal
            PaymentLog::dispatch($data, 'Callback gagal, code#' . $data['status']);
            Mail::raw(json_encode($data), function ($message) {
                $message->to('akhmami@gmail.com')
                    ->subject('handling gagl');
            });

            echo json_encode($data);
            exit;
        }

        // cek riwayat pembayaran
        $history = PaymentHistory::where('payment_ntb', $data['payment_ntb'])->first();
        if ($history) {
            PaymentLog::dispatch($data, 'Riwayat pembayaran sudah tersedia, callback dihentikan.');

            echo '{"status":"999", "message":"riwayat pembayaran sudah tersedia"}';
            exit;
        }

        // check TRX_ID to DB
        $billing = Billing::with(['user', 'biller'])->where('trx_id', $data['trx_id'])->first();
        if (!$billing) {
            // cek database qurban kalo gk ada, kembalikan response 999
            $paymentFromQurban = DB::connection('mysql2')
                ->table('payments')
                ->where('trx_id', $data['trx_id'])
                ->limit(1);
            
            if (!$paymentFromQurban) {
                PaymentLog::dispatch($data, 'TRX_ID/No. Tagihan tidak tersedia, callback dihentikan.');
                echo '{"status":"999", "message":"Trx_id tidak tersedia"}';
                exit;
            }

            $paymentFromQurban->update([
                'payment_ntb' => $data['payment_ntb'],
                'payment_amount' => $data['payment_amount'],
                'datetime_payment' => $data['datetime_payment']
            ]);
        }

        DB::beginTransaction();
        $error = false;
        try {
            // update billing
            $billing->update([
                'is_paid' => ($data['cumulative_payment_amount'] === $data['trx_amount'] ? 'Y' : 'N'),
            ]);

            $type = substr($billing->trx_id, 0, 3);
            if ($type === 'TOP') {
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
                $biller_cpa = $billing->biller->cumulative_payment_amount;
                $balance_used = $billing->biller->balance_used + $billing->use_balance;
                $cpa_now = $biller_cpa + $data['cumulative_payment_amount'];
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

                PaymentLog::dispatch($data, 'Pembayaran Tagihan ' . $type . ' berhasil diproses. total kumulatif: ' . $cpa_now);
            }
        } catch (\Throwable $th) {
            $error = true;
            DB::rollBack();
            PaymentLog::dispatch($data, 'Pembayaran Tagihan ' . $type . ' GAGAL diproses. Message: ' . $th->getMessage());

            echo '{"status":"999"}';
            exit;
        }

        // klo transaksi tidak ada error
        if (!$error) {
            DB::commit();
            Paymented::dispatch($billing, $data);

            echo '{"status":"000"}';
            exit;
        }
    }
}
