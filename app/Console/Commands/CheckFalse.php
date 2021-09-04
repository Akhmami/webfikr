<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Libraries\SheetDB;
use App\Models\User;

class CheckFalse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:checkfalse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
            // udah lunas berapa bulan
            try {
                $user = User::with(['spps', 'setSpp', 'billers', 'balance'])->where('username', $item->no_pendaftaran)->first();
                $spp = $user->spps()->count();
            } catch (\Throwable $th) {
                //throw $th;
                $spp = 0;
                $this->info($item->nama_lengkap);
                $th->getMessage();
            }

            if ($spp != $item->lunas_bulan) {

                $spp_paid = [
                    '1' => '2021-07-01', '2' => '2021-08-01', '3' => '2021-09-01', '4' => '2021-10-01',
                    '5' => '2021-11-01', '6' => '2021-12-01', '7' => '2022-01-01', '8' => '2022-02-01',
                    '9' => '2022-03-01', '10' => '2022-04-01', '11' => '2022-05-01', '12' => '2022-06-01'
                ];

                if ($item->lunas_bulan > $spp) {
                    $this->error('>>>>>' . $item->nama_lengkap . ' DB:' . $spp . ' XL:' . $item->lunas_bulan . ' SPP Last:' . $user->spps()->latest()->first()->bulan);
                    if ($item->komitmen_spp > 0) {
                        $biller = $user->billers()->where('type', 'SPP')->active()->latest('id')->first();
                        $biller->update([
                            'amount' => (3 - $item->lunas_bulan) * $user->setSpp->nominal,
                            'is_installment' => ((3 - $item->lunas_bulan) > 1 ? 'Y' : 'N'),
                            'is_active' => 'Y',
                            'qty_spp' => (3 - $item->lunas_bulan),
                            'previous_spp_date' => $spp_paid[$item->lunas_bulan] ?? null
                        ]);

                        // add spps
                        $grades = ['7' => 1, '8' => 2, '9' => 3, '10' => 4, '11' => 5, '12' => 6];
                        $user->spps()->create([
                            'grade_id' => $grades[$item->kelas],
                            'payment_history_id' => null,
                            'bulan' => $spp_paid[$item->lunas_bulan]
                        ]);

                        // kelebihan pembayaran
                        if ($item->kelebihan > 0) {
                            $currentAmount_from_last = $user->balance->current_amount ?? 0;
                            $current_amount = $currentAmount_from_last + $item->kelebihan;
                            $user->balance()->create([
                                'last_amount' => $currentAmount_from_last,
                                'type' => 'plus',
                                'nominal' => $item->kelebihan,
                                'current_amount' => $current_amount,
                                'description' => 'Tambah saldo'
                            ]);
                        }

                        $this->info('Success');
                    }
                }
            }
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/e1wz3g0j0p2mo');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
