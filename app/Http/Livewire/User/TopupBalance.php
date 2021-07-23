<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class TopupBalance extends Component
{
    public $balance;

    public function render()
    {
        $total = auth()->user()
            ->balances()
            ->where('is_paid', 'Y')
            ->sum('payment_amount');

        $usage = auth()->user()
            ->balanceUsages()
            ->sum('trx_amount');

        $this->balance = $total - $usage;

        return view('livewire.user.topup-balance');
    }
}
