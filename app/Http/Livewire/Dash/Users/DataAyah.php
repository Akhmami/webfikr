<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;

class DataAyah extends Component
{
    public $user;

    protected $listeners = [
        'closeAlertValue' => 'index'
    ];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.dash.users.data-ayah');
    }

    public function index()
    {
        # code...
    }
}
