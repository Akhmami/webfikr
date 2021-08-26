<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        # code...
    }

    public function detail($id)
    {
        $user = User::with([
            'userDetail',
            'billers',
            'billings',
            'grades',
            'activeGrade',
            'mobilePhones',
            'setSpp'
        ])->findOrFail($id);

        return view('dash.users.user-detail', ['user' => $user]);
    }

    public function userPage($id)
    {
        auth()->loginUsingId($id);

        return redirect()->to('//apps.nfbsv3.test');
    }
}
