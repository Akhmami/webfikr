<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

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
        $users = User::has('billerSpp', 'balance')->cursor();

        foreach ($users as $user) {
            $amount = $user->billerSpp->amount;
            $cpa = $user->billerSpp->cumulative_payment_amount;
            $cost_reduction = $user->billerSpp->cost_reduction;
            $balance_used = $user->billerSpp->balance_used;
            $total_amount = $amount - ($cpa + $cost_reduction + $balance_used);
            $balance = $user->balance->current_amount;

            if ($total_amount == $balance) {
                $this->error($user->name);
            }
        }
    }
}
