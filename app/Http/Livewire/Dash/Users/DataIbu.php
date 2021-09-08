<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;

class DataIbu extends Component
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
        return view('livewire.dash.users.data-ibu');
    }

    public function index()
    {
        # code...
    }
}
