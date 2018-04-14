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

$s = 'social.';
Route::get('/social/redirect/{provider}',['as' => $s . 'redirect','uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}', ['as' => $s . 'handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

// Email verification
Route::get('user/activate/{token}','Auth\ActivationController@activateUser')->name('user.activate');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('calls','DashController@calls')->name('calls');
Route::get('getcalls','DashController@getCalls')->name('calls.get');

Route::get('sms','DashController@sms')->name('sms');
Route::get('getSms','DashController@getSms')->name('sms.get');

// Manage users
Route::group(['prefix' => 'users'],function(){
    // display users table
    Route::get('list', 'UsersController@index')->name('users.list');
    //datatables user data
    Route::get('data','UsersController@userData')->name('users.data');
    // show import users
    Route::get('import','UsersController@importForm')->name('users.importForm');
    // import users
    Route::post('import','UsersController@import')->name('users.import');
    // show edit user
    Route::get('/{id}/edit','UsersController@edit')->name('user.edit');
    // update user
    Route::put('/{id}/edit','UsersController@update')->name('user.update');
    // download template
    Route::get('template','UsersController@getTemplate')->name('users.template');
    // deactivate user
    Route::get('deactivate/{id}','UsersController@deactivate')->name('users.deactivate');
    // activate user
    Route::get('activate/{id}','UsersController@activate')->name('users.activate');

});
