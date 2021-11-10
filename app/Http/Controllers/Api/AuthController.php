<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends BaseController
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        // if ($request->validator->fails()) {
        //     return $this->sendError('Error Validation', $validated->errors());
        // }

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        $user->assignRole('user');
        $user['token'] = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse('User created successfully', new UserResource($user));
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return $this->sendError('Unauthorized', [
                'error' => 'Detail login tidak valid'
            ], 401);
        }

        $user = Auth::user();
        $user['token'] = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse('User logged in', new UserResource($user));
    }

    public function me(Request $request)
    {
        return $request->user()->with('userDetail');
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
