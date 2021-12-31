<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Libraries\WA;
use App\Mail\SendMailPsb;
use App\Models\Gelombang;
use App\Models\User;
use App\Models\Year;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class RegisteredTable extends DataTableComponent
{
    protected $listeners = [
        'delete',
        'resend',
        'closeAlertValue' => '$refresh',
    ];

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
        $init = ['' => 'Semua'];
        $gelombang = Gelombang::pluck('nama', 'id')->toArray();
        $gelombang = $init + $gelombang;

        return [
            'fromDate' => Filter::make('Dari tanggal')
                ->date([
                    'max' => now()->format('Y-m-d')
                ]),
            'toDate' => Filter::make('Sampai tanggal')
                ->date([
                    'max' => now()->format('Y-m-d')
                ]),
            'gelombang' => Filter::make('Gelombang')
                ->select($gelombang),
            'statusPsb' => Filter::make('Status Psb')
                ->select([
                    '' => 'Semua',
                    1 => 'Menunggu Pembayaran',
                    2 => 'Terbayar',
                    3 => 'Diterima',
                    4 => 'Cadangan',
                    5 => 'Tidak Diterima',
                    6 => 'Mengundurkan Diri'
                ]),
            'questionnairePsb' => Filter::make('Questionnaire')
                ->select([
                    '' => 'Semua',
                    1 => 'Terisi',
                    0 => 'Belum terisi',
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
            ->when($this->getFilter('toDate'), fn ($query, $toDate) => $query->whereDate('created_at', '<=', $toDate))
            ->when($this->getFilter('gelombang'), fn ($query, $gelombang) => $query->where('gelombang_id', $gelombang))
            ->when($this->getFilter('statusPsb'), fn ($query, $statusPsb) => $query->where('status_psb_id', $statusPsb))
            ->when($this->getFilter('questionnairePsb'), fn ($query, $questionnairePsb) => $query->where('questionnaire_psb', $questionnairePsb));
    }

    public function setTerbayar(User $user)
    {
        $user->update(['status_psb_id' => 2]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Updated!',
            'text' => 'Status PSB Pendaftar berhasil diubah.',
        ]);
    }

    public function setMenunggu(User $user)
    {
        $user->update(['status_psb_id' => 1]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Updated!',
            'text' => 'Status PSB Pendaftar berhasil diubah.',
        ]);
    }

    public function resendConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Kirim ulang WA dan Email?',
            'text' => '',
            'id' => $id,
            'method' => 'resend'
        ]);
    }

    public function resend($id)
    {
        $user = User::find($id);
        $user->load('billerPsb');
        Mail::to($user->email)->send(new SendMailPsb($user));
        // Send WA Notification
        $wa = new WA($user);
        $data['trx_amount'] = $user->billerPsb->amount;
        $data['virtual_account'] = $user->billerPsb->billing->virtual_account;
        $wa->notifyPsbRegistration($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Terkirim!',
            'text' => 'Notifikasi WA dan Email berhasil dikirim ulang',
        ]);
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Yakin ingin menghapus?',
            'text' => '',
            'id' => $id,
            'method' => 'delete'
        ]);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
