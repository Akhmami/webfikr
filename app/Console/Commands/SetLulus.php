<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetLulus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:lulus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set status lulus kelas 9 12';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        DB::transaction(function () {
            $users = User::with('billerSPP')->whereHas('activeGrade', function ($query) {
                    $query->whereIn('nama', ['9', '12']);
                })
                ->cursor();
            foreach ($users as $user) {
                // 1. Set Lulus
                // $user->update([
                //     'status' => 'lulus'
                // ]);

                // 2. Delete Latest Biller SPP
                if (empty($user->billerSPP)) {
                    continue;
                }

                $spp = $user->billerSPP->amount / $user->billerSPP->qty_spp;
                $reelAmount = $user->billerSPP->amount - $spp;
                $reelSpp = $user->billerSPP->qty_spp - 1;

                if (($reelAmount - ($user->billerSPP->cumulative_payment_amount + $user->billerSPP->balance_used)) < 1) {
                    $user->billerSPP->update([
                        'is_active' => 'N'
                    ]);
                }

                $user->billerSPP->update([
                    'amount' => $reelAmount,
                    'qty_spp' => $reelSpp,
                    'description' => 'Tagihan SPP hingga bulan Juni'
                ]);

                $user->billerSPP->billerDetails()
                    ->latest('id')
                    ->first()
                    ->delete();
            }
        });
    }
}
