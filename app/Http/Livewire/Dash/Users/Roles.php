<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    protected $listeners = [
        'closeUserAlertModal' => 'indexRoles',
        'closeRoleAlertModal' => 'indexRoles'
    ];

    public function render()
    {
        return view('livewire.dash.users.roles', [
            'roles' => Role::where('name', '<>', 'super-admin')->get()
        ]);
    }

    public function indexRoles()
    {
        # code...
    }
}
