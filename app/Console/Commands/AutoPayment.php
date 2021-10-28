<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AutoPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:autopay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pembayaran otomatis memotong saldo';

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
        $users = User::with('latestSpp', 'billerSPP')
            ->whereHas('balance', function ($query) {
                $query->where('current_amount', '>', 0);
            })
            ->where('status', 'santri')
            ->cursor();

        foreach ($users as $user) {
            # Get Biller SPP
            $amount = $user->billerSPP()->sum('amount');
            $cpa = $user->billerSPP()->sum('cumulative_payment_amount');
            $cost_reduction = $user->billerSPP()->sum('cost_reduction');
            $balance_used = $user->billerSPP()->sum('balance_used');
            $total_amount = $amount - ($cpa + $cost_reduction + $balance_used);
        }
    }
}
