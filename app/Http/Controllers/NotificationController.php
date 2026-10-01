<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Halaman list semua notifikasi
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(20);

        return view('pages.notifications.index', compact('notifications'));
    }

    public function unreadCount()
    {
        return response()->json([
            'count' => auth()->user()->unreadNotifications()->count(),
        ]);
    }

    public function read(string $id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return redirect($notification->data['url'] ?? route('home'));
    }

    // Tandai semua sebagai read
    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi sudah dibaca.');
    }
}
