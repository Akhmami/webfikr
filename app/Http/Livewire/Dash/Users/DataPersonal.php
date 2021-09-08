<?php

namespace App\Http\Livewire\Dash\Users;

use Livewire\Component;

class DataPersonal extends Component
{
    public $user;

    protected $listeners = [
        'closeAlertValue' => 'index',
        'closePhoneAlertModal' => 'index'
    ];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.dash.users.data-personal');
    }

    public function index()
    {
        # code...
    }
}
