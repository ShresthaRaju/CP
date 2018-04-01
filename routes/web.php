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

Route::get('/', 'PagesController@welcome')->name('welcome');
Route::get('/popular', 'PagesController@popular')->name('popular');
Route::get('/channels/{channelTitle}', 'PagesController@channel')->name('channel');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('verify/{verification_token}', 'Auth\RegisterController@verify')->name('verify');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::redirect('/', '/admin/dashboard', 301);
    Route::resource('users', 'Admin\UsersController')->except(['create','show','edit','update']);
    Route::resource('channels', 'Admin\ChannelsController')->except(['create','edit']);
    Route::resource('discussions', 'Admin\DiscussionsController')->except(['create','edit','update']);
});

Route::prefix('discussion')->as('discussion.')->group(function () {
    // Discussions
    Route::get('create', ['as'=>'create','uses'=>'User\DiscussionsController@create']);
    Route::post('/', ['as'=>'store','uses'=>'User\DiscussionsController@store']);
    Route::get('/{slug}', ['as'=>'show','uses'=>'User\DiscussionsController@show']);
    Route::get('/{slug}/edit', ['as'=>'edit','uses'=>'User\DiscussionsController@edit']);
    Route::put('/{id}', ['as'=>'update','uses'=>'User\DiscussionsController@update']);

    // Replies
    Route::get('/{discussion}/replies', ['as'=>'replies','uses'=>'User\RepliesController@index']);
    Route::post('/{discussion}/reply', ['as'=>'reply.create','uses'=>'User\RepliesController@store']);
    Route::put('/replied/{reply}', ['as'=>'reply.update','uses'=>'User\RepliesController@update']);
    Route::delete('/replied/{reply}', ['as'=>'reply.delete','uses'=>'User\RepliesController@destroy']);
});


// Route::view('admins/{vue_capture?}', 'admin')->where('vue_capture', '[\/\w\.-]*'); // {vue-capture} is for vue js history mode
