<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    public function render()
    {
        return view('livewire.dash.users.permissions', [
            'permissions' => Permission::get()
        ]);
    }
}
