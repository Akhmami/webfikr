<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\CostReduction;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class CostReductionsTable extends DataTableComponent
{
    protected $listeners = [
        'closeCoseReductionAlertModal' => 'indexBilling'
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama Lengkap', 'user.name')
                ->sortable()
                ->searchable(),
            Column::make('Jml Keringanan', 'nominal')
                ->sortable()
                ->searchable(),
            Column::make('Untuk', 'type')
                ->sortable()
                ->searchable(),
            Column::make('Keterangan', 'keterangan')
                ->sortable()
                ->searchable(),
            // Column::make('Actions')
            //     ->format(function ($value, $column, $row) {
            //         return view('livewire.dash.keuangan.cost-reduction-actions')->withData($row);
            //     }),
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
        return CostReduction::query()
            ->with('user')
            ->latest()
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }

    public function indexBilling()
    {
        # code...
    }
}
