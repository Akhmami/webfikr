<?php

namespace App\Jobs;

use App\Models\Balance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $balance;
    public $payment_amount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Balance $balance, $payment_amount)
    {
        $this->balance = $balance;
        $this->payment_amount = $payment_amount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $currentAmount_from_last = $this->balance->current_amount ?? 0;
        $current_amount = $currentAmount_from_last + $this->payment_amount;
        Balance::create([
            'user_id' => $this->balance->user_id,
            'last_amount' => $currentAmount_from_last,
            'type' => 'plus',
            'nominal' => $this->payment_amount,
            'current_amount' => $current_amount,
            'description' => 'Tambah saldo'
        ]);
    }
}
