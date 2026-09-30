<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;


class StatisticController extends Controller
{
    public function index(): View
    {
        $totalMembers = User::count();
        $totalCategories = Category::count();
        $totalPosts = Post::count();

        return view('admin.statistics.index', compact(
            'totalMembers',
            'totalCategories',
            'totalPosts'
        ));
    }
}
