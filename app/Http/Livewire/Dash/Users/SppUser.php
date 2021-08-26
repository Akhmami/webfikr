<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;

class SppUser extends Component
{
    public $grades;

    public function mount($user)
    {
        $this->grades = $user->grades()
            ->with('spps')
            ->latest('nama')
            ->get();
    }

    public function render()
    {
        return view('livewire.dash.users.spp-user');
    }
}
