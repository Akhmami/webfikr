<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\PostPsb;
use Illuminate\Http\Request;

class PostPsbController extends Controller
{
    public function index()
    {
        $posts = PostPsb::get();

        return view('dash.psb.posts-index', [
            'posts' => $posts
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = PostPsb::findOrfail($id);
        $post->content = $request->content;
        $post->save();

        return redirect(route('dash.psb.posts-index') . '#' . $post->slug);
    }
}
