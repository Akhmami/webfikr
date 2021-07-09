<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\PaymentHistory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class PaymentHistoriesTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Nama Lengkap', 'name')
                ->sortable()
                ->searchable()
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.keuangan.name-column')->withUser($row);
                }),
            Column::make('Virtual Account', 'virtual_account')
                ->sortable()
                ->searchable(),
            Column::make('Jumlah', 'amount')
                ->sortable()
                ->searchable(),
            Column::make('Status')
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.keuangan.status-column')->withUser($row);
                }),
            Column::make('Actions')
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.keuangan.actions')->withUser($row);
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

    public function query(): Builder
    {
        return PaymentHistory::query()
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }
}
