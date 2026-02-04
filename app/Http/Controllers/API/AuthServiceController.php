<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthServiceController extends Controller
{
    protected $user, $userRole, $membership;

    public function __construct(User $user, UserRole $userRole, Membership $membership)
    {
        $this->user = $user;
        $this->userRole = $userRole;
        $this->membership = $membership;
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
        $role = $request->user()->load('role');

        if ($role->role[0]->role_name == 'admin') {
            $request->validate([
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'nullable|string|digits_between:10,14',
                'address' => 'nullable|string|min:10|max:255',
                'class' => 'required|in:X PPLG,XI PPLG,XII PPLG 1,XII PPLG 2'
            ]);

            $memberId = Str::random(10);
            $memberIdUpper = Str::upper($memberId);

            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($memberId)
            ]);

            $this->userRole->create([
                'user_id' => $user->id,
                'role_id' => '2'
            ]);

            $memberDate = new Carbon;

            $this->membership->create([
                'user_id' => $user->id,
                'member_number' => $memberIdUpper,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'class' => $request->class,
                'start_register' => $memberDate->now(),
                'valid_until' => $memberDate->addDays(365)
            ]);

            return response([
                'message' => 'Register success!',
            ], 201);
        }

        return response([
            'message' => 'Register can only be done by admins!',
        ], 401);
    }
}
