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
            $user = User::with(['spps', 'setSpp', 'billers', 'balance'])->where('username', $item->no_pendaftaran)->first();
            $spp = $user->spps->count();
            if ($spp != $item->lunas_bulan) {
                $this->error('>>>>>' . $item->nama_lengkap . ' DB:' . $spp . ' XL:' . $item->lunas_bulan . ' SPP Last:' . $user->spps()->latest()->first()->bulan);
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
