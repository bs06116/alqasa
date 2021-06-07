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

Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('validatePhone', 'Api\Auth\RegisterController@validatePhone');
Route::post('registerWithSocial', 'Api\Auth\RegisterController@registerWithSocial');
Route::post('resentCode', 'Api\Auth\RegisterController@resentCode');
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('forgetPassword', 'Api\Auth\LoginController@forgetPassword');
Route::post('validateForget', 'Api\Auth\LoginController@validateForget');
Route::post('changePassword', 'Api\Auth\LoginController@changePassword');

//countries
Route::get('countries', 'Api\CountryController@index')->name('countries');
Route::get('countries/show/{id}', 'Api\CountryController@show')->name('countries.show');

//cities
Route::get('cities', 'Api\CityController@index')->name('cities');
Route::get('cities/getAll/{pageCount}', 'Api\CityController@getAll')->name('cities.getAll');
Route::get('cities/show/{id}', 'Api\CityController@show')->name('cities.show');

//areas
Route::get('areas/{cityId}', 'Api\AreaController@index')->name('areas');
Route::get('areas/getAll/{cityId}/{pageCount}', 'Api\AreaController@getAll')->name('areas.getAll');
Route::get('areas/show/{id}', 'Api\AreaController@show')->name('areas.show');

//general departments
Route::get('generalDepartments', 'Api\GeneralDepartmentController@index')->name('generalDepartments');
Route::get('generalDepartments/getAll/{pageCount}', 'Api\GeneralDepartmentController@getAll')->name('generalDepartments.getAll');
Route::get('generalDepartments/show/{id}', 'Api\GeneralDepartmentController@show')->name('generalDepartments.show');

//maps
Route::post('maps', 'Api\MapController@index')->name('maps');

//users
Route::post('users', 'Api\UserController@index')->name('users');
Route::post('users/getAll', 'Api\UserController@getAll')->name('users.getAll');
Route::post('users/show', 'Api\UserController@show')->name('users.show');

//departments
Route::get('departments/{type}', 'Api\DepartmentController@index')->name('departments');
Route::get('departments/getAll/{type}/{pageCount}', 'Api\DepartmentController@getAll')->name('departments.getAll');
//Route::get('departments', 'Api\DepartmentController@index')->name('departments');
//Route::get('departments/getAll/{pageCount}', 'Api\DepartmentController@getAll')->name('departments.getAll');
Route::get('departments/show/{id}', 'Api\DepartmentController@show')->name('departments.show');

//products
Route::post('products', 'Api\ProductController@index')->name('products');
Route::post('products/getAll', 'Api\ProductController@getAll')->name('products.getAll');
Route::post('products/show', 'Api\ProductController@show')->name('products.show');

//advertisement
Route::post('advertisements', 'Api\AdvertisementController@index')->name('advertisements');
Route::post('advertisements/getAll/{pageCount}', 'Api\AdvertisementController@getAll')->name('advertisements.getAll');
Route::get('advertisements/show/{id}', 'Api\AdvertisementController@show')->name('advertisements.show');

//rate
Route::post('rate/all', 'Api\RateController@index')->name('rate.all');

Route::get('test_bayment', 'Api\ReservationController@test_bayment')->name('test_bayment');


//reservations
Route::prefix('reservations')->group(function(){
    Route::post('add', 'Api\ReservationController@add');
    Route::post('delete/item', 'Api\ReservationController@deleteItem');
    Route::post('edit/item', 'Api\ReservationController@editItem');
    Route::post('view/item', 'Api\ReservationController@viewItem');
    Route::post('delete', 'Api\ReservationController@delete');
    Route::post('finish', 'Api\ReservationController@finish');
    Route::post('checkPromocode', 'Api\ReservationController@check_promocode');
    Route::post('countItem', 'Api\ReservationController@countItem');
    Route::get('paymentFailure', 'Api\ReservationController@payment_failure')->name('paymentFailure');
    Route::get('paymentSuccess', 'Api\ReservationController@payment_success')->name('paymentSuccess');
});

//clients
Route::prefix('clients')->group(function(){
    Route::Post('myReservations', 'Api\DateController@myReservations')->name('myReservations');
});

//message
Route::prefix('messages')->group(function(){
    Route::post('add', 'Api\MessageController@add');
});
