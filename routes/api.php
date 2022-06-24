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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//login api
//Route::post('/signlogin','UserController@apilogin');

Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LogoutController@logout');
Route::post('/testLoginSession','UserController@testLoginSession');

Route::post('/testLoginSession','UserController@testLoginSession');

Route::get('/getallusers','UserController@getallusers_api');
Route::get('/getuser/{id}','UserController@getallusers_api');

?>


