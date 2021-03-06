<?php

namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => "{$user->first_name} {$user->last_name}",
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'country' => $user->country,
            'is_verified' => $user->is_verified,
            'avatar' => $user->avatar(),
            'created_at' => $user->created_at->toDateTimeString(),
            'created_at_human' => $user->created_at->diffForHumans(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];
    }
}