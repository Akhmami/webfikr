<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\Billing;

class BillingDetail extends ModalComponent
{
    public $billing;

    public function mount($billing)
    {
        $this->billing = Billing::with([
            'user', 'paymentHistories'
        ])->findOrFail($billing);
    }

    public function render()
    {
        return view('livewire.dash.keuangan.billing-detail');
    }


}
