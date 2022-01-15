<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Biller;
use App\Models\FailedSppBiller;
use App\Models\PaymentHistory;
use App\Models\User;
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

    public function resendWebhook(Request $request)
    {
        $data = json_decode($request->data, true);

        // check Billing
        $billing = Billing::with(['user', 'biller'])->where('trx_id', $data['trx_id'])->first();
        if (!$billing) {
            return 'Nomor Pembayaran tidak ditemukan';
        }

        // history pembayaran
        $history = PaymentHistory::firstOrCreate([
            'payment_ntb' => $data['payment_ntb']
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
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }

        return 'Proses ulang callback berhasil.';
    }

    public function recreateSPP(Request $request)
    {
        $billing = '';
        $user = User::with('setSpp', 'latestSpp', 'billerSPP')
            ->findOrFail($request->user_id);

        $range = date_range($user->latestSpp->bulan);
        $month = [
            '01' => 1,
            '02' => 2,
            '03' => 3,
            '04' => 4,
            '05' => 5,
            '06' => 6,
            '07' => 7,
            '08' => 8,
            '09' => 9,
            '10' => 10,
            '11' => 11,
            '12' => 12,
        ];

        if ($range > 0) {
            # buat tagihan
            $spp_perbulan = $user->setSpp->nominal;
            # dapatkan bulan tunggakan hingga
            $addMonth = date('Y-m-d', strtotime("+ {$range} month", strtotime($user->latestSpp->bulan)));
            $month_only = tanggal($month[date('m', strtotime($addMonth))], 'bulan');

            DB::beginTransaction();
            try {
                $latest_biller = $user->billers()->latest('id')->first();
                # Klo tagihan bulan ini belum ada
                if (date('Y-m', strtotime($latest_biller->created_at)) !== date('Y-m')) {
                    $spp_active = $user->billerSPP;

                    # masih ada tagihan SPP
                    if (!empty($spp_active)) {
                        $billing = $spp_active->activeBillings()->first();

                        if ($billing) {
                            return back()->withError('Ada pembayaran yang belum diselesaikan!');
                        }

                        # non aktifkan biller
                        $user->billerSPP()->update([
                            'is_active' => 'N',
                        ]);
                    }

                    # buat biller baru
                    $newBiller = $user->billers()->create([
                        'amount' => ($spp_perbulan * $range),
                        'type' => 'SPP',
                        'is_installment' => ($range > 1 ? 'Y' : 'N'),
                        'is_active' => 'Y',
                        'qty_spp' => $range,
                        'previous_spp_date' => $user->latestSpp->bulan,
                        'description' => 'Tagihan SPP hingga bulan ' . $month_only
                    ]);

                    for ($i = 1; $i <= $range; $i++) {
                        $addMonth = date('Y-m-d', strtotime("+ {$i} month", strtotime($user->latestSpp->bulan)));
                        $month_only = tanggal($month[date('m', strtotime($addMonth))], 'bulan');
                        $newBiller->billerDetails()->create([
                            'nama' => 'SPP Bulan ' . $month_only,
                            'nominal' => $spp_perbulan
                        ]);
                    }

                    FailedSppBiller::destroy($request->id);

                    DB::commit();
                    return back()->withSuccess('Tagihan SPP berhasil dibuat.');
                } else {
                    return back()->withError('Tagihan sudah tersedia, silahkan dicek kembali!');
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                return back()->withError('Tagihan SPP gagal dibuat Error:# ' . $th->getMessage());
            }
        } else {
            return back()->withError('Tidak ada tagihan');
        }
    }
}
