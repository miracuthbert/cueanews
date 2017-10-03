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
            'name' => "{$user->first_name} {$user->last_name}",
            'username' => $user->username,
            'avatar' => $user->avatar(),
        ];
    }
}