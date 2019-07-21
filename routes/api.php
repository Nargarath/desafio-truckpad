<?php

use Illuminate\Http\Request;

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

Route::group([
    'middleware'    => 'api',
    'prefix'        => 'auth',
    'namespace'     => 'Api'
], function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');
});

Route::group([
    'middleware'    => 'auth:api',
    'prefix'        => 'people',
    'namespace'     => 'Api'
], function ($router) {
    Route::get('/', 'PeopleController@datatable')->name('people.datatable');
    Route::post('/', 'PeopleController@post')->name('people.post');
    Route::get('{id}', 'PeopleController@get')->name('people.get');
    Route::put('{id}', 'PeopleController@put')->name('people.put');
    Route::patch('{id}', 'PeopleController@patch')->name('people.patch');
    Route::delete('{id}', 'PeopleController@delete')->name('people.delete');
});

