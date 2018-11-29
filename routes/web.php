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

Route::get('/email/verify','Auth\VerificationController@show');
Route::get('/email/verification/resend','Auth\VerificationController@resend');
Route::get('/email/verify/{id}','Auth\VerificationController@verify')->name('web.verification.verify');

Route::post('/password/email','auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset','auth\ForgotPasswordController@showLinkRequestForm');
Route::post('/password/reset','auth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset/{token}','auth\ResetPasswordController@showResetForm')->name('password.reset');

//Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('web.register');
//Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::get('app/{vue_capture?}', function () {
    return view('app');
})->where('vue_capture', '[\/\w\.\,\-]*');
Route::get('app/login', function () {
	return view('app');
})->name('login');

Route::get('/',function(){
	return view('home');
});

