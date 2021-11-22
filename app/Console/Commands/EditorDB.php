<?php

namespace App\Console\Commands;

use App\Libraries\SheetDB;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EditorDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:editdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit data dari database';

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
            $user = User::with('billers')->where('username', $item->no_pendaftaran)->first();

            if ($user) {
                $user->billers()->create([
                    'amount' => $item->nominal,
                    'type' => $item->jenis,
                    'description' => $item->deskripsi,
                    'is_installment' => ($item->cicil > 0 ? 'Y' : 'N'),
                    'qty_spp' => $item->cicil,
                ]);
                $this->info('OK');
            } else {
                $this->error('No Pendaftaran ' . $item->no_pendaftaran . ' tidak ditemukan');
            }
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/utdka6nyj5p5n');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
