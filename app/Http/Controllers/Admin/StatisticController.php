<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Post; // Sesuaikan dengan model postingan kamu
use Illuminate\View\View;

class StatisticController extends Controller
{
    public function index(): View
    {
        $totalMembers = User::where('role', 'member')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalBanned = User::where('is_suspended', true)->count();
        $totalPosts = Post::count();

        return view('admin.statistics.index', compact(
            'totalMembers',
            'totalAdmins',
            'totalBanned',
            'totalCategories',
            'totalPosts'
        ));
    }
}
