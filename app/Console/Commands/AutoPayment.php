<?php

namespace App\Console\Commands;

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
        $user = auth()->user();
        $amount = $user->billers()->active()->sum('amount');
        $cpa = $user->billers()->active()->sum('cumulative_payment_amount');
        $cost_reduction = $user->billers()->active()->sum('cost_reduction');
        $balance_used = $user->billers()->active()->sum('balance_used');
        $bill_spp = $user->billerSPP;
        $bill_another = $user->billerAnother;
        $this->total_amount = $amount - ($cpa + $cost_reduction + $balance_used);
    }
}
