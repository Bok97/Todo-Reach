<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
    /**
     * Register User
     *
     * @param Request $request
     * @return void
     */
    public function register(UserRegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('token')->accessToken;

        return $this->successsResponseWithToken('Successfully registered user account', new UserResource($user), $token);
    }

    /**
     * User Login
     *
     * @param Request $request
     * @return void
     */
    public function login(UserLoginRequest $request)
    {

        $user = User::where('email', $request['email'])->first();

        if (!Hash::check($request['password'], $user->password)) {
            return $this->unauthorizedResponse('Invalid credentials');
        }

        $token = $user->createToken('token')->accessToken;

        return $this->successsResponseWithToken('Successfully logged in', new UserResource($user), $token);

    }

    /**
     * Logged User Data Using Auth Token
     *
     * @return void
     */
    public function user(Request $request)
    {
        return $this->successsResponseWithToken('Successfully retrieved user profile', new UserResource($request->user()), $request->bearerToken());
    }

    /**
     * Logout Auth User
     *
     * @param Request $request
     * @return void
     */
    public function logout()
    {
        auth()->user()->token()->revoke();
        return $this->successResponseWithMessageOnly('Successfully logged out');
    }
}
