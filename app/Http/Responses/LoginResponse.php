<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = '/dashboard';

        if (auth()->user()->hasRole('akuntan')) {
            $home = '/dashboard';
        }

        return redirect()->intended($home);
    }
}
