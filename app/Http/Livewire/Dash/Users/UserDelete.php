<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class UserDelete extends ModalComponent
{
    public $user_id;

    public function mount($user)
    {
        $this->user_id = $user;
    }

    public function render()
    {
        return view('livewire.dash.users.user-delete');
    }

    public function delete(User $user)
    {
        $user->delete();

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeUserAlertModal',
            'title' => 'User Deleted',
            'description' => 'Data user yang dipilih telah terhapus!'
        ]);
    }

    public static function modalMaxWidth(): string
    {
        // 'sm'
        // 'md'
        // 'lg'
        // 'xl'
        // '2xl'
        // '3xl'
        // '4xl'
        // '5xl'
        // '6xl'
        // '7xl'
        return 'sm';
    }
}
