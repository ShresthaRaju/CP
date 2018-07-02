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
Route::get('/discussions/popular', 'PagesController@popularDiscussions')->name('popular');
Route::get('/discussions/popular-this-week', 'PagesController@popularDiscussionsThisWeek')->name('popularThisWeek');
Route::get('/discussions/solved', 'PagesController@solvedDiscussions')->name('solved');
Route::get('/discussions/unsolved', 'PagesController@unsolvedDiscussions')->name('unsolved');
Route::get('/discussions/leaderboard', 'PagesController@leaderboard')->name('leaderboard');
Route::get('/channels/{channelTitle}', 'PagesController@channel')->name('channel');
Route::get('/user/@{username}', 'PagesController@userProfile')->name('userProfile');
Route::put('/user/{user}/socialize', 'Admin\UsersController@socialize')->name('socialize');
Route::put('/user/{user}/changepassword', 'Admin\UsersController@changePassword')->name('changePassword');
Route::post('/user/{user}/uploadpicture', 'Admin\UsersController@uploadDisplayPicture')->name('uploadPicture');

//marking notifications as read
Route::post('notification/{notification}/markasread', function ($notification) {
    DB::table('notifications')->where('id', $notification)->update(['read_at'=>\Carbon\Carbon::now()]);
})->middleware('auth');


Auth::routes();

Route::get('verify/{verification_token}', 'Auth\RegisterController@verify')->name('verify');

// login, logout and password resets for admin
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('login.submit');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');
    //Password Reset
    Route::get('password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\AdminResetPasswordController@reset')->name('reset');
});

// Admin Tasks
Route::prefix('admin')->as('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard')->middleware('auth:admin');
    Route::redirect('/', '/admin/dashboard', 301)->middleware('auth:admin');
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
    Route::put('/{discussion}/replied/best/{reply}', ['as'=>'reply.best','uses'=>'User\RepliesController@markBestReply']);

    //Favorite a discussions
    Route::post('/favorite', ['as'=>'favorite','uses'=>'PagesController@favorite']);
});

  Route::view('/usermanual','user.usermanual')->name('usermanual');
// Route::view('admins/{vue_capture?}', 'admin')->where('vue_capture', '[\/\w\.-]*'); // {vue-capture} is for vue js history mode
