<?php

namespace App\Http\Livewire\User;

use App\Models\MobilePhone;
use Livewire\Component;

class SettingPhones extends Component
{
    protected $listeners = [
        'closePhoneAlertModal' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.user.setting-phones', [
            'phones' => auth()->user()->mobilePhones
        ]);
    }

    public function setPrimary(MobilePhone $phone)
    {
        auth()->user()->mobilePhones()->update(['is_first' => 'N']);
        $phone->update(['is_first' => 'Y']);
    }
}
