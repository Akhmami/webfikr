<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class TopupBalance extends Component
{
    public $balance;

    protected $listeners = [
        'closeBalanceAlertModal' => 'indexBalance'
    ];

    public function render()
    {
        $total_balance = auth()->user()->balance->current_amount ?? 0;
        $used_balance = auth()->user()->billings()->active()->sum('use_balance');
        $this->balance = $total_balance - $used_balance;

        return view('livewire.user.topup-balance');
    }

    public function indexBalance()
    {
        # code...
    }
}
