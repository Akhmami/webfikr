<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class AlertModal extends ModalComponent
{
    public $title;
    public $description;

    public function mount($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.alert-modal');
    }

    public function close()
    {
        $this->emit('closeAlertModal');
        $this->forceClose()->closeModal();
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

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
