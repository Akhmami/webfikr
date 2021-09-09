<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;

class SppUser extends Component
{
    public $grades;
    public $komitmen;
    public $user;

    protected $listeners = [
        'closeAlertValue' => 'index'
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->grades = $user->grades()
            ->with('spps')
            ->latest('nama')
            ->get();
    }

    public function render()
    {
        $this->komitmen = rupiah($this->user->setSpp->nominal);
        return view('livewire.dash.users.spp-user');
    }

    public function index()
    {
        # code...
    }
}
