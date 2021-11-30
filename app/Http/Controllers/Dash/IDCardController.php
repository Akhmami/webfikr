<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\User;

class IDCardController extends Controller
{
    public function index($jenjang, $skip)
    {
        $users = User::whereHas('userDetail', function ($query) use ($jenjang) {
            $query->where('jenjang', strtoupper($jenjang));
        })
            ->whereHas('grades', function ($q) {
                $q->where('nama', '10');
            })
            ->where('status', 'santri')
            ->skip($skip)->take(20)->get();

        return view('dash.keuangan.pas-card', [
            'users' => $users
        ]);
    }
}
