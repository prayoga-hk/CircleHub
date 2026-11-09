<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class StatisticController extends Controller
{
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

    public function data(): JsonResponse
    {
        $postsByHour = Post::whereDate('created_at', today())
            ->selectRaw('HOUR(created_at) as hour, COUNT(*) as aggregate')
            ->groupBy('hour')
            ->pluck('aggregate', 'hour');

        $chartData = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $chartData[] = $postsByHour->get($hour, 0);
        }

        // TAMBAHAN PAGINATION: Menggunakan paginate(5) bukan take(5)
        $topUsers = User::withCount(['posts as total_likes' => function ($query) {
                $query->join('likes', 'posts.id', '=', 'likes.post_id');
            }])
            ->having('total_likes', '>', 0)
            ->orderByDesc('total_likes')
            ->paginate(5); // <-- Ubah ke paginate(5)

        return response()->json([
            'members'    => User::count(),
            'categories' => Category::count(),
            'posts'      => Post::count(),
            'chartData'  => $chartData,
            'topUsers'   => $topUsers, // Sekarang berisi objek paginator
        ]);
    }
}
