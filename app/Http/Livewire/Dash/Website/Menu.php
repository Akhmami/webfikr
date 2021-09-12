<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Category;
use App\Models\Post;
use App\Models\Slider;
use Livewire\Component;

class Menu extends Component
{
    public $articles;
    public $categories;
    public $slideshows;
    public $info;

    public function render()
    {
        $this->articles = Post::count();
        $this->categories = Category::count();
        $this->slideshows = Slider::count();
        $this->info = Post::where('category_id', config('cms.info_category_id'))->count();

        return view('livewire.dash.website.menu');
    }
}
