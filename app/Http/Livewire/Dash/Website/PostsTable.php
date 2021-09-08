<?php

namespace App\Http\Livewire\Dash\Website;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class PostsTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Image')
                ->format(function ($value, $column, $row) {
                    return '<img src="' . $row->image_thumb_url . '" class="h-14 w-auto rounded" />';
                })->asHtml(),
            Column::make('Judul', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Viewer')
                ->sortable()
                ->searchable(),
            Column::make('Author')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->user->name;
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.keuangan.billing-actions', ['data' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make('Status Pembayaran')
                ->select([
                    '' => 'Semua',
                    'paid' => 'Terbayar',
                    'unpaid' => 'Belum',
                ])
        ];
    }

    /** @return Builder  */
    public function query(): Builder
    {
        return Post::query()
            ->latest()
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }
}
