<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
  public function showLogin()
  {
    return view('auth.login');
  }

  public function showRegister()
  {
    // nge cek mun si user na teh admin lah pokona mah panjang panjang teing gelo
    if (!Auth::check() || !Auth::user()->role()->where('role_name', 'admin')->exists()) {
      return redirect('/')->with('error', 'Access denied. Only administrators can create new accounts.');
    }

    $data = Role::all();
    return view('auth.register', compact('data'));
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
      $request->session()->regenerate();
      return redirect('/')->with('success', 'Login successful!');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
  }

  public function register(Request $request)
  {
    // sarua ngecek user admin lain
    if (!Auth::check() || !Auth::user()->role()->where('role_name', 'admin')->exists()) {
      return redirect('/')->with('error', 'Access denied. Only administrators can create new accounts.');
    }

    $request->validate([
      'full_name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|confirmed',
      'role' => 'required|exists:roles,id',
    ]);

    $user = User::create([
      'name' => $request->full_name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $user->role()->attach($request->role);

    return redirect('/')->with('success', 'New account created successfully!');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('success', 'Logged out successfully!');
  }
}
