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
            $user = User::updateOrcreate([
                'name' => $item->nama,
                'email' => $item->nama . '@email.com',
                'username' => $item->username,
                'password' => bcrypt($item->password),
                'gender' => 'L',
                'status' => 'santri'
            ]);

            $biller = $user->billers()->create([
                'type' => 'LAINNYA',
                'amount' => !empty($item->tagihan) ? $item->tagihan : 0,
                'is_active' => 'Y',
                'is_installment' => 'Y',
                'description' => 'Tagihan Cicilan'
            ]);

            $biller->billerDetails()->create([
                'nama' => 'cicilan',
                'nominal' => !empty($item->tagihan) ? $item->tagihan : 0
            ]);
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/5lj7rvd7w74ln');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
