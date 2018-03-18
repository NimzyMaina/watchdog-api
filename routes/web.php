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
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect','uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle', 'uses' => 'Auth\SocialController@getSocialHandle']);


Route::get('/home', 'HomeController@index')->name('home');

Route::get('calls','DashController@calls')->name('calls');
Route::get('getcalls','DashController@getCalls')->name('calls.get');

Route::get('sms','DashController@sms')->name('sms');
Route::get('getSms','DashController@getSms')->name('sms.get');
