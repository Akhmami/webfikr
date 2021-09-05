<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Jobs\UserActivity;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = '/dashboard';

        if (auth()->user()->hasRole('user')) {
            $home = route('user.home');
        }

        UserActivity::dispatch(Auth::user(), 'User login, IP: ' . $request->ip());

        return redirect()->intended($home);
    }
}
