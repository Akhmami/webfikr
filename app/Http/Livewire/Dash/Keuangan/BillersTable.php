<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\User;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class BillersTable extends DataTableComponent
{
    protected $listeners = [
        'closeBillerAlertModal' => 'indexBilling'
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama Lengkap', 'name')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return '<a href="' . route('dash.users.show', $row) . '" class="text-indigo-600 font-semibold hover:underline cursor-pointer">' . $value . '</a>';
                })
                ->asHtml(),
            Column::make('Kelas')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.keuangan.kelas')->withData($row);
                }),
            Column::make('Tagihan')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.keuangan.tagihan')->withData($row);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'kelas' => Filter::make('Kelas')
                ->select(
                    Grade::pluck('nama', 'nama')->toArray()
                )
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->with(['billers', 'activeGrade'])
            ->whereHas('roles', fn ($query) => $query->where('name', 'user'))
            ->latest()
            ->when($this->getFilter('kelas'), fn ($query, $kelas) => $query->whereHas(
                'grades',
                fn ($query) => $query->where('nama', $kelas)
            ));
    }

    public function indexBilling()
    {
        # code...
    }
}
