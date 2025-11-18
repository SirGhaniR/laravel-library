<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $isAdmin = $user->role()->where('role_name', 'admin')->exists();
            $isMember = $user->role()->where('role_name', 'member')->exists();

            return view("home.index", [
                'currentPage' => 'home',
                'title' => 'Home',
                'isAdmin' => $isAdmin,
                'isMember' => $isMember
            ]);
        }

        return view("home.index", [
            'currentPage' => 'home',
            'title' => 'Home',
            'isAdmin' => false,
            'isMember' => false
        ]);
    }
}
