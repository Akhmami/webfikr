<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CategoriesTable extends DataTableComponent
{
    protected $listeners = [
        'refreshCategory' => '$refresh',
        'delete',
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama Kategori', 'title'),
            Column::make('Jml Artikel', 'jml')
                ->format(function ($value, $column, $row) {
                    return '<a href="' . route('category', $row->slug) . '" target="_blank" class="text-blue-700 hover:underline">' . $row->posts->count() . '</a>';
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.website.categories-actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Category::query()
            ->with('posts')->latest();
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
        Category::destroy($id);
    }
}
