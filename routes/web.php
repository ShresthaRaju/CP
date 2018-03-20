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

Route::view('/', 'welcome');

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

// Route::view('admins/{vue_capture?}', 'admin')->where('vue_capture', '[\/\w\.-]*'); // {vue-capture} is for vue js history mode
