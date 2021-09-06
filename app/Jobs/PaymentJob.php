<?php

namespace App\Jobs;

use App\Models\Biller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $biller;
    public $saldo_terpakai;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Biller $biller, $saldo_terpakai)
    {
        $this->biller = $biller;
        $this->saldo_terpakai = $saldo_terpakai;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        # Update Biller
        $biller_cpa = $this->biller->cumulative_payment_amount ?? 0;
        $cpa_now = $biller_cpa + $this->saldo_terpakai;
        $is_active = ($cpa_now < $this->biller->amount) ? 'Y' : 'N';

        $this->biller->update([
            'cumulative_payment_amount' => $this->saldo_terpakai,
            'is_active' => $is_active
        ]);
    }
}
