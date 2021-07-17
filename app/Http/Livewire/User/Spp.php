<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\GradeUser;

class Spp extends Component
{
    public $grade_users;

    public function mount()
    {
        $user_id = auth()->user()->id;
        $this->grade_users = GradeUser::with('spps')
            ->where('user_id', $user_id)
            ->get()
            ->groupBy('grade_id')
            ->toBase();
    }

    public function render()
    {
        return view('livewire.user.spp');
    }
}
