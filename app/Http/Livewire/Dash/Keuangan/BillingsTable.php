<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\Billing;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class BillingsTable extends DataTableComponent
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
            Column::make('Virtual Account', 'virtual_account')
                ->sortable()
                ->searchable(),
            Column::make('Jumlah', 'trx_amount')
                ->sortable()
                ->searchable(),
            Column::make('Status')
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.keuangan.status-column')->withData($row);
                }),
            Column::make('Actions')
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.keuangan.billing-actions')->withData($row);
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
        return Billing::query()
            ->with('user')
            ->latest()
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }

    public function indexBilling()
    {
        # code...
    }
}
