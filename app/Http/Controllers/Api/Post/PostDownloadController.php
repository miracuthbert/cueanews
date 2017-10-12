<?php

namespace App\Http\Controllers\Api\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class PostDownloadController extends Controller
{

    /**
     * PostDownloadController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function __invoke(Post $post)
    {
        $title = str_slug($post->title);
        $pdf = PDF::loadView('posts.downloads.pdf', compact('post'));
        return $pdf->download("{$title}.pdf");
    }
}
