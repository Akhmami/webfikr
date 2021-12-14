<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Biller;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        $virtual_account = Billing::active()->count();
        $tagihan = Biller::active()->count();
        $history = PaymentHistory::whereDate('datetime_payment', '>', Carbon::yesterday())->count();

        return view('dash.keuangan.index', [
            'virtual_account' => $virtual_account,
            'tagihan' => $tagihan,
            'history' => $history
        ]);
    }

    public function report()
    {
        return view('dash.keuangan.report');
    }

    public function callback()
    {
        return view('dash.keuangan.callback');
    }

    public function recallback(Request $request)
    {
        $data = json_decode($request->data);

        // check Billing
        $billing = Billing::with(['user', 'biller'])->where('trx_id', $data['trx_id'])->first();
        if (!$billing) {
            return 'Nomor Pembayaran tidak ditemukan';
        }

        // history pembayaran
        $history = PaymentHistory::firstOrCreate([
            'payment_ntb', $data['payment_ntb']
        ], [
            'user_id' => $billing->user->id,
            'customer_name' => $data['customer_name'],
            'virtual_account' => $data['virtual_account'],
            'payment_amount' => $data['payment_amount'],
            'datetime_payment' => $data['datetime_payment']
        ]);

        DB::beginTransaction();
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

                // if ($balance_used > 0) {
                //     $billing->user->balance()->decrement('current_amount', ($billing->use_balance ?? 0));
                // }

                // if ($type === 'SPP') {
                //     $grade = $billing->user->activeGrade()->first();
                //     $spp_billing = json_decode($billing->spp_pay_month);

                //     // create spp
                //     foreach ($spp_billing as $spp) {
                //         $billing->biller->billerDetails()->whereNull('is_paid')->first()->update([
                //             'is_paid' => 'Y'
                //         ]);

                //         $history->spps()->updateOrCreate([
                //             'grade_id' => $grade->id,
                //             'bulan' => $spp,
                //             'user_id' => $billing->user->id
                //         ]);
                //     }
                // }
            }

            DB::commit();

            return 'Proses ulang callback berhasil.';
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }
}
