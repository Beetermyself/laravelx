<?php

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;

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

Route::post('/register', 'API\AuthenticateController@register');

Route::post('/user','Api\IndexController@index');

Route::post('/auth/token','Api\AuthenticateController@authenticated');

Route::post('/addRole','Api\IndexController@addRoleName');

Route::post('/setUserRole','Api\IndexController@setUserRole');
