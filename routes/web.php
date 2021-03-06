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
Route::resource('/discussion', 'DiscussionsController');
Route::resource('/channel', 'ChannelController');
Route::resource('/discussion/{discussion}/replies', 'RepliesController');
Route::post('/discussion/{discussion}/replies/{reply}/mark-as-best-reply', 'DiscussionsController@bestReply')->name('best-reply');
Route::get('user/notifications', 'UserController@notifications')->name('notifications');
