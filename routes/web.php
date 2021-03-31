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

Route::get('/', 'HomeController@index')->name('home');

/*Route::get('/alert', function (){
    return redirect()->route('home')->with('info', 'Вы можете войти!');
});*/

// регистрация
Route::get('/signup', 'AuthController@getSignUp')->middleware('guest')->name('auth.signup');
Route::post('/signup', 'AuthController@postSignUp')->middleware('guest');

// авторизация
Route::get('/signin', 'AuthController@getSignIn')->middleware('guest')->name('auth.signin');
Route::post('/signin', 'AuthController@postSignIn')->middleware('guest');

// выход
Route::get('/signout', 'AuthController@getSignOut')->name('auth.signout');

// search
Route::get('/search', 'SearchController@getSearch')->name('search.results');

// Profile
Route::get('/user/{username}', 'ProfileController@getProfile')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@getEdit')->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', 'ProfileController@postEdit')->middleware('auth')->name('profile.edit');

// friends
Route::get('/friends', 'FriendController@getIndex')->middleware('auth')->name('friend.index');
Route::get('friends/add/{username}', 'FriendController@getAdd')->middleware('auth')->name('friend.add');
Route::get('friends/accept/{username}', 'FriendController@getAccept')->middleware('auth')->name('friend.accept');
Route::post('friends/delete/{username}', 'FriendController@postDelete')->middleware('auth')->name('friend.delete');

// стена
Route::post('/status', 'StatusController@postStatus')->middleware('auth')->name('status.post');
