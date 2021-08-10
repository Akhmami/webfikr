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

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        // return 'md md:max-w-xl lg:max-w-3xl xl:max-w-5xl';
        return 'sm';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
