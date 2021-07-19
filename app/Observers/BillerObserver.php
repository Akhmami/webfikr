<?php

namespace App\Observers;

use App\Models\Biller;

class BillerObserver
{
    /**
     * Handle the Biller "created" event.
     *
     * @param  \App\Models\Biller  $biller
     * @return void
     */
    public function created(Biller $biller)
    {
        //
    }

    /**
     * Handle the Biller "updated" event.
     *
     * @param  \App\Models\Biller  $biller
     * @return void
     */
    public function updated(Biller $biller)
    {
        if ($biller->cumulative_payment_amount >= $biller->amount) {
            $biller->update(['is_active', 'N']);
        }
    }

    /**
     * Handle the Biller "deleted" event.
     *
     * @param  \App\Models\Biller  $biller
     * @return void
     */
    public function deleted(Biller $biller)
    {
        //
    }

    /**
     * Handle the Biller "restored" event.
     *
     * @param  \App\Models\Biller  $biller
     * @return void
     */
    public function restored(Biller $biller)
    {
        //
    }

    /**
     * Handle the Biller "force deleted" event.
     *
     * @param  \App\Models\Biller  $biller
     * @return void
     */
    public function forceDeleted(Biller $biller)
    {
        //
    }
}
