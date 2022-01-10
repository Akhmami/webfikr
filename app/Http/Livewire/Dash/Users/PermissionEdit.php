<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends ModalComponent
{
    public $permission_id;
    public $name;

    protected $rules = [
        'name' => 'required|min:3|max:50'
    ];

    protected $messages = [
        'name.required' => 'Nama permission tidak boleh kosong',
        'name.min' => 'Nama permission minimal 3 karakter',
        'name.max' => 'Nama permission maksimal 50 karakter'
    ];

    public function mount(Permission $permission)
    {
        $this->permission_id = $permission->id;
        $this->name = $permission->name;
    }

    public function render()
    {
        return view('livewire.dash.users.permission-edit');
    }

    public function update(Permission $permission)
    {
        $validatedData = $this->validate();
        $permission->update($validatedData);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closePermissionAlertModal',
            'title' => 'Permission Updated',
            'description' => 'Data permission yang dipilih berhasil diupdate!'
        ]);
    }
}
