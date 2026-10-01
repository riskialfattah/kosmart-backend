<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat data pengguna.',
            ], 403);
        }

        $users = User::latest()->get();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function show(Request $request, User $user)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat detail pengguna.',
            ], 403);
        }

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat mengubah data pengguna.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:150',
            'role' => 'required|in:user,admin',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Data pengguna berhasil diperbarui',
            'user' => $user,
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat menghapus pengguna.',
            ], 403);
        }

        if ($user->id === $admin->id) {
            return response()->json([
                'message' => 'Admin tidak dapat menghapus akun sendiri.',
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'Pengguna berhasil dihapus',
        ]);
    }
}