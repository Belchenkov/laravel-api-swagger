<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if ($user = Auth::user()) {
                $token = $user->createToken('admin')->accessToken;

                return [
                    'token' => $token
                ];
            }
        }

        return response([
            'error' => 'Invalid Credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('firstname', 'lastname', 'email') + [
                'password' => Hash::make($request->input('password'))
            ]);

        return response($user, Response::HTTP_CREATED);
    }
}