<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Requests\StoreCategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Category $categories
     * @return \Illuminate\Http\Response
     */
    public function index(Category $categories)
    {
        $categories = $categories->with(['posts'])->get()->toFlatTree();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with(['ancestors'])->get()->toFlatTree();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryFormRequest $request)
    {
        $title = $request->input('name');
        $parent = $request->input('parent');

        $category = new Category();
        $category->name = $title;
        $category->details = $request->input('details');

        if (isset($parent)) {
            $category->parent_id = $parent;
        }

        $category->status = $request->input('status');

        if ($category->save()) {
            return redirect()->route('admin.categories.index')
                ->withSuccess("`{$title}` category added successfully.");
        }

        return back()->withInput()
            ->withSuccess("Failed adding category. Try again!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::with(['ancestors'])->get()->toFlatTree();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategoryFormRequest|Request $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryFormRequest $request, Category $category)
    {
        $title = $request->input('name');
        $parent = $request->input('parent');

        $category->name = $title;
        $category->details = $request->input('details');

        if (isset($parent)) {
            $category->parent_id = $parent;
        }

        $category->status = $request->input('status');

        if ($category->save()) {
            return redirect()->route('admin.categories.index')
                ->withSuccess("`{$title}` category updated successfully.");
        }

        return back()->withInput()
            ->withSuccess("Failed updating category. Try again!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $title = $category->name;

        if($category->delete()){
            return redirect()->route('admin.categories.index')
                ->withSuccess("`{$title}` category deleted successfully.");
        }

        return back()->withInput()
            ->withSuccess("Failed deleting `{$title}` category. Try again!");
    }
}
