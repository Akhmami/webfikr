<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class RoleDelete extends ModalComponent
{
    public $role_id;

    public function mount($role)
    {
        $this->role_id = $role;
    }

    public function render()
    {
        return view('livewire.dash.users.role-delete');
    }

    public function delete(Role $role)
    {
        $role->delete();

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeUserAlertModal',
            'title' => 'Role Deleted',
            'description' => 'Data role yang dipilih telah terhapus!'
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
