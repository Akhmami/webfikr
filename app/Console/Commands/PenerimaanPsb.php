<?php

namespace App\Console\Commands;

use App\Libraries\SheetDB;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class PenerimaanPsb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:penerimaanpsb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Data from spreadsheet';

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
            $user = User::with('billerDupsb')->where('username', $item->no_pendaftaran)->first();
            $statusPsb = [
                'DITERIMA' => 3
            ];

            DB::beginTransaction();
            try {
                $user->update([
                    'status_psb_id' => $statusPsb[$item->status],
                    'status' => ($statusPsb[$item->status] === 3 ? 'santri' : null)
                ]);

                if (empty($user->billerDupsb)) {
                    # buat biller
                    $biller = $user->billers()->create([
                        'type' => 'DUPSB',
                        'amount' => $item->total,
                        'is_active' => 'Y',
                        'description' => 'Tagihan Daftar Ulang PSB'
                    ]);

                    $biller->billerDetails()->createMany([
                        [
                            'nama' => 'DPP',
                            'nominal' => $item->dpp
                        ],
                        [
                            'nama' => 'DSPP',
                            'nominal' => $item->dspp
                        ],
                        [
                            'nama' => 'SPP',
                            'nominal' => $item->spp
                        ],
                        [
                            'nama' => 'KOMITE',
                            'nominal' => $item->komite
                        ],
                        [
                            'nama' => 'WAKAF BUKU',
                            'nominal' => $item->wakaf_buku
                        ],
                        [
                            'nama' => 'WAKAF ALQURAN',
                            'nominal' => $item->wakaf_quran
                        ],
                        [
                            'nama' => 'QURBAN',
                            'nominal' => $item->qurban
                        ],
                        [
                            'nama' => 'DANA KEUMATAN',
                            'nominal' => $item->dana_keumatan
                        ],
                        [
                            'nama' => 'SUMBANGAN',
                            'nominal' => $item->sumbangan
                        ]
                    ]);
                }

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
