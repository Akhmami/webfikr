<?php

namespace App\Console\Commands;

use App\Libraries\SheetDB;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
                'DITERIMA' => 3,
                'CADANGAN' => 4,
                'TIDAK DITERIMA' => 5,
                'MUNDUR' => 6
            ];

            if (!$user) {
                $this->error($item->no_pendaftaran . ' Tidak ditemukan');
            } else {
                DB::beginTransaction();
                try {
                    $user->update([
                        'status_psb_id' => $statusPsb[$item->status_psb],
                        'status' => ($statusPsb[$item->status_psb] === 3 ? 'santri' : null),
                        'gelombang_id' => 6
                    ]);

                    $user->userDetail()->update([
                        'jenis_pendaftaran' => $item->jenis_pendaftaran,
                        'jenjang' => $item->jenjang,
                        'jurusan' => !empty($item->jurusan) ? $item->jurusan : $user->userDetail->jurusan_pilihan
                    ]);

                    if (empty($user->billerDupsb)) {
                        # buat biller
                        $biller = $user->billers()->create([
                            'type' => 'DUPSB',
                            'amount' => !empty($item->total) ? $item->total : 0,
                            'is_active' => 'Y',
                            'description' => 'Tagihan Daftar Ulang PSB'
                        ]);

                        $biller->billerDetails()->createMany([
                            [
                                'nama' => 'DPP',
                                'nominal' => !empty($item->dpp) ? $item->dpp : 0
                            ],
                            [
                                'nama' => 'DSPP',
                                'nominal' => !empty($item->dspp) ? $item->dspp : 0
                            ],
                            [
                                'nama' => 'SPP',
                                'nominal' => !empty($item->spp) ? $item->spp : 0
                            ],
                            [
                                'nama' => 'KOMITE',
                                'nominal' => !empty($item->komite) ? $item->komite : 0
                            ],
                            [
                                'nama' => 'WAKAF BUKU',
                                'nominal' => !empty($item->wakaf_buku) ? $item->wakaf_buku : 0
                            ],
                            [
                                'nama' => 'WAKAF ALQURAN',
                                'nominal' => !empty($item->wakaf_quran) ? $item->wakaf_quran : 0
                            ],
                            [
                                'nama' => 'QURBAN',
                                'nominal' => !empty($item->qurban) ? $item->qurban : 0
                            ],
                            [
                                'nama' => 'DANA KEUMATAN',
                                'nominal' => !empty($item->dana_keumatan) ? $item->dana_keumatan : 0
                            ],
                            [
                                'nama' => 'SUMBANGAN',
                                'nominal' => !empty($item->sumbangan_lain) ? $item->sumbangan_lain : 0
                            ]
                        ]);
                    }

                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    $this->error($item->no_pendaftaran . ' - ' . $th->getMessage());
                }
            }
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/gyl8eexa7h70r');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
