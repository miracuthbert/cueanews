<?php

namespace App\Transformers;


use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category', 'comments', 'ratings'];

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
            'excerpt' => $post->excerpt,
            'body' => $post->body,
            'image' => $post->image,
            'created_at' => $post->created_at->toDayDateTimeString(),
            'created_at_human' => $post->created_at->diffForHumans(),
            'views_count' => $post->views(),
            'comments_count' => $post->comments->count(),
            'rating' => $post->averageRating(),
            'ratings_count' => $post->ratings->count(),
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

    /**
     * @param Post $post
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRatings(Post $post)
    {
        return $this->collection($post->ratings->pluck('user'), new UserTransformer);
    }
}