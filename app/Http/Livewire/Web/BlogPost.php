<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Post;

class BlogPost extends Component
{
    public $posts;

    public function render()
    {
        $this->posts = Post::published()->pinned()->latestFirst()->take(6)->get();

        return view('livewire.web.blog-post');
    }
}
