<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('dash.website.posts-index');
    }

    public function views($item)
    {
        $components = [
            'posts' => 'dash.website.posts-index',
            'slideshows' => 'dash.website.slideshows-index',
            'categories' => 'dash.website.categories-index',
            'info' => 'dash.website.info-index'
        ];

        if (!array_key_exists($item, $components)) {
            return abort(404);
        }

        return view($components[$item], ['item' => $item]);
    }

    public function create($item)
    {
        $components = [
            'posts' => 'dash.website.posts-form',
            'slideshows' => 'dash.website.slideshows-form',
            'categories' => 'dash.website.categories-form',
            'info' => 'dash.website.info-form'
        ];

        if (!array_key_exists($item, $components)) {
            return abort(404);
        }

        return view($components[$item], [
            'postId' => null, 'title' => 'Buat Artikel'
        ]);
    }

    public function edit($item, $id)
    {
        $components = [
            'posts' => 'dash.website.posts-form',
            'slideshows' => 'dash.website.slideshows-form',
            'categories' => 'dash.website.categories-form',
            'info' => 'dash.website.info-form'
        ];

        if (!array_key_exists($item, $components)) {
            return abort(404);
        }

        return view($components[$item], [
            'postId' => $id,
            'title' => 'Edit Artikel'
        ]);
    }
}
