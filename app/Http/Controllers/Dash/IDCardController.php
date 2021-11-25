<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IDCardController extends Controller
{
    public function index($jenjang, $skip)
    {
        $users = User::whereHas('userDetail', function ($query) use ($jenjang) {
            $query->where('jenjang', strtoupper($jenjang));
        })
            ->where('status', 'santri')
            ->skip($skip)->take(20)->get();

        return view('dash.keuangan.pas-card', [
            'users' => $users
        ]);
    }
}
