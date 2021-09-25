<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\User;
use App\Models\Year;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class RegisteredTable extends DataTableComponent
{
    protected $listeners = ['delete'];

    public function columns(): array
    {
        return [
            Column::make('No Pendaftaran', 'userDetail.no_pendaftaran')
                ->sortable()
                ->searchable(),
            Column::make('Nama Lengkap', 'name')
                ->sortable()
                ->searchable(),
            Column::make('JK', 'gender')
                ->sortable()
                ->searchable(),
            Column::make('Jenjang', 'userDetail.jenjang'),
            Column::make('Status')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.psb.status-psb-badge', ['data' => $row]);
                }),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.psb.actions', ['data' => $row]);
                }),
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

    /** @return Builder  */
    public function query(): Builder
    {
        $activeYear = Year::active()->first();

        return User::query()
            ->where('tahun_pendaftaran', $activeYear->periode)
            ->latest('id')
            ->when($this->getFilter('fromDate'), fn ($query, $fromDate) => $query->whereDate('created_at', '>=', $fromDate))
            ->when($this->getFilter('toDate'), fn ($query, $toDate) => $query->whereDate('created_at', '<=', $toDate));
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Yakin ingin menghapus?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
