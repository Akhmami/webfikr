<?php

namespace App\Exports\Sheets;

use App\Models\MobilePhone;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class RegisteredExport implements
    FromQuery,
    WithMapping,
    WithHeadings,
    WithTitle,
    WithEvents
{
    use Exportable;

    private $sheet;
    private $tahun_pendaftaran;

    public function __construct($sheet, int $tahun_pendaftaran)
    {
        $this->sheet = $sheet;
        $this->tahun_pendaftaran = $tahun_pendaftaran;
    }

    public function query()
    {
        if ($this->sheet === 'userDetail') {
            $users = User::query()->with(['userDetail']);
            $users->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->where('tahun_pendaftaran', $this->tahun_pendaftaran);
        }

        if ($this->sheet === 'mobilePhones') {
            $users = MobilePhone::query()->whereHas('user', function ($q) {
                $q->where('tahun_pendaftaran', $this->tahun_pendaftaran);
            });
        }

        return $users;
    }

    public function map($user): array
    {
        $array = [];

        if ($this->sheet === 'userDetail') {
            $array = [
                $user->userDetail->no_pendaftaran,
                "'{$user->userDetail->nik}",
                $user->name,
                "'{$user->userDetail->nisn}",
                $user->email,
                $user->statusPsb->status ?? null,
                $user->gelombang->nama ?? null,
                $user->gender,
                $user->birth_place,
                $user->birth_date,
                $user->userDetail->jenis_pendaftaran,
                $user->userDetail->tahun_pendaftaran,
                $user->userDetail->jenjang,
                $user->userDetail->jurusan_pilihan,
                $user->userDetail->jurusan,
                $user->userDetail->angkatan,
                $user->userDetail->asal_sekolah,
                $user->userDetail->npsn,
                $user->userDetail->nama_ayah,
                $user->userDetail->nama_ibu
            ];
        }

        if ($this->sheet == 'mobilePhones') {
            $array = [
                $user->user->username,
                $user->user->name,
                $user->user->userDetail->jenjang,
                $user->user->userDetail->jenis_pendaftaran,
                $user->name,
                $user->full_number
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
                'NIK',
                'Nama Lengkap',
                'NISN',
                'Email',
                'Status PSB',
                'Gelombang',
                'JK',
                'Tempat Lahir',
                'Tanggal lahir',
                'Jenis Pendaftaran',
                'Tahun Pendaftaran',
                'Jenjang',
                'Jurusan Pilihan',
                'Jurusan Diterima',
                'Angkatan',
                'Asal Sekolah',
                'NPSN',
                'Nama Ayah',
                'Nama Ibu'
            ];
        }

        if ($this->sheet === 'mobilePhones') {
            $heading = [
                'No Pendaftaran',
                'Nama Lengkap',
                'Jenjang',
                'Jenis Pendaftaran',
                'Pemilik Nomor',
                'Nomor HP'
            ];
        }

        return $heading;
    }

    public function title(): string
    {
        $sheetName = 'Sheet';
        if ($this->sheet === 'userDetail') {
            $sheetName = 'Pendaftar';
        }

        if ($this->sheet === 'mobilePhones') {
            $sheetName = 'No HP';
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
