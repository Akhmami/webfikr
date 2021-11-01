<?php

namespace App\Http\Livewire\Dash\Users;

use App\Models\MobilePhone;
use Livewire\Component;

class DataPersonal extends Component
{
    public $user;

    protected $listeners = [
        'closeAlertValue' => '$refresh',
        'closePhoneAlertModal' => '$refresh'
    ];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.dash.users.data-personal');
    }

    public function setPrimary(MobilePhone $phone)
    {
        $this->user->mobilePhones()->update(['is_first' => 'N']);
        $phone->update(['is_first' => 'Y']);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => '',
            'text' => 'Nomor utama berhasil diubah',
        ]);

        $this->emit('closeAlertValue');
    }
}
