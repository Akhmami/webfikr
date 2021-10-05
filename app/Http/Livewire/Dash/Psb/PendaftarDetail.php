<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class PendaftarDetail extends ModalComponent
{
    public $user;

    protected $listeners = [
        'pendaftarDetail' => '$refresh'
    ];

    public function mount($user)
    {
        $this->user = User::with(['billerPsb', 'mobilePhones'])->findOrFail($user);
    }

    public function render()
    {
        return view('livewire.dash.psb.pendaftar-detail');
    }
}
