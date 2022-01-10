<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleEdit extends ModalComponent
{
    public $name;
    public $role_id;
    public $permissions;

    protected $rules = [
        'name' => 'required|min:3|max:50'
    ];

    protected $messages = [
        'name.required' => 'Nama role tidak boleh kosong',
        'name.min' => 'Nama role minimal 3 karakter',
        'name.max' => 'Nama role maksimal 50 karakter'
    ];

    public function mount(Role $role)
    {
        $this->name = $role->name;
        $this->role_id = $role->id;
        $this->permissions = $role->permissions->pluck('name');
    }

    public function render()
    {
        return view('livewire.dash.users.role-edit', [
            'all_permissions' => Permission::get()
        ]);
    }

    public function update(Role $role)
    {
        $validatedData = $this->validate();
        $role->update($validatedData);
        $role->syncPermissions($this->permissions);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeUserAlertModal',
            'title' => 'Role Updated',
            'description' => 'Data role yang dipilih berhasil diupdate!'
        ]);
    }
}
