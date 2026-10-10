<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class StatisticController extends Controller
{
    /**
     * Halaman statistik.
     */
    public function index(): View
    {
        $totalMembers    = User::count();
        $totalCategories = Category::count();
        $totalPosts      = Post::count();

        return view('admin.statistics.index', compact(
            'totalMembers',
            'totalCategories',
            'totalPosts'
        ));
    }

    /**
     * Endpoint JSON untuk polling AJAX di halaman statistik.
     */
    public function data(): JsonResponse
    {
        return response()->json([
            'members'    => User::count(),
            'categories' => Category::count(),
            'posts'      => Post::count(),

            'activities' => Activity::with('user')
                ->latest()
                ->take(20)
                ->get()
                ->map(fn ($a) => [
                    'id'         => $a->id,
                    'type'       => $a->type,
                    'user'       => [
                        'name'   => $a->user->name ?? 'User terhapus',
                        'avatar' => $a->user->profile_photo_url ?? null,
                    ],
                    'created_at' => $a->created_at->format('Y-m-d H:i:s'),
                ]),
        ]);
    }
}
