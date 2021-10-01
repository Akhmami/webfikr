<?php

namespace App\Console\Commands;

use App\Models\Biller;
use App\Models\FailedSppBiller;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckBillSPP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:billspp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek tagihan spp dan create tagihan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::has('activeGrade')
            ->with('setSpp', 'latestSpp', 'billerSPP')
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

                $latest_biller = $user->billers()->latest('id')->first();
                if (date('Y-m', strtotime($latest_biller->created_at)) !== date('Y-m')) {
                    DB::beginTransaction();
                    try {
                        $spp_active = $user->billerSPP;
                        # masih ada tagihan SPP
                        if (!empty($spp_active)) {
                            # tagihan SPP lebih dari 1 bulan, update
                            if ($range > 1) {
                                $user->billerSPP()->update([
                                    'amount' => ($spp_active->amount + $spp_perbulan),
                                    'qty_spp' => ($spp_active->qty_spp + 1),
                                    'is_installment' => 'Y',
                                    'is_active' => 'Y',
                                    'description' => 'Tagihan SPP hingga bulan ' . $month_only
                                ]);

                                $spp_active->billerDetails()->create([
                                    'nama' => 'SPP Bulan ' . $month_only,
                                    'nominal' => $spp_perbulan
                                ]);
                            }

                            # Tagihan aktif, tp jumlah tagihan 0
                            if ($range == 1) {
                                $user->billerSpp()->update([
                                    'is_active' => 'N'
                                ]);

                                # buat biller baru
                                $newBiller = $user->billers()->create([
                                    'amount' => $spp_perbulan,
                                    'type' => 'SPP',
                                    'is_installment' => 'N',
                                    'is_active' => 'Y',
                                    'qty_spp' => $range,
                                    'previous_spp_date' => $user->latestSpp->bulan,
                                    'description' => 'Tagihan SPP hingga bulan ' . $month_only
                                ]);

                                $newBiller->billerDetails()->create([
                                    'nama' => 'SPP Bulan ' . $month_only,
                                    'nominal' => $spp_perbulan
                                ]);
                            }
                        } else {
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
                        }

                        DB::commit();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        FailedSppBiller::create([
                            'user_id' => $user->id,
                            'name' => $user->name,
                            'exception' => $th->getMessage()
                        ]);
                    }
                }
            }
        }
    }
}
