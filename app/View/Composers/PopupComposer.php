<?php

namespace App\Views\Composers;

use Illuminate\View\View;
use App\Models\Popup;

/**
 * view Composer
 */
class PopupComposer
{
    public function compose(View $view)
    {
        $this->composePopup($view);
    }

    private function composePopup(View $view)
    {
        $popup = Popup::where('status', 'show')->first();

        $view->with('popup', $popup);
    }
}
