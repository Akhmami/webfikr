<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        # code...
    }

    public function user(Request $request)
    {
        $user = User::with('userDetail')->where('username', $request->username)->first();

        return $user;
    }
}
