<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class PermissionDelete extends ModalComponent
{
    public $permission_id;

    public function mount($permission)
    {
        $this->permission_id = $permission;
    }

    public function render()
    {
        return view('livewire.dash.users.permission-delete');
    }

    public function delete(Permission $role)
    {
        $role->delete();

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closePermissionAlertModal',
            'title' => 'Permission Deleted',
            'description' => 'Data permission yang dipilih telah terhapus!'
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
