<?php

namespace App\Http\Livewire\Dash\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    protected $listeners = [
        'closeAlertModal' => 'indexUsers'
    ];

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable()
                ->format(function($value, $column, $row) {
                    return view('livewire.dash.users.name-column')->withUser($row);
                }),
            Column::make('Username')
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
        return User::query()
            ->whereHas('roles', function ($q) {
                $q->where('name', '<>', 'super-admin');
            });
    }

    public function indexUsers()
    {
        #
    }
}
