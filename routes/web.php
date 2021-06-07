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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Auth\LoginController@showLoginForm');

//admin
Route::group(['middleware'=>'auth'], function(){
	//admin home
	Route::get('admin', 'back\HomeController@index')->name('admin');
	Route::resource('admin/home', 'back\HomeController');	


	//GeneralDepartment
	Route::resource('admin/generalDepartment', 'back\GeneralDepartmentController');
	//Country
	Route::resource('admin/country', 'back\CountryController');		
	//City
	Route::resource('admin/city', 'back\CityController');
	//Area
	Route::resource('admin/area', 'back\AreaController');
	//Department
	Route::resource('admin/department', 'back\DepartmentController');
	//Products
    Route::get('admin/product/active/{id}','back\ProductController@active')->name('product.active');
	Route::resource('admin/product', 'back\ProductController');
	//PromoCode
	Route::resource('admin/promoCode', 'back\PromoCodeController');
	//User
	Route::resource('admin/user', 'back\UserController');
	Route::get('admin/user/showAll/{id}','back\UserController@showAll')->name('user.showAll');
	//Client
	Route::resource('admin/client', 'back\ClientController');
	Route::get('admin/client/active/{id}','back\ClientController@active')->name('client.active');	
	//Reservation
	Route::get('admin/reservation/show_delete', 'back\ReservationController@showDelete')->name('reservation.show_delete');
	Route::get('admin/reservation/statues/{id}','back\ReservationController@statues')->name('reservation.statues');	
	Route::resource('admin/reservation', 'back\ReservationController');


	//social
	Route::resource('admin/social', 'back\SocialController');	
	//setting
	Route::resource('admin/setting', 'back\SettingController');	
	//message
	Route::resource('admin/message', 'back\MessageController');		
});
//end of admin

//Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('sendSms','SendSmsController@sendSms')->name('sendSms');
Route::get('test','SendSmsController@test')->name('test');
Route::get('video','SendSmsController@video')->name('video');

