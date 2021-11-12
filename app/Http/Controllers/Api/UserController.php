<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use InvalidArgumentException;

class UserController extends BaseController
{
    public function index()
    {
        # code...
    }

    public function user(Request $request)
    {
        $user = User::with('userDetail')->where('username', $request->username)->first();

        if (!$user) {
            return $this->sendError('Not Found', [
                'error' => 'Data tidak ditemukan'
            ], 404);
        }

        return $user;
    }

    /**
     *
     * @param Request $request
     * Parameter tahun_pendaftaran
     */
    public function psb(Request $request)
    {
        $users = User::with('userDetail')
            ->where('tahun_pendaftaran', $request->tahun_pendaftaran)
            ->get();

        return $users;
    }
}
