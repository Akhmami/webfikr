<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostsForm extends Component
{
    public $postId;
    public $post;
    public $title;
    public $slug;
    public $category;
    public $categories;

    public function mount($postId)
    {
        if ($postId !== null) {
            $this->postId = $postId;
            $this->post = Post::find($postId);
        }

        $this->categories = Category::pluck('title', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.dash.website.posts-form');
    }

    public function updatedTitle()
    {
        $this->slug = SlugService::createSlug(Post::class, 'slug', $this->title);
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
