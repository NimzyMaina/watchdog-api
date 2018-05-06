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

Route::group(['prefix' => 'settings'],function (){
    Route::get('tariffs','SettingsController@index')->name('settings.tariffs');
    Route::get('tariffData','SettingsController@tariffData')->name('settings.tariffs.data');

    Route::get('tariffs/create','SettingsController@tariffCreate')->name('settings.tariffs.create');
    Route::post('tariffs/create','SettingsController@tariffStore')->name('settings.tariffs.store');
    Route::put('tariffs/update','SettingsController@tariffUpdate')->name('settings.tariffs.update');
});

Route::get('test',function (){
    $phone = "0724844946"; // safaricom
    $phone = "+254789606416"; // airtel
    $safaricom = "/(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-2]{1})[0-9]{6}\z/";
    $equitel = "/(\+?254|0|^){1}[-. ]?[7]{1}([6]{1}[3-5]{1})[0-9]{6}\z/";
    $airtel = "/(\+?254|0|^){1}[-. ]?[7]{1}([3-5]{1}[0-6]{1}|[8]{1}[5-9]{1})[0-9]{6}\z/";
    $telcom = "/(\+?254|0|^){1}[-. ]?[7]{1}([7]{1}[0-6]{1})[0-9]{6}\z/";
    if(preg_match($safaricom,$phone)){
        echo 'SAFARICOM';
    }else if(preg_match($airtel,$phone)) {
        echo 'AIRTEL';
    }else if(preg_match($equitel,$phone)) {
        echo 'EQUITEL';
    }else if(preg_match($telcom,$phone)) {
        echo 'TELCOM';
    }else {
        echo "UNKNOWN";
    }
});

Route::get('test2',function (){
   $value = 30;
   $unit = 60;
   $charge = 3;

   echo $charge * ($value/$unit);

});
