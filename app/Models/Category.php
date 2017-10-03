<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait, OrderableTrait, PivotOrderableTrait;

    protected $fillable = ['name', 'slug', 'price', 'details'];

    /**
     * Get the route key for the model.
     * Use 'slug' instead of id
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get active categories.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Fetch posts owned by category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}