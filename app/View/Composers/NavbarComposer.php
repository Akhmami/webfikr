<?php

namespace App\Views\Composers;

use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Post;

/**
 * view Composer
 */
class NavbarComposer
{
    public function compose(View $view)
    {
        $this->composeNavbar($view);
    }

    private function composeNavbar(View $view)
    {
        $info = Post::published()->info()->latestFirst()->first();
        $primaryMenu = Menu::with('submenus')->where('type', 'primary')->get();
        $footerMenu = Menu::with('submenus')->where('type', 'footer')->get();
        $view->with(['info' => $info, 'primaryMenu' => $primaryMenu, 'footerMenu' => $footerMenu]);

        dd($info);
    }
}
