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
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return '<a href="' . route('dash.users.show', $row->id) . '" class="text-indigo-600 font-semibold hover:underline cursor-pointer">' . $value . '</a>';
                })
                ->asHtml(),
            Column::make('Saldo')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.keuangan.kolom-saldo')->withData($row);
                }),
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
        $init = ['' => 'Semua'];
        $pluck = Grade::pluck('nama', 'nama')->toArray();
        $grades = $init + $pluck;
        return [
            'kelas' => Filter::make('Kelas')
                ->select($grades),
            'is_active' => Filter::make('Status tagihan')
                ->select([
                    '' => 'Semua',
                    'Y' => 'Active',
                    'N' => 'Inactive'
                ])
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->with(['billers', 'activeGrade', 'balance'])
            ->whereHas('roles', fn ($query) => $query->where('name', 'user'))
            ->latest()
            ->when($this->getFilter('kelas'), fn ($query, $kelas) => $query->whereHas(
                'grades',
                fn ($query) => $query->where('nama', $kelas)
            ))
            ->when($this->getFilter('is_active'), fn ($query, $is_active) => $query->whereHas(
                'billers',
                fn ($query) => $query->where('is_active', $is_active)
            ));
    }

    public function indexBilling()
    {
        # code...
    }
}
