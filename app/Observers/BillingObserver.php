<?php

namespace App\Observers;

use App\Models\Billing;

class BillingObserver
{
    /**
     * Handle the Billing "creating" event.
     *
     * @param  \App\Models\Billing  $billing
     * @return void
     */
    public function creating(Billing $billing)
    {

    }

    /**
     * Handle the Billing "created" event.
     *
     * @param  \App\Models\Billing  $billing
     * @return void
     */
    public function created(Billing $billing)
    {
        //
    }

    /**
     * Handle the Billing "updated" event.
     *
     * @param  \App\Models\Billing  $billing
     * @return void
     */
    public function updated(Billing $billing)
    {
        //
    }

    /**
     * Handle the Billing "deleted" event.
     *
     * @param  \App\Models\Billing  $billing
     * @return void
     */
    public function deleted(Billing $billing)
    {
        //
    }

    /**
     * Handle the Billing "restored" event.
     *
     * @param  \App\Models\Billing  $billing
     * @return void
     */
    public function restored(Billing $billing)
    {
        //
    }

    /**
     * Handle the Billing "force deleted" event.
     *
     * @param  \App\Models\Billing  $billing
     * @return void
     */
    public function forceDeleted(Billing $billing)
    {
        //
    }
}
