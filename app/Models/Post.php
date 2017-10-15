<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, OrderableTrait, PivotOrderableTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The number of models to return for pagination
     *
     * var int
     */
    protected $perPage = 100;

    /**
     * Get live post(s).
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsLive($query)
    {
        return $query->where('live', true);
    }

    /**
     * Get post(s) not live.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsNotLive($query)
    {
        return $query->where('live', false);
    }

    /**
     * Get posts by given author.
     *
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeByAuthor($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    /**
     * Get posts in given category.
     *
     * @param $query
     * @param Category $category
     * @return mixed
     */
    public function scopeFromCategory($query, Category $category)
    {
        return $query->whereIn('category_id', array_merge(
            [$category->id],
            $category->descendants->pluck('id')->toArray()
        ));
    }

    /**
     * Get post status.
     *
     * @return mixed
     */
    public function live()
    {
        return $this->live;
    }

    /**
     * Check if post owned by given user.
     *
     * @param User $user
     * @return bool
     */
    public function ownedByUser(User $user)
    {
        return $this->user->id === $user->id;
    }

    /**
     * Get user that owns the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get favouriteables owned by listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function favourites()
    {
        return $this->morphToMany(User::class, 'favouriteable');
    }

    /**
     * Get user that favourited the listing.
     *
     * @param User $user
     * @return mixed
     */
    public function favouritedBy(User $user)
    {
        return $this->favourites->contains($user);
    }

    /**
     * Get users who viewed listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function viewedUsers()
    {
        return $this->morphToMany(User::class, 'viewable', 'user_page_views')->withTimestamps()->withPivot(['count']);
    }

    public function views()
    {
        return array_sum($this->viewedUsers->pluck('pivot.count')->toArray());
    }

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the post's ratings.
     */
    public function ratings()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }
}
