<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
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

    public function administrasi(Request $request)
    {
        $user = User::with('billerAnother', 'latestSpp')
            ->where('username', $request->username)->first();

        if (!$user) {
            return $this->sendError('User Not Found', [
                'error' => 'User tidak ditemukan di data keuangan'
            ], 404);
        }

        if (strtotime($user->latestSpp->bulan) < strtotime('2021-11-01')) {
            return $this->sendError('Uncomplete administration', [
                'error' => 'Masih ada administrasi yang belum diselesaikan'
            ], 403);
        }

        $tagihanLain = $user->billerAnother->sum('amount') - ($user->billerAnother->sum('cumulative_payment_amount') +
            $user->billerAnother->sum('cost_reduction') +
            $user->billerAnother->sum('balance_used'));

        if ($tagihanLain > 0) {
            return $this->sendError('Uncomplete administration', [
                'error' => 'Masih ada administrasi yang belum diselesaikan'
            ], 403);
        }

        return $this->sendResponse('Administration complete', new UserResource($user));
    }
}
