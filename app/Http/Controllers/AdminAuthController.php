<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = User::where('email', $validated['email'])
            ->where('role', 'admin')
            ->first();

        if (!$admin || !Hash::check($validated['password'], $admin->password)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password admin salah.',
                ])
                ->withInput($request->only('email'));
        }

        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_name', $admin->name);

        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin_id',
            'admin_name',
        ]);

        return redirect('/admin/login');
    }
}