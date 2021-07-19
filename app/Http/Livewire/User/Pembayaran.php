<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Pembayaran extends Component
{
    public $payments;

    public function render()
    {
        $this->payments = auth()->user()->billings()->active()->get();

        return view('livewire.user.pembayaran');
    }
}
