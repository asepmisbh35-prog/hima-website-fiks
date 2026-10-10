<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    // List semua user
    public function index(Request $request)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(20);

        $stats = [
            'total' => User::count(),
            'pengurus_inti' => User::where('role', 'pengurus_inti')->count(),
            'pengurus_harian' => User::where('role', 'pengurus_harian')->count(),
            'mahasiswa' => User::where('role', 'mahasiswa_umum')->count(),
        ];

        return view('users.index', compact('users', 'stats'));
    }

    // Update role user
    public function updateRole(Request $request, User $user)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $validated = $request->validate([
            'role' => 'required|in:mahasiswa_umum,pengurus_harian,pengurus_inti',
        ]);

        $user->update($validated);

        return back()->with('success', 'Role user berhasil diperbarui!');
    }

    // Delete user
    public function destroy(User $user)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        // Tidak bisa hapus diri sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }
}