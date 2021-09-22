<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Category;
use App\Models\StatusPsb;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class StatusPsbTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Status')
                ->sortable()
                ->searchable(),
            Column::make('Deskripsi', 'description')
                ->sortable()
                ->searchable()
                ->addClass('break-all')
                ->format(function ($value, $column, $row) {
                    return $value;
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.psb.actions', ['data' => $row]);
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
        return StatusPsb::query()
            ->latest()
            ->when($this->getFilter('category_id'), fn ($query, $category_id) => $query->where('category_id', $category_id));
    }
}
