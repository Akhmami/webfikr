<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Pembayaran extends Component
{
    public $payments;

    public function render()
    {
        $this->payments = auth()->user()->billings()
            ->where('is_paid', 'N')->get();

        return view('livewire.user.pembayaran');
    }
}
