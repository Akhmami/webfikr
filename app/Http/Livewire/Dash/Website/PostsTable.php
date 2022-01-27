<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class PostsTable extends DataTableComponent
{
    protected $listeners = [
        'delete'
    ];

    public function columns(): array
    {
        return [
            Column::make('Gambar')
                ->format(function ($value, $column, $row) {
                    return '<img src="' . $row->image_thumb_url . '" class="h-auto w-28 rounded" />';
                })->asHtml(),
            Column::make('Judul', 'title')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.website.title', ['data' => $row]);
                }),
            Column::make('Dilihat', 'view_count')
                ->sortable()
                ->searchable(),
            Column::make('Penulis', 'user.name')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return '<a href="#" class="text-gray-600">' . $row->user->name . '</a>';
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.website.actions', ['data' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        $init = ['' => 'Semua'];
        $categories = Category::pluck('title', 'id')->toArray();
        $category_arr = $init + $categories;
        return [
            'category_id' => Filter::make('Kategori')
                ->select($category_arr)
        ];
    }

    /** @return Builder  */
    public function query(): Builder
    {
        return Post::query()
            ->with(['user', 'category'])
            ->latest()
            ->when($this->getFilter('category_id'), fn ($query, $category_id) => $query->where('category_id', $category_id));
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Yakin ingin menghapus?',
            'text' => '',
            'id' => $id,
            'method' => 'delete'
        ]);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $image = $post->image;
        $destination = config('cms.image.directory');
        $imagePath = $destination . '/' . $image;
        $ext = substr(strrchr($image, '.'), 1);
        $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
        $thumbnailPath = $destination . '/' . $thumbnail;

        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        if (Storage::exists($thumbnailPath)) {
            Storage::delete($thumbnailPath);
        }

        $post->delete();
    }
}
