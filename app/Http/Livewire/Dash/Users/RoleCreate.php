<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleCreate extends ModalComponent
{
    public $name;
    public $permissions = [];

    protected $rules = [
        'name' => 'required|min:3|max:50'
    ];

    protected $messages = [
        'name.required' => 'Nama role tidak boleh kosong',
        'name.min' => 'Nama role minimal 3 karakter',
        'name.max' => 'Nama role maksimal 50 karakter'
    ];

    public function render()
    {
        return view('livewire.dash.users.role-create', [
            'all_permissions' => Permission::get()
        ]);
    }

    public function create()
    {
        $validatedData = $this->validate();
        $role = Role::create($validatedData);
        $role->givePermissionTo($this->permissions);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeRoleAlertModal',
            'title' => 'Role Created',
            'description' => 'Data role yang dipilih berhasil dibuat!'
        ]);
    }
}
