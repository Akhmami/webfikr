<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IDCardController extends Controller
{
    public function index()
    {
        $users = User::with('userDetail')
            ->where('status', 'santri')->get();

        return view('dash.keuangan.pas-card', [
            'users' => $users
        ]);
    }
}
