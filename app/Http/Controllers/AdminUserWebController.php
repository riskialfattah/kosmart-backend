<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserWebController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->latest()
            ->get();

        return view('admin.users', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.user-detail', compact('user'));
    }
}