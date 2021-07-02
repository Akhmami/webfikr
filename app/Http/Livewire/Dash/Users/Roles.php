<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public function render()
    {
        return view('livewire.dash.users.roles', [
            'roles' => Role::get()
        ]);
    }
}
