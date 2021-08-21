<?php

namespace App\Http\Livewire\Dash\Users;

use App\Models\PaymentHistory;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class PaymentHistoryTable extends DataTableComponent
{
    public $user_id;

    public function mount($user)
    {
        $this->user_id = $user;
    }

    public function columns(): array
    {
        return [
            Column::make('ID pembayaran', 'payment_ntb')
                ->sortable()
                ->searchable(),
            Column::make('Customer name')
                ->sortable()
                ->searchable(),
            Column::make('Jumlah bayar', 'payment_amount')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return rupiah($value, false);
                }),
            Column::make('Tanggal bayar', 'datetime_payment')
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
                ])
        ];
    }

    public function query(): Builder
    {
        return PaymentHistory::query()
            ->where('user_id', $this->user_id)
            ->when($this->getFilter('fromDate'), fn ($query, $fromDate) => $query->whereDate('datetime_payment', '>=', $fromDate))
            ->when($this->getFilter('toDate'), fn ($query, $toDate) => $query->whereDate('datetime_payment', '<=', $toDate));
    }
}
