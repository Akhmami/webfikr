<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class PermissionCreate extends ModalComponent
{
    public $name;

    protected $rules = [
        'name' => 'required|min:3|max:50'
    ];

    protected $messages = [
        'name.required' => 'Nama permission tidak boleh kosong',
        'name.min' => 'Nama permission minimal 3 karakter',
        'name.max' => 'Nama permission maksimal 50 karakter'
    ];

    public function render()
    {
        return view('livewire.dash.users.permission-create');
    }

    public function create()
    {
        $validatedData = $this->validate();
        Permission::create($validatedData);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closePermissionAlertModal',
            'title' => 'Permission Created',
            'description' => 'Data permission yang dipilih berhasil dibuat!'
        ]);
    }
}
