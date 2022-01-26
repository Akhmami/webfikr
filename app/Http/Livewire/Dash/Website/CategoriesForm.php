<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use LivewireUI\Modal\ModalComponent;

class CategoriesForm extends ModalComponent
{
    public $title;
    public $slug;
    public $categoryId;

    protected $rules = [
        'title' => 'required|max:100',
    ];

    protected $messages = [
        'title.required' => 'Nama kategori harus diisi!',
        'title.max' => 'Judul maksimal 100 karakter'
    ];

    public function mount($id)
    {
        if (!is_null($id)) {
            $this->categoryId = $id;
            $this->title = Category::find($id)->title;
        }
    }

    public function render()
    {
        return view('livewire.dash.website.categories-form');
    }

    public function updatedTitle()
    {
        $this->slug = SlugService::createSlug(Category::class, 'slug', $this->title);
    }

    public function save()
    {
        $this->validate();
        Category::updateOrCreate([
            'id' => $this->categoryId
        ], [
            'title' => $this->title,
            'slug' => $this->slug
        ]);

        $this->closeModal();
        $this->emit('refreshCategory');

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Saved!',
            'text' => 'Data Berhasil Disimpan',
        ]);
    }
}
