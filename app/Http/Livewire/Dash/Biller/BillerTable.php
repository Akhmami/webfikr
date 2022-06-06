<?php

namespace App\Http\Livewire\Dash\Biller;

use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Filters\GradeFilter;

class BillerTable extends TableView
{
    protected $paginate = 25;   
    public $searchBy = ['userDetail.no_pendaftaran', 'name'];

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

    protected function filters()
    {
        return [
            new GradeFilter
        ];
    }
}
