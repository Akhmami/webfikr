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
            Column::make('ID Pembayaran', 'payment_ntb')
                ->sortable()
                ->searchable(),
            Column::make('Nama Lengkap', 'customer_name')
                ->sortable()
                ->searchable(),
            Column::make('Virtual Account', 'virtual_account')
                ->sortable()
                ->searchable(),
            Column::make('Jumlah', 'payment_amount')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Bayar', 'datetime_payment')
                ->sortable()
                ->searchable(),
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
            ->with('paymentHistory')
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }
}
