<?php

namespace App\Exports\Sheets;

use App\Models\Billing;
use App\Models\MobilePhone;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements
    FromQuery,
    WithMapping,
    WithHeadings,
    WithTitle,
    WithEvents
{
    use Exportable;

    private $sheet;
    private $year;
    private $month;

    public function __construct($sheet, int $year, int $month)
    {
        $this->sheet = $sheet;
        $this->year = $year;
        $this->month = $month;
    }

    public function query()
    {
        if ($this->sheet === 'userDetail') {
            $users = User::query()->with(['roles', 'userDetail']);
            $users->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            });
        }

        if ($this->sheet === 'mobilePhones') {
            $users = MobilePhone::query()->whereHas('user', function ($q) {
                $q->whereHas('grades.gradeUsers', function ($query) {
                    $query->where('is_active', 'Y');
                });
            });
        }

        if ($this->sheet === 'paidBilling') {
            $users = Billing::query()->with('paymentHistories', 'user')
                ->where('is_paid', 'Y');
            $year = $this->year;
            $month = $this->month;
            $users->whereHas('paymentHistories', function ($q) use ($year, $month) {
                $q->whereYear('datetime_payment', $year)
                    ->whereMonth('datetime_payment', $month);
            });
        }

        return $users;
    }

    public function map($user): array
    {
        $array = [];
        $method = ['i' => 'Partial Payment', 'o' => 'Open Payment', 'c' => 'Close Payment'];
        $type = ['Y' => 'Isi Saldo', 'N' => 'Pembayaran'];

        if ($this->sheet === 'userDetail') {
            $array = [
                $user->userDetail->no_pendaftaran,
                $user->name,
                $user->userDetail->nisn,
                $user->email,
                $user->gender,
                $user->birth_place,
                $user->birth_date,
                $user->userDetail->jenjang,
                $user->userDetail->angkatan,
                $user->userDetail->nama_ayah,
                $user->userDetail->nama_ibu
            ];
        }

        if ($this->sheet == 'mobilePhones') {
            $array = [
                $user->user->username,
                $user->user->name,
                $user->name,
                $user->full_number
            ];
        }

        if ($this->sheet == 'paidBilling') {
            $array = [
                $user->user->username,
                $user->customer_name,
                $user->virtual_account,
                $user->trx_amount,
                $method[$user->billing_type],
                $type[$user->is_balance],
                $user->paymentHistories()->first()->datetime_payment,
                $user->description
            ];
        }

        return $array;
    }

    public function headings(): array
    {
        $heading = [];
        if ($this->sheet === 'userDetail') {
            $heading = [
                'No Pendaftaran',
                'Nama Lengkap',
                'NISN',
                'Email',
                'JK',
                'Tempat Lahir',
                'Tanggal lahir',
                'Jenjang',
                'Angkatan',
                'Nama Ayah',
                'Nama Ibu'
            ];
        }

        if ($this->sheet === 'mobilePhones') {
            $heading = [
                'No Pendaftaran',
                'Nama Lengkap',
                'Pemilik Nomor',
                'Nomor HP'
            ];
        }

        if ($this->sheet === 'paidBilling') {
            $heading = [
                'Username',
                'Nama Lengkap',
                'Kode Bayar (VA)',
                'Nominal',
                'Metode Pembayaran',
                'Jenis Pembayaran',
                'Tgl Bayar',
                'Deskripsi'
            ];
        }

        return $heading;
    }

    public function title(): string
    {
        $sheetName = 'Sheet';
        if ($this->sheet === 'userDetail') {
            $sheetName = 'Santri';
        }

        if ($this->sheet === 'mobilePhones') {
            $sheetName = 'No HP';
        }

        if ($this->sheet === 'paidBilling') {
            $sheetName = 'Riwayat Pembayaran';
        }

        return $sheetName;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
