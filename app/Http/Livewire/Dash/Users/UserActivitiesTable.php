<?php

namespace App\Http\Livewire\Dash\Users;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Activitylog\Models\Activity;

class UserActivitiesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Nama', 'causer.name')
                ->sortable()
                ->searchable(),
            Column::make('Aktifitas', 'description')
                ->sortable()
                ->searchable(),
            Column::make('Waktu', 'created_at')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return '<span class="text-gray-600">' . $value->diffForHumans() . '</span>';
                })->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Activity::query()->latest('id');
    }
}
