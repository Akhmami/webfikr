<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Jobs\UserActivity;

class Spp extends Component
{
    public $grades;

    public function mount()
    {
        $this->grades = auth()->user()
            ->grades()->with('spps')
            ->latest('nama')->get();

        UserActivity::dispatch(auth()->user(), 'melihat daftar SPP terbayar');
    }

    public function render()
    {
        return view('livewire.user.spp');
    }
}
