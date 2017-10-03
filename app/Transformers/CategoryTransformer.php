<?php

namespace App\Transformers;


use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['posts'];

    /**
     * @param Category $category
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'name' => $category->name,
            'slug' => $category->slug,
            'details' => $category->details,
            'posts_count' => $category->posts->count(),
        ];
    }

    public function includePosts(Category $category)
    {
        return $this->collection($category->posts, new PostTransformer);
    }
}