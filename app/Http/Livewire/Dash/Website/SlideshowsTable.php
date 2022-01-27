<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SlideshowsTable extends DataTableComponent
{
    protected $listeners = [
        'delete',
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
                    return '<a href="' . $row->url . '" target="_blank" class="text-blue-700 font-semibold break-words hover:underline">' . $value . '</a>';
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.website.slideshows-actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Slider::query()
            ->latest();
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
        $slider = Slider::findOrFail($id);
        $image = $slider->image;
        $destination = config('cms.image.slider_directory');
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

        $slider->delete();
    }
}
