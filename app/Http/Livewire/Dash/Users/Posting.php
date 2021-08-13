<?php

namespace App\Http\Livewire\Dash\Users;

use App\Models\UserPagePost;
use Livewire\Component;
use Livewire\WithPagination;

class Posting extends Component
{
    use WithPagination;

    public $limit = 10;

    public function render()
    {
        return view('livewire.dash.users.posting', [
            'posts' => UserPagePost::with('user')->latest()->paginate($this->limit)
        ]);
    }
}
