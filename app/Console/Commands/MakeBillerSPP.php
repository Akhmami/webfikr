<?php

namespace App\Console\Commands;

use App\Libraries\VA;
use App\Models\Billing;
use App\Models\FailedSppBiller;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MakeBillerSPP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:makebillerspp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin tagihan SPP baru';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $billing = '';
        $users = User::has('grades')
            ->with('setSpp', 'latestSpp', 'billerSPP')
            ->where('status', 'santri')
            ->cursor();

        foreach ($users as $user) {
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

                            # non aktifkan billing atau VA
                            $this->inactivingBilling($billing);

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

                        # Aktifkan ulang Billing atau VA
                        $this->activingBilling($newBiller, $billing);

                        DB::commit();
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    FailedSppBiller::create([
                        'user_id' => $user->id,
                        'name' => $user->name . ' => Gagal membuat Tagihan SPP',
                        'exception' => $th->getMessage()
                    ]);
                }
            }
        }
    }

    public function inactivingBilling($billing)
    {
        if (!empty($billing)) {
            $data = array(
                'trx_id' => $billing->trx_id,
                'trx_amount' => $billing->trx_amount,
                'customer_name' => $billing->customer_name,
                'datetime_expired' => date('c', strtotime('now'))
            );

            $va = new VA;
            $result = $va->update($data);
            if ($result['status'] !== '000') {
                throw new \Exception('Inactiving gagal #' . $result['status']);
            }

            $billing->update([
                'datetime_expired' => now()
            ]);
        }
    }

    public function activingBilling($biller, $billing)
    {
        if (!empty($billing)) {
            $data = array(
                'trx_id' => $billing->trx_id . mt_rand(100, 999),
                'virtual_account' => $billing->virtual_account,
                'trx_amount' => $billing->trx_amount,
                'billing_type' => 'c',
                'customer_name' => $billing->customer_name,
                'description' => $billing->description,
                'datetime_expired' => date('c', strtotime('5 days'))
            );

            $va = new VA;
            $result = $va->create($data);

            if ($result['status'] !== '000') {
                throw new \Exception('Aktifasi billing gagal #' . $result['status']);
            } else {
                $data['user_id'] = $biller->user_id;
                $data['spp_pay_month'] = $billing->spp_pay_month;
                $data['use_balance'] = $billing->use_balance;
                $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('5 days'));
                $biller->billings()->create($data);
            }
        }
    }
}
