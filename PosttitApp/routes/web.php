<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/adminPage','AdminController@index');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/{user}/delete', 'ProfilesController@delete')->name('profile.delete');

//Route::get('/post/create', 'PostsController@create');
Route::get('/post/create', ['middleware' => 'auth', 'uses' => 'PostsController@create']);
Route::get('/post/{post}', 'PostsController@show');

Route::post('/post', 'PostsController@store');

Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
Route::post('vote/{post}', 'VoteController@storeup');
Route::post('voted/{post}', 'VoteController@storedown');
Route::get('/comment/{post}', ['middleware' => 'auth', 'uses' => 'CommentController@store']);
Route::get('/home/card', 'HomeController@card')->name('home');
Route::get('/home/list', 'HomeController@list')->name('home');
Route::get('/delete/{comment}', 'CommentController@delete');
Route::get('/deletePost/{post}', 'PostsController@delete');

