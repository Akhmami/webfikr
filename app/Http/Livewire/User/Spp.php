<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Spp extends Component
{
    public $grades;

    public function mount()
    {
        $this->grades = auth()->user()
            ->grades()->with('spps')
            ->latest('nama')->get();
    }

    public function render()
    {
        return view('livewire.user.spp');
    }
}
