<?php

namespace App\Transformers;


use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];

    public function transform(Comment $comment)
    {
        return [
            'body' => $comment->body,
            'created_at' => $comment->created_at->toDayDateTimeString(),
            'created_at_human' => $comment->created_at->diffForHumans(),
        ];
    }

    /**
     * Comment user model.
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserTransformer);
    }
}