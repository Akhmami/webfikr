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
        $users = User::with('setSpp', 'latestSpp', 'billerSPP')
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
                            # set inactive
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

                        DB::commit();
                    }
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
