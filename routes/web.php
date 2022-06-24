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

Route::POST('/test', function () {
    return Response()->json(['products'=>'Maize meal']);
})->middleware('cors');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/newcategory', function () {
    return view('new_categories');
});
Route::get('/olas','DeviceController@getCoordinates');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//category
Route::post('/savecategory', 'CategoryController@newcategory')->name('newcategory');
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/allcategory', 'CategoryController@index')->name('allcategory');
Route::get('/deletecategory/{key}', 'newdealperiodCategoryController@deletecategory');
Route::get('/successfull_callcategory', 'CategoryController@successfull')->name('allcategory');
Route::get('/unsuccessfull_callcategory', 'CategoryController@unsuccessfull')->name('allcategory');
Route::get('/editcategory/{key}', 'CategoryController@editcategory');
Route::post('/updatecategory', 'CategoryController@savecategory');

//Route::get('/editcategory')

//products
Route::get('/newproduct', 'ProductController@newScreenPage');
Route::post('/saveproduct', 'ProductController@saveproduct');
Route::get('/allproduct','ProductController@index');
Route::get('/allproducts','ProductController@productsindex');


Route::get('/editproduct/{product}','ProductController@edit');
Route::post('/updateproduct', 'ProductController@updateproduct');
Route::get('/deleteproduct/{key}', 'ProductController@deleteproduct');



//api deal periods ,
Route::get('/getdealperiod', 'DealperiodController@getdealperiod');
Route::get('/getdealperiod/{dealid}', 'DealperiodController@getdealperiodbyid');
Route::post('/savedealperiod', 'DealperiodController@newdealperiod');
Route::post('/searchcustomer', 'DealperiodController@searchcustomer');
Route::post('/findcustomer', 'CustomerController@searchcustomer');


//deal sheet system
Route::get('/alldealperiod', 'DealperiodController@getdeals');
Route::get('/newdealperiod', 'DealperiodController@newdeal');
Route::get('/signedperiod/{deal}', 'DealperiodController@alldatasheetinfo');
Route::post('/dealproducts', 'DealperiodController@savedealproductprice');

Route::get('/updatestatus/{id}', 'DealperiodController@updatestatus');


Route::post('/approvedealsheet', 'CurrentdealapproverController@approvedealperiod');

//live deal sheet system
Route::get('/livedealsheet', 'DealperiodController@livedealsheet');

Route::get('/stockmovements', 'StockonhandController@getsockonhand');


Route::get('/getorders', 'OrderController@getallorders');
Route::get('/getorders/{id}', 'OrderController@getspecificorders');
Route::post('/makeorder','OrderController@savequote');
Route::post('/savestockmovement','OrderController@savestockmovement');

Route::post('/savestockonhand','StockonhandController@savestockonhand');
Route::post('/savereport',function(){
    return Response()->json(['erro_code'=>0,'msg'=>'Successfully Saved']);
});

Route::post('/clockin','ClockingController@clock_userIn');
Route::get('/sendSignal','ClockingController@sendsignal');
Route::post('/savereport', 'ClockingController@savereportinfo');

//    ,function(){
//
//    if( 1 > 2 ){
//        return '200';
//    }else {
//        return '401';
//    }
//});


//Orders api
Route::post('/signeddealsheet', 'DealsheetsignatureController@adddealinformation');


//login api
Route::post('/signlogin','UserController@apilogin');

//UserModule Routes
Route::get('/view/newuser', 'UserController@newuser_view');
Route::post('/save/newuser', 'UserController@newuser');
Route::post('/update/user', 'UserController@updateuserinfo');
Route::post('/update/userrole', 'UserController@updateuserrole');
Route::post('/update/userdepartment', 'UserController@updateuserdepartment');
Route::get('/view/list', 'UserController@user_view');
Route::get('/activate/{id}/{status}', 'UserController@updateuserstatus');

//email 
Route::get('/send', 'UserController@emailtesting');


//Roles Routes
Route::get('/view/newrole','RoleController@new_role');
Route::post('/role/save','RoleController@saverole');
Route::get('/view/rolelisting','RoleController@list_role');
Route::get('/views/moduleroles/{roleid}/{modulename}','RoleController@modulelist_role');
Route::post('/role/update','RoleController@updaterole');
Route::post('/role/name/update','RoleController@updaterolename');
Route::post('/role/name/remove','RoleController@removerolename');

//Device Route
Route::get('/devices/new','DeviceController@newdevice');
Route::get('/devices/list','DeviceController@devicelisting');
Route::post('/devices/save','DeviceController@savedevice');
Route::post('/devices/update','DeviceController@updatedevice');
Route::post('/devices/link','DeviceController@linksave_device');
Route::post('/devices/remove','DeviceController@removedevice');

Route::post('/set/coordinates','DeviceController@devicecoordinates');
Route::get('getdevice/{id}','DeviceController@getdevicecoordinates');

// Pack route
Route::get('/pack/new','PackController@newpack');
Route::get('/pack/list','PackController@listpack');

Route::post('/pack/save','PackController@savepack');
Route::post('/pack/update','PackController@updatepack');
Route::post('/pack/remove','PackController@deletepack');

//Customers routes
Route::get('/customers/new','CustomerController@newindex');
Route::post('/customers/save','CustomerController@savecustomer');
Route::get('/editcustomer/{customerid}','CustomerController@getcustomer');
Route::post('/customers/update','CustomerController@updatecustomer');
Route::get('/customers/all','CustomerController@getcustomerinfo');


//Tasks Routes
Route::get('/new/task','TasksController@newTask');
Route::post('/save/task','TasksController@saveTask');
Route::post('/get/task','TasksController@getTask');
Route::get('/list/task','TasksController@listtask');
Route::get('/specific/task/{id}/{name}','TasksController@specifictask');


Route::post('/update/task','TasksController@updateTask');

?>











