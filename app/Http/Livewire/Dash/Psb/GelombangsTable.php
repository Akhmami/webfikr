<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Gelombang;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class GelombangsTable extends DataTableComponent
{
    protected $listeners = [
        'gelombangIndex' => '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama', 'nama')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.psb.gelombang-nama', ['data' => $row]);
                }),
            Column::make('Tgl Penting')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.psb.gelombang-tgl-penting', ['data' => $row]);
                }),
            Column::make('Biaya Pendaftaran')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return rupiah($value, false);
                })->asHtml(),
            Column::make('Status', 'is_active')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return $value == 'Y' ? 'active' : 'inactive';
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.psb.gelombang-actions', ['data' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'fromDate' => Filter::make('Dari tanggal')
                ->date([
                    'max' => now()->format('Y-m-d')
                ]),
            'toDate' => Filter::make('Sampai tanggal')
                ->date([
                    'max' => now()->format('Y-m-d')
                ])
        ];
    }

    /** @return Builder  */
    public function query(): Builder
    {
        return Gelombang::query()
            ->where('is_active', '<>', 'I')
            ->latest('id')
            ->when($this->getFilter('fromDate'), fn ($query, $fromDate) => $query->whereDate('created_at', '>=', $fromDate))
            ->when($this->getFilter('toDate'), fn ($query, $toDate) => $query->whereDate('created_at', '<=', $toDate));
    }
}
