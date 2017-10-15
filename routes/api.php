<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return fractal()->item($request->user())
        ->transformWith(new \App\Transformers\UserTransformer())
        ->toArray();
});

Route::post('/register', 'Api\Auth\RegisterController@register');

Route::resource('categories', 'Api\Category\CategoryController', [
    'only' => ['index'],
]);

Route::group(['prefix' => 'posts', 'namespace' => 'Api\Post'], function () {
    Route::group(['prefix' => '/{post}'], function () {
        //download post
        Route::get('/download', 'PostDownloadController');

        //post comments
        Route::resource('comments', 'PostCommentController', [
            'only' => ['index', 'store', 'destroy']
        ]);

        //post ratings
        Route::resource('ratings', 'PostRatingController', [
            'only' => ['store', 'destroy']
        ]);

        //post favourites
        Route::delete('favourites', 'PostFavouriteController@destroy');

        Route::resource('favourites', 'PostFavouriteController', [
            'only' => ['index', 'store']
        ]);
    });
});

Route::resource('posts', 'Api\Post\PostController', [
    'only' => ['index', 'show'],
]);