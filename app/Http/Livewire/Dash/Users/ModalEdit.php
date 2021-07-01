<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class ModalEdit extends ModalComponent
{
    public $user_id;
    public $name;
    public $email;
    public $roles;

    public function mount(User $user)
    {
        // Gate::authorize('update', $user);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.dash.users.modal-edit');
    }

    public function update(User $user)
    {
        $this->closeModal();
    }
}
