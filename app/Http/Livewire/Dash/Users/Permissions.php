<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    protected $listeners = [
        'closePermissionAlertModal' => 'indexPermissions'
    ];

    public function render()
    {
        return view('livewire.dash.users.permissions', [
            'permissions' => Permission::get()
        ]);
    }

    public function indexPermissions()
    {
        # code...
    }
}
