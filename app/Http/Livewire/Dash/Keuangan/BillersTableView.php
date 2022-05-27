<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\User;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;

class BillersTableView extends TableView
{
    public function headers(): array
    {
        return [
            'No. Pendaftaran',
            'Nama Lengkap',
            'Saldo',
            'Kelas',
            'Tagihan'
        ];
    }

    public function row($model): array
    {
        return [
            $model->userDetail->no_pendaftaran,
            $model->name,
            $model->balance ? $model->balance->current_amount : '0',
            $model->activeGrade()->first()->nama ?? null,
            'test'
        ];
    }

    public function repository(): Builder
    {
        return User::query()
            ->with(['userDetail', 'billers', 'activeGrade', 'balance'])
            ->where('status', 'santri')
            ->latest();
    }
}
