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

Route::post('login', 'Api\AuthController@login');
Route::post('new_register', 'Api\AuthController@register');
Route::post('provider_register', 'Api\AuthController@providerRegister');

// Route::post('/password/email', 'Api\ForgotPasswordController@emailLinkPassword');
// Route::post('/password/reset', 'Api\ResetPasswordController@resetPassword');

Route::post('password/forgotpass', 'Api\PasswordResetController@create');
Route::get('password/verify/{otp}', 'Api\PasswordResetController@find');
Route::post('password/reset', 'Api\PasswordResetController@reset');
Route::get('auth/facebook', 'Api\FacebookController@redirectToFacebook');
Route::get('facebook/user', 'Api\FacebookController@handleFacebookCallback');
//Route::post('add_bank_account', 'Api\UserGoalController@addBankAccount');

Route::group(array('middleware' => ['TokenCheck']), function () {
	Route::post('add-bank-account', 'Api\UserGoalController@addBankAccount');
	Route::get('get_service_category', 'Api\SysStoreController@getServiceCategory');
	Route::post('create_store', 'Api\SysStoreController@createStore');
	Route::post('create_service_category', 'Api\SysStoreController@create_service_category');
	Route::get('edit_service_category/{id}', 'Api\SysStoreController@edit_service_category');
	Route::post('update_service_category/{id}', 'Api\SysStoreController@update_service_category');
	Route::delete('delete_service_category/{id}', 'Api\SysStoreController@delete_service_category');

	// Start Product Api
	Route::get('get_products', 'Api\SysProductController@get_products');
	Route::post('add_product', 'Api\SysProductController@addProduct');
	Route::get('edit_product/{id}', 'Api\SysProductController@editProduct');
	Route::post('update_product/{id}', 'Api\SysProductController@updateProduct');
	Route::delete('delete_product/{id}', 'Api\SysProductController@deleteProduct');



	Route::post('goal', 'Api\UserGoalController@usergoalPost');
	Route::post('user/personal/detail', 'Api\UserPersonalDetailController@userpersonalDetail');
	Route::post('user/medical/detail', 'Api\UserMedicalDetailController@usermedicalDetail');
	Route::post('user/plan/type', 'Api\UserPersonalDetailController@userplanType');
	Route::get('user/data', 'Api\UserPersonalDetailController@getuserData');
	Route::post('user/payment', 'Api\PaymentController@handleonlinepay');
	
});

// Route::middleware('auth:api')->group( function () {
// 	Route::post('goal', 'Api\UserGoalController@usergoalPost');
// });
Route::post('goal', 'Api\UserGoalController@usergoalPost');

