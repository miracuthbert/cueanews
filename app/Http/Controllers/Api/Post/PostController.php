<?php

namespace App\Http\Controllers\Api\Post;

use App\Jobs\UserViewedPost;
use App\Models\Category;
use App\Models\Post;
use App\Transformers\PostTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->category;
        $author = $request->author;

        if (isset($category)) {
            $category = Category::where('slug', $category)->firstOrFail();

            $posts = Post::fromCategory($category)->isLive()->latestFirst()->paginate();
        } elseif (isset($author)) {
            $author = User::findOrFail($author);

            $posts = Post::byAuthor($author)->isLive()->latestFirst()->paginate();
        } else {
            $posts = Post::latestFirst()->isLive()->paginate();
        }

        $postsCollection = $posts->getCollection();

        $category = !empty($category->id) ? $category->slug : $category;
        $author = !empty($author->id) ? $author->id : $author;

        return fractal()
            ->collection($postsCollection)
            ->parseIncludes(['category'])
            ->transformWith(new PostTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($posts))
            ->toArray();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {

        if (!$post->live()) {
            abort(404, "Sorry, the post you are looking for cannot be found.");
        }

        if ($request->user('api')) { //check if user signed in and log view
            dispatch(new UserViewedPost($request->user('api'), $post));
        }

        return fractal()
            ->item($post)
            ->parseIncludes(['category', 'comments'])
            ->transformWith(new PostTransformer)
            ->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
