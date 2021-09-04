<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\YouTube;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Slider;
use App\Models\About;
use App\Models\Facility;

class PostController extends Controller
{
    protected $limit = 12;

    public function index()
    {
        $sliders = Slider::latest()->take(5)->get();
        $about = About::latest()->first();
        $facilities = Facility::with('subfacilities')->priority()->take(8)->get();

        return view('posts.index', compact(
            'sliders',
            'about',
            'facilities',
        ));
    }

    public function articles(Request $request)
    {
        $posts = Post::with('user')
            ->when($request->q, function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->q}%");
            })
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view("posts.views", compact('posts'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->with('user')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        $categories = $this->categories();

        return view("blog.views", compact('posts', 'categories'));
    }

    public function facilities(Request $request)
    {
        $facilities = Facility::when($request->q, function ($query) use ($request) {
            $query->where('title', 'like', "%{$request->q}%");
        })
            ->priority()
            ->paginate($this->limit);

        return view("blog.facilities", compact('facilities'));
    }

    public function subfacilities($id)
    {
        $subs = Facility::findOrFail($id);

        return $subs->subfacilities;
    }

    public function videos(Request $request)
    {
        $apikey = config('youtube.api_key');
        $channel_id = config('youtube.channel_id');
        $max_result = config('youtube.max_result'); // maksimal video yang ingin di tampilkan

        // Data value untuk get ke youtub API
        $keyword = $request->q;
        $page = $request->page;
        $video = new YouTube($apikey, $channel_id);
        $videoLists = $video->get($keyword, $page);

        return view('blog.videos', [
            'videoLists' => $videoLists
        ]);
    }

    public function author(User $author)
    {
        $authorName = $author->name;

        $posts = $author->posts()
            ->with('category')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view("blog.views", compact('posts', 'authorName'));
    }

    public function show(Post $post)
    {
        $post->increment('view_count');
        $categories = $this->categories();
        $popularPosts = $this->popularPosts();

        return view("posts.show", compact('post', 'categories', 'popularPosts'));
    }

    private function categories()
    {
        $categories = Category::orderBy('title', 'asc')->get();

        return $categories;
    }

    private function popularPosts()
    {
        $popularPosts = Post::published()->popular()->take(6)->get();
        return $popularPosts;
    }

    public function rekrutmen()
    {
        return redirect()->away('https://forms.gle/H48KZE6xAzYe6dN28');
    }
}
