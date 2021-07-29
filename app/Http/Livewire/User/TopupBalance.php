<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class TopupBalance extends Component
{
    public $balance;

    public function render()
    {
        $total = auth()->user()
            ->billings()
            ->where('is_balance', 'Y')
            ->where('is_paid', 'Y')
            ->sum('trx_amount');

        $usage = auth()->user()
            ->balanceUsages()
            ->sum('trx_amount');

        $this->balance = $total - $usage;

        return view('livewire.user.topup-balance');
    }
}
