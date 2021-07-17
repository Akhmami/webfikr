<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\PaymentHistory;

class RecentPayment extends Component
{
    private $limit = 5;

    public function render()
    {
        return view('livewire.user.recent-payment', [
            'payments' => PaymentHistory::with('billing')->latest()->paginate($this->limit)
        ]);
    }
}
