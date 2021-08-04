<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class BillerShow extends ModalComponent
{
    public $user;

    public function mount($user_id)
    {
        $this->user = User::with('activeBillers')->findOrfail($user_id);
    }

    public function render()
    {
        return view('livewire.dash.keuangan.biller-show');
    }
}
