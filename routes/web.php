<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * User Group Routes
 */
Route::group(['prefix' => '/user'], function () {

    //User profile
    Route::get('/profile', 'User\ProfileController@edit')->name('user.profile');
    Route::put('/profile/{id}', 'User\ProfileController@update')->name('user.update');

});

/**
 * Admin Group Routes
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    //dashboard routes
    Route::get('/dashboard', 'DashboardController')->name('admin.dashboard');

    //metrics download route
    Route::get('/metrics/download', 'Reports\MetricsDownloadController')->name('admin.reports.metrics.download');

    //users download route
    Route::get('/users/download', 'Reports\UsersDownloadController')->name('admin.reports.users.download');

    /**
     * Roles Group Route
     */
    Route::group(['prefix' => '/roles', 'namespace' => 'Role'], function () {

        //role users store route
        Route::post('/{role}/users', 'RoleUsersController@store')->name('admin.roles.users.store');

        //role users index route
        Route::get('/{role}/users', 'RoleUsersController@index')->name('admin.roles.users.index');

        //role users delete route
        Route::delete('/{role}/users/delete', 'RoleUsersController@destroy')->name('admin.roles.users.destroy');
    });

    /**
     * Roles Resource Route
     */
    Route::resource('roles', 'Role\RoleController', [
        'names' => [
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'show' => 'admin.roles.show',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy',
        ]
    ]);

    /**
     * Users Resource Route
     */
    Route::resource('users', 'User\UserController', [
        'names' => [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]
    ]);

    /**
     * Categories Resource Route
     */
    Route::resource('categories', 'Category\CategoryController', [
        'names' => [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]
    ]);

    /**
     * Posts Resource Route
     */
    Route::resource('posts', 'Post\PostController', [
        'names' => [
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'store' => 'admin.posts.store',
            'show' => 'admin.posts.show',
            'edit' => 'admin.posts.edit',
            'update' => 'admin.posts.update',
            'destroy' => 'admin.posts.destroy',
        ]
    ]);

});