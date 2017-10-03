<?php

namespace App\Policies;

use App\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\User $user
     * @param  \App\Models\Comment $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User $user
     * @param  \App\Models\Comment $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $this->touch($user, $comment);
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User $user
     * @param  \App\Models\Comment $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return $this->touch($user, $comment);
    }

    /**
     * Determine whether the user can perform an action on the comment.
     *
     * @param  \App\User $user
     * @param  \App\Models\Comment $comment
     * @return mixed
     */
    public function touch(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
}