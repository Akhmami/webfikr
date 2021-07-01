<?php

namespace App\Http\Livewire\Dash\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Role', 'roles')
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.users.roles-column')->withUser($row);
                }),
            Column::make('Actions')
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.users.actions')->withUser($row);
                }),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }
}
