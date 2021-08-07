<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\PaymentHistory;
use Livewire\Component;

class PaymentHistories extends Component
{
    public function render()
    {
        return view('livewire.dash.keuangan.payment-histories', [
            'payments' => PaymentHistory::latest()->take(5)->get()
        ]);
    }
}
