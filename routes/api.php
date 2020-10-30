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

	Route::GET('edit_store/{id}', 'Api\SysStoreController@editStore');
	Route::post('update_store/{user_id}', 'Api\SysStoreController@update_store');
    Route::GET('get_bank_details/{user_id}', 'Api\SysStoreController@get_bank_details');
    Route::post('update_bank_details/{user_id}', 'Api\SysStoreController@update_bank_details');

    Route::post('change_password/{user_id}', 'Api\AuthController@change_password');


    //user add bank card info after sign up
    Route::post('create_bank_card_details', 'Api\SysStoreController@create_bank_card_details');

    Route::GET('get_user_profile_details/{user_id}', 'Api\SysStoreController@get_user_profile_details');
    Route::post('update_user_profile_details/{user_id}', 'Api\SysStoreController@update_user_profile_details');



    Route::GET('get_bank_card_details/{user_id}', 'Api\SysStoreController@get_bank_card_details');
    Route::post('update_bank_card_details/{user_id}', 'Api\SysStoreController@update_bank_card_details');


	// Start Product Api
	Route::get('get_products/{user_id}', 'Api\SysProductController@get_products');
	Route::post('add_product', 'Api\SysProductController@addProduct');
	Route::get('edit_product/{id}', 'Api\SysProductController@editProduct');
	Route::post('update_product/{id}', 'Api\SysProductController@updateProduct');
	Route::delete('delete_product/{id}', 'Api\SysProductController@deleteProduct');
	Route::post('update_product_quantity/{id}', 'Api\SysProductController@updateProdcutQuantity');



	Route::post('goal', 'Api\UserGoalController@usergoalPost');
	Route::post('user/personal/detail', 'Api\UserPersonalDetailController@userpersonalDetail');
	Route::post('user/medical/detail', 'Api\UserMedicalDetailController@usermedicalDetail');
	Route::post('user/plan/type', 'Api\UserPersonalDetailController@userplanType');
	Route::get('user/data', 'Api\UserPersonalDetailController@getuserData');
	Route::post('user/payment', 'Api\PaymentController@handleonlinepay');

	//start service
	Route::post('add_service', 'Api\SysServiceController@addService');
	Route::get('get_service/{user_id}', 'Api\SysServiceController@getServices');
	Route::get('edit_service/{id}', 'Api\SysServiceController@editService');
	Route::post('update_service/{id}', 'Api\SysServiceController@updateService');
	Route::delete('delete_service/{id}', 'Api\SysServiceController@deleteService');
	

	//start restaurant menu category
	Route::post('add_res_menu_cat', 'Api\SysRestaurantMenuCategories@addResMenuCategory');
	Route::get('get_res_menu_cat', 'Api\SysRestaurantMenuCategories@getResMenuCategory');
	Route::get('edit_res_menu_cat/{id}', 'Api\SysRestaurantMenuCategories@editResMenuCategory');
	Route::post('update_res_menu_cat/{id}', 'Api\SysRestaurantMenuCategories@updateResMenuCategory');
	Route::delete('delete_res_menu_cat/{id}', 'Api\SysRestaurantMenuCategories@deleteResMenuCategory');

	
	//start restaurant menu 
	Route::post('add_res_menu', 'Api\SysRestaurantMenuController@addResMenu');
	Route::get('get_res_menu/{user_id}', 'Api\SysRestaurantMenuController@getResMenu');
	Route::get('edit_res_menu/{id}', 'Api\SysRestaurantMenuController@editResMenu');
	Route::post('update_res_menu/{id}', 'Api\SysRestaurantMenuController@updateResMenu');
	Route::delete('delete_res_menu/{id}', 'Api\SysRestaurantMenuController@deleteResMenu');

	Route::get('get_all_restuarants_stores', 'Api\SysUserDashboard@get_all_restuarants');
	Route::get('get_tours_stores', 'Api\SysUserDashboard@get_tours_stores');
	Route::get('get_water_activities_stores', 'Api\SysUserDashboard@get_water_activities_stores');
	Route::get('get_land_activities_stores', 'Api\SysUserDashboard@get_land_activities_stores');


	// get the Store Details
	Route::GET('get_store_details/{id}', 'Api\SysStoreController@get_store_details');


});

// Route::middleware('auth:api')->group( function () {
// 	Route::post('goal', 'Api\UserGoalController@usergoalPost');
// });
Route::post('goal', 'Api\UserGoalController@usergoalPost');





