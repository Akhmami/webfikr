<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class TopupBalance extends Component
{
    public $balance;

    public function render()
    {
        $this->balance = auth()->user()->balance->current_amount ?? 0;

        return view('livewire.user.topup-balance');
    }
}
