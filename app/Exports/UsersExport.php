<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->get();
        $users->load('mobilePhones');

        return $users;
    }
}
