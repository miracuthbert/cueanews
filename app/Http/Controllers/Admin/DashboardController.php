<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke()
    {
        //total users
        $total_users = User::count();

        //users with posts
        $users_with_posts = User::has('posts', '>', 0)->count();

        //users with live posts
        $users_with_live_posts = User::whereHas('posts', function ($query) {
            $query->where('live', 1);
        }, '>', 0)->count();

        //posts
        $posts = Post::with(['category', 'user', 'ratings'])->latestFirst()->paginate();
        $total_live_posts = Post::isLive()->count();

        return view('admin.dashboard.index', [
            'total_users' => $total_users,
            'posts' => $posts,
            'total_live_posts' => $total_live_posts,
            'users_with_posts' => $users_with_posts,
            'users_with_live_posts' => $users_with_live_posts,
        ]);

    }
}
