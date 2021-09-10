<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

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
        $users = User::has('activeGrade')->get();

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
                $spp_perbulan = $user->setSpp->current;
                # dapatkan bulan tunggakan hingga
                $adder = '+' . $range . ' month';
                $addMonth = date('Y-m-d', strtotime($adder, strtotime($user->latestSpp->bulan)));
                $month_only = tanggal($month[date('m', strtotime($addMonth))], 'bulan');

                $latest_biller = $user->billers()->latest()->first();
                if (date('Y-m', strtotime($latest_biller->created_at)) !== date('Y-m')) {
                    // $biller = $user->billers()->where('type', 'SPP')
                    //     ->active()->get();
                    // $tunggakan = $biller->sum('amount') - $biller->sum('cumulative_payment_amount');
                    $user->billers()->where('type', 'SPP')
                        ->active()->update(['is_active' => 'N']);

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
                        $adder = '+' . $i . ' month';
                        $addMonth = date('Y-m-d', strtotime($adder, strtotime($user->latestSpp->bulan)));
                        $month_only = tanggal($month[date('m', strtotime($addMonth))], 'bulan');
                        $newBiller->billerDetails()->create([
                            'nama' => 'SPP Bulan ' . $month_only,
                            'nominal' => $spp_perbulan
                        ]);
                    }
                }
            }
        }
    }
}
