<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Tampilkan daftar user.
     */
    public function index()
    {
        /**
         * paginate
         */
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Promote user menjadi admin.
     */
    public function promote(User $user)
    {
        $user->update(['role' => 'admin']);
        return back()->with('success', "Berhasil menjadikan {$user->name} sebagai Admin.");
    }

    /**
     * Ban user.
     */
    public function ban(User $user)
    {
        $user->update(['is_suspended' => true]);
        return back()->with('success', "Akun {$user->name} berhasil di-banned.");
    }

    /**
     * Unban user.
     */
    public function unban(User $user)
    {
        $user->update(['is_suspended' => false]);
        return back()->with('success', "Akun {$user->name} berhasil di-aktifkan kembali.");
    }
}
