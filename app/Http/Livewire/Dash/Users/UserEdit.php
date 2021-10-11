<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserEdit extends ModalComponent
{
    public $user_id;
    public $name;
    public $email;
    public $roles;

    protected $rules = [
        'name' => 'required|min:3|max:150',
        'email' => 'required|email',
        'roles' => 'nullable'
    ];

    protected $messages = [
        'name.required' => 'Nama lengkap tidak boleh kosong',
        'name.min' => 'Nama lengkap minimal 3 karakter',
        'name.max' => 'Nama lengkap maksimal 150 karakter',
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Alamat email tidak valid'
    ];

    public function mount(User $user)
    {
        // Gate::authorize('update', $user);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->getRoleNames();
    }

    public function render()
    {
        return view('livewire.dash.users.user-edit', [
            'all_roles' => Role::get()
        ]);
    }

    public function update(User $user)
    {
        $validatedData = $this->validate();
        $user->update($validatedData);
        $user->syncRoles($this->roles);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'User Updated',
            'text' => 'Data user yang dipilih berhasil diupdate!',
        ]);

        $this->forceClose()->closeModal();
    }
}
