<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GradeUser;

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
        $items = GradeUser::where('is_active', 'Y')->cursor();
        foreach ($items as $item) {
            $user = $item->user;
            $range = date_range($item->latestSpp->bulan);
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
                $adder = '+'.$range.' month';
                $addMonth = date('Y-m-d', strtotime($adder, strtotime($item->latestSpp->bulan)));
                $month_only = tanggal($month[date('m', strtotime($addMonth))], 'bulan');

                $latest_biller = $user->billers()->latest()->first();
                if (date('m', strtotime($latest_biller->created_at)) !== date('m')) {
                    $biller = $user->billers()->where('type', 'SPP')
                        ->active()->get();
                    $tunggakan = $biller->sum('amount');
                    $user->billers()->where('type', 'SPP')
                        ->active()->update(['is_active' => 'N']);

                    $user->billers()->create([
                        'amount' => $tunggakan + ($spp_perbulan * $range),
                        'type' => 'SPP',
                        'is_active' => 'Y',
                        'qty_spp' => $range,
                        'previous_spp_date' => $item->latestSpp->bulan,
                        'description' => 'Tagihan SPP hingga bulan '. $month_only
                    ]);
                }
            }
        }
    }
}
