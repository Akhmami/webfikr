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
            Column::make('Nama Lengkap', 'customer_name')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.keuangan.name-payment-history', ['data' => $row]);
                }),
            Column::make('Virtual Account', 'virtual_account')
                ->sortable()
                ->searchable(),
            Column::make('Jumlah', 'payment_amount')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return rupiah($value, false);
                })
                ->asHtml(),
            Column::make('Tgl Bayar', 'datetime_payment')
                ->sortable()
                ->searchable(),
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
                ]),
        ];
    }

    public function query(): Builder
    {
        return PaymentHistory::query()
            ->with('paymentHistory')
            ->when($this->getFilter('fromDate'), fn ($query, $fromDate) => $query->whereDate('datetime_payment', '>=', $fromDate))
            ->when($this->getFilter('toDate'), fn ($query, $toDate) => $query->whereDate('datetime_payment', '<=', $toDate))
            ->latest('id');
    }
}
