<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Category;
use App\Models\User;
use App\Models\Year;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class RegisteredTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('No Pendaftaran', 'userDetail.no_pendaftaran')
                ->sortable()
                ->searchable(),
            Column::make('Nama Lengkap', 'name')
                ->sortable()
                ->searchable(),
            Column::make('JK', 'gender')
                ->sortable()
                ->searchable(),
            Column::make('Jenjang', 'userDetail.jenjang')
                ->sortable()
                ->searchable(),
            Column::make('Viewer', 'view_count')
                ->sortable()
                ->searchable(),
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
        $activeYear = Year::active()->first();

        return User::query()
            ->where('tahun_pendaftaran', $activeYear->periode)
            ->latest()
            ->when($this->getFilter('category_id'), fn ($query, $category_id) => $query->where('category_id', $category_id));
    }
}
