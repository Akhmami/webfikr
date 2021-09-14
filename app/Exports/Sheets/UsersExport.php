<?php

namespace App\Exports\Sheets;

use App\Models\MobilePhone;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithMapping
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

        return $users;
    }

    public function map($user): array
    {
        $array = [];
        if ($this->sheet === 'userDetail') {
            $array = [
                $user->id,
                $user->name,
                $user->userDetail->no_pendaftaran,
                $user->email,
                $user->gender,
                $user->birth_place,
                $user->birth_date,
                $user->created_at
            ];
        }

        if ($this->sheet == 'mobilePhones') {
            $array = [
                $user->id,
                $user->user->name,
                $user->user->no_pendaftaran,
                $user->name,
                $user->full_number
            ];
        }

        return $array;
    }
}
