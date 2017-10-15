<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    /**
     * Get all of the owning rateable models.
     */
    public function rateable()
    {
        return $this->morphTo();
    }

    /**
     * Get user that owns the rate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
