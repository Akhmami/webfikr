<?php

namespace App\Console\Commands;

use App\Libraries\SheetDB;
use App\Models\Balance;
use App\Models\FailedSppBiller;
use App\Models\SetSpp;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing running code';

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
        foreach ($this->generator() as $item) {
            $user = User::where('username', $item->no_pendaftaran)
                ->first();

            if (!$user) {
                $this->error($item->nama . ' Tidak ditemukan');
                return;
            }

            SetSpp::where('user_id', $user->id)
                ->update(['nominal' => $item->new_komitmen]);

            $range = date_range($item->lunas);
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
                $spp_perbulan = $item->new_komitmen;
                # dapatkan bulan tunggakan hingga
                $addMonth = date('Y-m-d', strtotime("+ {$range} month", strtotime($item->lunas)));
                $month_only = tanggal($month[date('m', strtotime($addMonth))], 'bulan');

                $latest_biller = $user->billers()->latest('id')->first();
                if (date('Y-m', strtotime($latest_biller->created_at)) !== date('Y-m')) {
                    DB::beginTransaction();
                    try {
                        $user->billers()->where('type', 'SPP')
                            ->active()->update(['is_active' => 'N']);

                        $newBiller = $user->billers()->create([
                            'amount' => ($spp_perbulan * $range),
                            'type' => 'SPP',
                            'is_installment' => ($range > 1 ? 'Y' : 'N'),
                            'is_active' => 'Y',
                            'qty_spp' => $range,
                            'previous_spp_date' => $item->lunas,
                            'description' => 'Tagihan SPP hingga bulan ' . $month_only
                        ]);

                        for ($i = 1; $i <= $range; $i++) {
                            $addMonth = date('Y-m-d', strtotime("+ {$i} month", strtotime($item->lunas)));
                            $month_only = tanggal($month[date('m', strtotime($addMonth))], 'bulan');
                            $newBiller->billerDetails()->create([
                                'nama' => 'SPP Bulan ' . $month_only,
                                'nominal' => $spp_perbulan
                            ]);
                        }

                        if (!empty($item->saldo)) {
                            Balance::updateOrCreate([
                                'user_id' => $user->id
                            ], [
                                'last_amount' => 0,
                                'type' => 'plus',
                                'nominal' => $item->saldo,
                                'current_amount' => $item->saldo
                            ]);
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
            } else {
                DB::beginTransaction();
                try {
                    $user->billers()->where('type', 'SPP')
                        ->active()->update(['is_active' => 'N']);

                    $newBiller = $user->billers()->create([
                        'amount' => $item->new_komitmen,
                        'type' => 'SPP',
                        'is_installment' => 'N',
                        'is_active' => 'N',
                        'qty_spp' => 0,
                        'previous_spp_date' => '2021-09-01',
                        'description' => 'Tagihan SPP hingga bulan Oktober'
                    ]);

                    $newBiller->billerDetails()->create([
                        'nama' => 'SPP Bulan Oktober',
                        'nominal' => $item->new_komitmen
                    ]);

                    if (!empty($item->saldo)) {
                        Balance::updateOrCreate([
                            'user_id' => $user->id
                        ], [
                            'last_amount' => 0,
                            'type' => 'plus',
                            'nominal' => $item->saldo,
                            'current_amount' => $item->saldo
                        ]);
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

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/xrlq7ep52sbp5');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
