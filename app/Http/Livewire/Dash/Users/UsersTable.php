<?php

namespace App\Http\Livewire\Dash\Users;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class UsersTable extends DataTableComponent
{
    protected $listeners = [
        'closeUserAlertModal' => '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.users.name-column')->withUser($row);
                }),
            Column::make('Username')
                ->sortable()
                ->searchable(),
            Column::make('Role', 'roles')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.users.roles-column')->withUser($row);
                }),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.users.actions')->withUser($row);
                }),
        ];
    }

    public function filters(): array
    {
        $init = ['' => 'Semua'];
        $roles = Role::where('name', '<>', 'super-admin')->get();
        foreach ($roles as $role) {
            $arrs = array_merge($init, [$role->name => $role->name]);
        }

        return [
            'verified' => Filter::make('E-mail Verified')
                ->select([
                    '' => 'Semua',
                    'yes' => 'Yes',
                    'no' => 'No',
                ])
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', '<>', 'super-admin');
            })
            ->when($this->getFilter('verified'), fn ($query, $verified) => $verified === 'yes' ? $query->whereNotNull('email_verified_at') : $query->whereNull('email_verified_at'));
    }

    public function resetPassword(User $user)
    {
        $pass = Str::random(8);
        $user->update([
            'password' => bcrypt($pass)
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Password Reseted!',
            'text' => 'Password berhasil direset, berikut passwordnya: ' . $pass,
        ]);
    }
}
