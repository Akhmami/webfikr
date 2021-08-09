<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\PaymentHistory;

class RecentPayment extends Component
{
    private $limit = 5;

    public function render()
    {
        $billings = auth()->user()->billers()->pluck('id')->toArray();
        return view('livewire.user.recent-payment', [
            'payments' => PaymentHistory::whereIn('payment_history_id', $billings)->latest()->paginate($this->limit)
        ]);
    }
}
