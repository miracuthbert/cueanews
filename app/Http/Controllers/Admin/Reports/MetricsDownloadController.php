<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Models\Feedback;
use App\Models\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class MetricsDownloadController extends Controller
{

    /**
     * MetricsDownloadController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
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
        $posts = Post::count();
        $total_unpublished_posts = Post::isNotLive()->count();
        $total_live_posts = Post::isLive()->count();

        $most_rated = Post::withCount('ratings')->isLive()->get()->max('ratings_count');
        $most_rated = Post::withCount('ratings')->isLive()->get()->where('ratings_count', $most_rated)->first();

        $most_viewed = Post::withCount('viewedUsers')->isLive()->get()->max('viewed_users_count');
        $most_viewed = Post::withCount('viewedUsers')->isLive()->get()->where('viewed_users_count', $most_viewed)->first();

        //feedback
        $feedback = Feedback::count();

        $title = str_slug("Metrics report");
        $pdf = PDF::loadView('admin.reports.metrics', [
            'total_users' => $total_users,
            'posts' => $posts,
            'total_live_posts' => $total_live_posts,
            'total_unpublished_posts' => $total_unpublished_posts,
            'users_with_posts' => $users_with_posts,
            'users_with_live_posts' => $users_with_live_posts,
            'most_rated' => $most_rated,
            'most_viewed' => $most_viewed,
            'feedback' => $feedback,
            'date' => Carbon::now()->toDayDateTimeString(),
        ]);
        return $pdf->download("{$title}.pdf");
    }
}
