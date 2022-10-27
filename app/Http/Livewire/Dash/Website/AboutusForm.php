<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\About;
use Livewire\Component;

class AboutusForm extends Component
{
    public $postId;
    public $url_embed;
    public $url_read_more;
    public $body;
    public $about;

    protected $rules = [
        'url_embed' => 'required|max:250',
        'url_read_more' => 'nullable|max:250',
        'body' => 'required|max:350'
    ];

    protected $messages = [
        'url_embed.required' => 'URL embed tidak boleh kosong',
        'url_embed.max' => 'URL embed maksimal 250 karakter',
        'url_read_more.required' => 'URL read more tidak boleh kosong',
        'url_read_more.max' => 'URL readmore maksimal 250 karakter',
        'body.required' => 'Deskripsi singkat tidak boleh kosong',
        'body.max' => 'Deskripsi singkat maksimal 350 karakter'
    ];

    public function mount($postId)
    {
        if (!is_null($postId)) {
            $this->postId = $postId;
            $this->about = About::find($postId);
            $this->url_embed = $this->about->url_embed;
            $this->url_read_more = $this->about->url_read_more;
            $this->body = $this->about->body;
        }
    }

    public function render()
    {
        return view('livewire.dash.website.aboutus-form');
    }

    public function save()
    {
        $validatedData = $this->validate();
        About::updateOrCreate([
            'id' => $this->postId
        ], $validatedData);

        return redirect()->route('dash.views', 'about-us');
    }
}
