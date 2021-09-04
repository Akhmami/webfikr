<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Post;

/**
 * view Composer
 */
class SidebarComposer
{
    public function compose(View $view)
    {
        $this->composeCategories($view);

        $this->composePopularPosts($view);
    }

    private function composeCategories(View $view)
    {
        $categories = Category::with(['posts' => function ($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();

        $view->with('categories', $categories);
    }

    private function composePopularPosts(View $view)
    {
        $popularPosts = Post::published()->popular()->take(3)->get();
        $view->with('popularPosts', $popularPosts);
    }
}
