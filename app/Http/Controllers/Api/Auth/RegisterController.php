<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\StoreUserRequest;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Register's a new user.
     *
     * @param StoreUserRequest|Request $request
     * @return array
     */
    public function register(StoreUserRequest $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return fractal()->item($user)->transformWith(new UserTransformer)->toArray();
    }
}
