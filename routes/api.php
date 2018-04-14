<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->group(['prefix' => 'v1'], function ($api) {

    $api->post('login/{provider}','Auth\LoginController@login');
    //$api->get('login/{provider}','LoginController@login');

    $api->post('auth','Auth\LoginController@authenticate');

    $api->post('register','Auth\LoginController@register');

    $api->post('calls','CallsController@store');

    $api->post('sms','SmsController@store');
});
