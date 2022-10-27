<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Post;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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

    protected $listeners = [
        'refreshCategory'
    ];

    public function mount($postId)
    {
        if (!is_null($postId)) {
            $this->postId = $postId;
            $this->post = Post::find($postId);
            $this->title = $this->post->title;
            $this->slug = $this->post->slug;
            $this->body = $this->post->body;
            $this->published_at = !is_null($this->post->published_at) ? $this->post->published_at->format('Y-m-d') : null;
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
        $validatedData['published_at'] = !empty($this->published_at) ? $this->published_at : null;
        $length = config('cms.excerpt.length');
        $end    = config('cms.excerpt.end');
        $validatedData['excerpt'] = str_excerpt(strip_tags($this->body), $length, $end);

        if (!is_null($this->image)) {
            // if (method_exists($this->image, 'getClientOriginalExtension')) {
            $extension = $this->image->getClientOriginalExtension();
            $validatedData['image'] = 'nfbs-' . time() . '.' . $extension;
            $destination = config('cms.image.directory');
            $width = config('cms.image.thumbnail.width');
            $height = config('cms.image.thumbnail.height');
            $this->image->storeAs($destination, $validatedData['image']);
            // }
        }

        if (!is_null($this->postId)) {
            if (!is_null($this->image)) {
                $oldImage = $this->post->image;
                $post = tap($this->post)->update($validatedData);

                if ($oldImage !== $post->image) {
                    $imagePath = $destination . '/' . $oldImage;
                    $ext = substr(strrchr($oldImage, '.'), 1);
                    $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $oldImage);
                    $thumbnailPath = $destination . '/' . $thumbnail;

                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                    if (Storage::exists($thumbnailPath)) {
                        Storage::delete($thumbnailPath);
                    }
                }
            } else {
                $this->post->title = $validatedData['title'];
                $this->post->slug = $validatedData['slug'];
                $this->post->body = $validatedData['body'];
                $this->post->category_id = $validatedData['category_id'];
                $this->post->published_at = $validatedData['published_at'];
                $post = $this->post->save();
            }
        } else {
            $post = auth()->user()->posts()->create($validatedData);
        }

        if (!is_null($this->image)) {
            $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $validatedData['image']);
            Image::make($this->image->getRealPath())
                ->resize($width, $height)
                ->save(storage_path('app/' . $destination . '/' . $thumbnail));
        }

        return redirect()->route('dash.index');
    }

    public function refreshCategory()
    {
        $this->categories = Category::pluck('title', 'id')->toArray();
    }

    protected function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->postId,
            // 'excerpt' => 'required',
            'body' => 'required',
            'published_at' => 'nullable|date_format:Y-m-d',
            'category_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png'
        ];
    }
}
