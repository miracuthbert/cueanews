<?php

namespace App\Transformers;


use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category', 'comments'];

    protected $defaultIncludes = ['user'];

    /**
     * @param Post $post
     * @return array
     */
    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'image' => $post->image,
            'created_at' => $post->created_at->toDayDateTimeString(),
            'created_at_human' => $post->created_at->diffForHumans(),
            'views_count' => $post->views(),
            'comments_count' => $post->comments->count(),
        ];
    }

    /**
     * Post user model.
     *
     * @param Post $post
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Post $post)
    {
        return $this->item($post->user, new UserTransformer);
    }

    /**
     * @param Post $post
     * @return \League\Fractal\Resource\Item
     */
    public function includeCategory(Post $post)
    {
        return $this->item($post->category, new CategoryTransformer);
    }

    /**
     * @param Post $post
     * @return \League\Fractal\Resource\Item
     */
    public function includeComments(Post $post)
    {
        return $this->collection($post->comments, new CommentTransformer);
    }
}