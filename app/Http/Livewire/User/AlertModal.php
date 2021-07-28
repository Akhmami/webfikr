<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;

class AlertModal extends ModalComponent
{
    public $message;

    public function render()
    {
        return view('livewire.user.alert-modal');
    }

    // public static function modalMaxWidth(): string
    // {
    //     // 'sm'
    //     // 'md'
    //     // 'lg'
    //     // 'xl'
    //     // '2xl'
    //     // '3xl'
    //     // '4xl'
    //     // '5xl'
    //     // '6xl'
    //     // '7xl'
    //     return 'md md:max-w-xl lg:max-w-3xl xl:max-w-5xl';
    // }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
