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

Auth::routes();

Route::get('/', 'TopSingleAction')->name('top.top');


Route::resource('posts', 'PostController');

Route::resource('users', 'UserController')->only([
    'show', 'edit', 'update', 'destroy']);
    
Route::get('/likes', 'LikeSingleAction')->name('likes.likes');
    
    
Route::resource('follows', 'FollowController')->only([
    'store', 'destroy'
    ]);
Route::get('/{user}/followers', 'FollowController@followers')->name('follows.followers');
Route::get('/{user}/following', 'FollowController@following')->name('follows.following');

Route::get('/contact', 'ContactSingleAction')->name('contact.contact');