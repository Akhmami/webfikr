<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\Biller;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class BillersTable extends DataTableComponent
{
    protected $listeners = [
        'closeBillingAlertModal' => 'indexBilling'
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama Lengkap', 'user.name')
                ->sortable()
                ->searchable(),
            Column::make('Tunggakan', 'type')
                ->sortable()
                ->searchable(),
            Column::make('Jumlah', 'amount')
                ->sortable()
                ->searchable(),
            Column::make('Terbayar', 'cumulative_payment_amount')
                ->sortable()
                ->searchable(),
            Column::make('Status')
                ->format(function($value, $column, $row) {
                    return view('dash.keuangan.status-biller')->withData($row);
                }),
            Column::make('Actions')
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.keuangan.actions')->withData($row);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make('Status Tunggakan')
                ->select([
                    '' => 'Semua',
                    'Y' => 'Active',
                    'N' => 'Inactive',
                ])
        ];
    }

    public function query(): Builder
    {
        return Biller::query()
            ->with('user')
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }

    public function indexBilling()
    {
        # code...
    }
}
