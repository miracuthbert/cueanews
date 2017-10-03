<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Requests\StorePostFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

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

            $posts = Post::with(['category', 'user'])->fromCategory($category)->latestFirst()->paginate();
        } elseif (isset($author)) {
            $author = User::findOrFail($author);

            $posts = Post::with(['category', 'user'])->byAuthor($author)->latestFirst()->paginate();
        } else {
            $posts = Post::with(['category', 'user'])->latestFirst()->paginate();
        }

        $category = !empty($category->id) ? $category->slug : $category;
        $author = !empty($author->id) ? $author->id : $author;

        return view('admin.posts.index', compact('posts', 'category', 'author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with(['ancestors'])->get()->toFlatTree();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostFormRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category');
        $post->user()->associate($request->user());
        $post->live = $request->input('status');

        //save
        if ($post->save() && $post->live) {
            return redirect()->route('admin.posts.index')
                ->withSuccess("`{$post->title}` post successfully published.");
        } else {
            return redirect()->route('admin.posts.edit', [$post])
                ->withSuccess("Post saved. You can make changes and publish it when ready.");
        }

        //error
        return back()->withInput()->withError('Failed saving post. Please try again!');

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
        $categories = Category::with(['ancestors'])->get()->toFlatTree();

        return view('admin.posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePostFormRequest|Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostFormRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category');
        $post->user()->associate($request->user());

        if ($post->live == 0 && $request->input('status') == 1) {
            $post->created_at = Carbon::now();
        }

        $post->live = $request->input('status');

        //save
        if ($post->save() && $post->live) {
            return redirect()->route('admin.posts.index')
                ->withSuccess("`{$post->title}` post successfully updated and published.");
        } else {
            return redirect()->route('admin.posts.edit', [$post])
                ->withSuccess("Post saved. You can make changes and publish it when ready.");
        }

        //error
        return back()->withInput()->withError('Failed saving post. Please try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $title = $post->title;

        $post->forceDelete();

        return back()
            ->withSuccess("`{$title}` post successfully deleted.");

    }
}
