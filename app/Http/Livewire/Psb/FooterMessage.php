<?php

namespace App\Http\Livewire\Psb;

use Livewire\Component;

class FooterMessage extends Component
{
    protected $listeners = ['showFlash'];

    public function showFlash($status, $message)
    {
        session()->flash($status, $message);
    }

    public function render()
    {
        return view('livewire.psb.footer-message');
    }
}
