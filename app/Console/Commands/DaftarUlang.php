<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DaftarUlang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daftarulang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daftar ulang';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::query()
            ->with(['billers'])
            ->whereHas('activeGrade', function ($query) {
                $query->whereIn('nama', ['7', '8', '10', '11']);
            })
            ->cursor();

        foreach ($users as $user) {
            try {
                $noms = [
                    '7' => 3500000,
                    '8' => 6500000,
                    '10' => 3500000,
                    '11' => 6500000,
                ];

                $biller = $user->billers()
                    ->create([
                        'amount' => $noms[$user->activeGrade()->first()->nama],
                        'type' => 'DKT',
                        'is_installment' => 'N',
                        'is_active' => 'Y',
                        'description' => 'Tagihan DKT Tahun 2022'
                    ]);

                $biller->billerDetails()->create([
                    'nama' => 'DKT 2022 ',
                    'nominal' => $noms[$user->activeGrade()->first()->nama]
                ]);
            } catch (\Throwable $th) {
                $this->error($th->getMessage());
            }
        }
    }
}
