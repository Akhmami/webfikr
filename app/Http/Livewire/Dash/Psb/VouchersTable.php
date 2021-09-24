<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class VouchersTable extends DataTableComponent
{
    protected $listeners = [
        'voucherIndex' => '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama Voucher', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Senilai', 'value')
                ->format(function ($value, $column, $row) {
                    return rupiah($row->nominal, false);
                })->asHtml(),
            Column::make('Quota', 'quota')
                ->sortable()
                ->searchable(),
            Column::make('Tersedia')
                ->format(function ($value, $column, $row) {
                    return $row->available;
                })->asHtml(),
            Column::make('Masa Berlaku', 'datetime_expired')
                ->sortable()
                ->searchable(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.psb.voucher-actions', ['data' => $row]);
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
        return Voucher::query()
            ->latest('id')
            ->when($this->getFilter('fromDate'), fn ($query, $fromDate) => $query->whereDate('created_at', '>=', $fromDate))
            ->when($this->getFilter('toDate'), fn ($query, $toDate) => $query->whereDate('created_at', '<=', $toDate));
    }
}
