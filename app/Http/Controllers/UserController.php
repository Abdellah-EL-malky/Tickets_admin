<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function redirect()
    {
        $user = auth()->user();

        return match($user->role) {
            'admin' => redirect()->route('adminDashboard'),
            'agent' => redirect()->route('agentDashboard'),
            'user' => redirect()->route('userDashboard'),
            default => redirect()->route('login')
        };
    }
    public function adminDashboard()
    {
        return view('adminDashboard');
    }

    public function agentDashboard()
    {
        return view('agentDashboard');
    }

    public function userDashboard()
    {
        return view('userDashboard');
    }

}
