<?php

namespace App\Http\Livewire\Dash\Keuangan;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Activitylog\Models\Activity;

class CallbackHistoriesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.keuangan.callback-actions', ['data' => $row]);
                }),
            Column::make('Description')
                ->sortable(),
            Column::make('Data', 'properties')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Activity::query()
            ->where('log_name', 'BSI')
            ->latest('id');
    }
}
