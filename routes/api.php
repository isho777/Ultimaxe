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

Route::post('/login_api','Auth\LoginController@login_api');
Route::post('/logout_api','Auth\LogoutController@logout_api');
Route::post('/testLoginSession','UserController@testLoginSession');
Route::get('/getallusers','UserController@getallusers_api');
Route::get('/getcurrentuser_api','UserController@getcurrentuser_api');
Route::get('/getuserbyid_api/{id}','UserController@getuserbyid_api');
Route::get('/getuserbyemail_api/{email}','UserController@getuserbyemail_api');
Route::post('/registeruser_api','UserController@registeruser_api');

Route::get('/getcustomerbyname_api','CustomerController@getcustomerbyname_api');
Route::get('/getcustomerbyemail_api','CustomerController@getcustomerbyemail_api');
Route::get('/getcustomerbyid_api','CustomerController@getcustomerbyid_api');
Route::get('/getallcustomers_api','CustomerController@getallcustomers_api');
Route::post('/registercustomer_api','CustomerController@registercustomer_api');
Route::get('/getcustomerbyid_api','CustomerController@getcustomerbyid_api');
Route::get('/getcustomerbyemail_api','CustomerController@getcustomerbyemail_api');

Route::get('/getallorders_api','OrderController@getallorders_api');
Route::get('/getorderbyid','OrderController@getorderbyid');
Route::get('/getorderbymultiple','OrderController@getorderbymultiple');



?>


