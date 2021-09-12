<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Post;
use App\Models\Category;
use App\Jobs\ProcessImageThumbnails;
use App\Jobs\RemoveImage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostsForm extends Component
{
    use WithFileUploads;

    public $postId;
    public $post;
    public $title;
    public $slug;
    public $body;
    public $published_at;
    public $category_id;
    public $image;
    public $image_edit;
    public $categories;

    protected $rules = [
        'title' => 'required',
        'slug' => 'required|unique:posts',
        // 'excerpt' => 'required',
        'body' => 'required',
        'published_at' => 'nullable|date_format:Y-m-d',
        'category_id' => 'required',
        'image' => 'nullable|mimes:jpg,jpeg,bmp,png'
    ];

    public function mount($postId)
    {
        if (!is_null($postId)) {
            $this->postId = $postId;
            $this->post = Post::find($postId);
            $this->title = $this->post->title;
            $this->slug = $this->post->slug;
            $this->body = $this->post->body;
            $this->published_at = $this->post->published_at->format('Y-m-d');
            $this->category_id = $this->post->category_id;
            $this->image_edit = $this->post->image_url;
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
        $length = config('cms.excerpt.length');
        $end    = config('cms.excerpt.end');
        $validatedData['excerpt'] = str_excerpt(strip_tags($this->body), $length, $end);

        if (!is_null($this->image)) {
            // if (method_exists($this->image, 'getClientOriginalExtension')) {
            $extension = $this->image->getClientOriginalExtension();
            $validatedData['image'] = 'nfbs-' . time() . '.' . $extension;
            $destination = config('cms.image.directory');
            $this->image->storeAs($destination, $validatedData['image']);
            $data = array(
                'file_name' => $validatedData['image'],
                'extension' => $extension,
                'width' => config('cms.image.thumbnail.width'),
                'height' => config('cms.image.thumbnail.height'),
                'destination' => config('cms.image.directory')
            );
            // }
        }

        if (!is_null($this->postId)) {
            $oldImage = $this->post->image;
            $post = tap($this->post)->update($validatedData);
            if ($oldImage !== $validatedData['image']) {
                RemoveImage::dispatch($oldImage, $data);
            }
        } else {
            $post = auth()->user()->posts()->create($validatedData);
        }

        if (!is_null($this->image)) {
            ProcessImageThumbnails::dispatch($post->image_url, $data);
        }

        return redirect()->route('dash.webiste.index');
    }
}
