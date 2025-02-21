<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function redirect()
    {
        $user = auth()->user();

        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'manager' => redirect()->route('manager.dashboard'),
            'user' => redirect()->route('user.dashboard'),
            default => redirect()->route('login')
        };
    }
    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    public function managerDashboard()
    {
        return view('dashboard.manager');
    }

    public function userDashboard()
    {
        return view('userDashboard');
    }

}
