<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class BillingName extends ModalComponent
{
    public $term = '';

    public function render()
    {
        $users = User::search($this->term)->paginate(10);

        return view('livewire.dash.keuangan.billing-name', [
            'users' => $users
        ]);
    }

    public function clicked()
    {
        # code...
    }
}
