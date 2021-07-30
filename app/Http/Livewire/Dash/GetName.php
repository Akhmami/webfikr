<?php

namespace App\Http\Livewire\Dash;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class GetName extends ModalComponent
{
    public $term = '';
    public $title;
    public $path;

    public function mount($title, $path)
    {
        $this->title = $title;
        $this->path = $path;
    }

    public function render()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->search($this->term)->paginate(10);

        return view('livewire.dash.get-name', [
            'users' => $users
        ]);
    }

    public function clicked()
    {
        # code...
    }
}
