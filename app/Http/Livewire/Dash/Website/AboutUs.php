<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\About;
use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        $about = About::latest()->first();

        return view('livewire.dash.website.about-us', [
            'about' => $about
        ]);
    }
}
