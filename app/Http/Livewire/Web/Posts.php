<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts;

    protected $listeners = [
        'popular',
        'teacherNote',
        'newest'
    ];

    public function mount($posts)
    {
        $this->posts = $posts;
    }

    public function render()
    {
        return view('livewire.web.posts');
    }

    public function popular()
    {
        $this->posts = Post::with('author')->published()->popular()->take(6)->get();
    }

    public function teacherNote()
    {
        $this->posts = Post::with('author')->published()->teacherNote()->latestFirst()->take(6)->get();
    }

    public function newest()
    {
        $this->posts = Post::published()->pinned()->latestFirst()->take(6)->get();
    }
}
