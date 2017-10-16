<?php

namespace App\Http\Controllers\Api\Post;

use App\Models\Post;
use App\Models\Rate;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostRatingController extends Controller
{
    /**
     * PostRatingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $user = $request->user();

        if ($user->hasRatedPost($post)) {
            return response(null, 409);
        }

        $rate = new Rate();
        $rate->user()->associate($user);
        $rate->rating = $request->rating;
        $post->ratings()->save($rate);

        return fractal()
            ->item($rate->rateable)
            ->parseIncludes(['category', 'comments', 'ratings'])
            ->transformWith(new PostTransformer)
            ->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
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
     * @param Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $user = $request->user();

        if ($user->hasRatedPost($post)) {
            $post->ratings->where('user_id', $user->id)->delete();

            return response(null, 204);
        }

        return response(null, 409);
    }
}
