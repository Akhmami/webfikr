<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\FailedSppBiller;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SppFailedTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Username', 'user.username')
                ->searchable(),
            Column::make('Deskripsi', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Exception', 'exception'),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.keuangan.spp-failed-actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return FailedSppBiller::query()
            ->with('user');
    }
}
