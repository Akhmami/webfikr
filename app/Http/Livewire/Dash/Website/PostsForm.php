<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Post;
use Livewire\Component;

class PostsForm extends Component
{
    public $postId;
    public $post;

    public function mount($postId)
    {
        if ($postId !== null) {
            $this->postId = $postId;
            $this->post = Post::find($postId);
        }
    }

    public function render()
    {
        return view('livewire.dash.website.posts-form');
    }

    public function save()
    {
        $validatedData = $this->validate();

        if (!is_null($this->postId)) {
            $this->post->update($validatedData);
        } else {
            Post::create($validatedData);
        }

        return redirect()->route('dash.webiste.index');
    }
}
