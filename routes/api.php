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
Route::middleware('auth:api')->namespace('API')->group(function () {
	Route::get('/user','User\UserController@show');
	Route::post('/user/update','User\UserController@update');
	Route::get('/settings/notifications','User\UserController@notifications');
	Route::post('/logout', 'Auth\AuthController@logout');
	Route::get('/companies','Company\CompanyController@index');
	Route::get('/companies/default','Company\CompanyController@getDefault');
	Route::get('/companies/{id}','Company\CompanyController@show');
	Route::put('/companies/{id}/update','Company\CompanyController@update');
	Route::post('/companies/create','Company\CompanyController@store');
	Route::post('/companies/set-default','Company\CompanyController@setDefault');
	Route::delete('/companies/{id}','Company\CompanyController@destroy');
	Route::get('/areas','Area\AreaController@index');
	Route::get('/areas/{id}','Area\AreaController@show');
	Route::put('/areas/{id}/update','Area\AreaController@update');
	Route::post('areas/create','Area\AreaController@store');
	Route::delete('areas/{id}','Area\AreaController@destroy');
	Route::get('/zones','Zone\ZoneController@index');
	Route::get('/zones/{id}','Zone\ZoneController@show');
	Route::put('/zones/{id}/update','Zone\ZoneController@update');
	Route::post('zones/create','Zone\ZoneController@store');
	Route::delete('zones/{id}','Zone\ZoneController@destroy');
	Route::get('/vehicles','Resource\Vehicle\VehicleController@index');
	Route::get('/vehicles/{id}','Resource\Vehicle\VehicleController@show');
	Route::put('/vehicles/{id}/update','Resource\Vehicle\VehicleController@update');
	Route::post('vehicles/create','Resource\Vehicle\VehicleController@store');
	Route::delete('vehicles/{id}','Resource\Vehicle\VehicleController@destroy');
	Route::get('/services','Service\ServiceController@index');
	Route::get('/services/{id}','Service\ServiceController@show');
	Route::put('/services/{id}/update','Service\ServiceController@update');
	Route::post('services/create','Service\ServiceController@store');
	Route::delete('services/{id}','Service\ServiceController@destroy');
	Route::get('item-types','ItemType\ItemTypeController@index');
	Route::get('/customers','Customer\CustomerController@index');
	Route::get('/customers/{id}','Customer\CustomerController@show');
	Route::put('/customers/{id}/update','Customer\CustomerController@update');
	Route::post('customers/create','Customer\CustomerController@store');
	Route::delete('customers/{id}','Customer\CustomerController@destroy');
	Route::get('customer-types','CustomerType\CustomerTypeController@index');
});

Route::post('/email/verification/status','API\AuthController@emailVerificationStatus');
Route::post('/login', 'API\Auth\AuthController@login');
Route::post('/register', 'API\Auth\AuthController@register');




