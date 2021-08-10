<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class AlertModal extends ModalComponent
{
    public $status;
    public $emit;
    public $title;
    public $description;

    public function mount($status, $emit, $title, $description)
    {
        $this->status = $status;
        $this->emit = $emit;
        $this->title = $title;
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.alert-modal');
    }

    public function close()
    {
        $this->emit($this->emit);
        if ($this->status === 'success') {
            $this->forceClose()->closeModal();
        } else {
            $this->closeModal();
        }
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
