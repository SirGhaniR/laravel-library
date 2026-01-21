<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthServiceController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6'
        ]);

        $userData = $this->user->whereEmail($request->email)->first();

        $password_check = Hash::check($request->password, $userData->password);

        if (! $password_check) {
            return response([
                'message' => 'Wrong password!'
            ], 401);
        }

        $token = $userData->createToken('token')->plainTextToken;

        return response([
            'message' => 'Login success!',
            'token' => $token
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response([
            'message' => 'Register success!',
        ], 201);
    }
}
