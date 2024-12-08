<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuth\LoginRequest;
use App\Http\Requests\UserAuth\RegisterRequest;
use App\Models\User;
use Hash;
use Symfony\Component\HttpFoundation\Response;

class UserAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->safe()->only(['name', 'email', 'password']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => 'User created',
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->safe()->only(['email', 'password']);

        $user = User::where('email', $validated['email'])->first();
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        $token = $user->createToken($user->name . '-AuthToken');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "Logged out"
        ]);
    }
}
