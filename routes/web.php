<?php
//Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('login');
       });
 //});


//Route::auth();
Route::get('/login', ['as' => 'login' , 'uses' => 'DtbLoginController@login']);

//Route::group(['middleware' => 'CheckAuthenticateUserMiddleware'], function () {

Route::post('/checkLogin', ['as' => 'checkLogin' , 'uses' => 'DtbLoginController@checkLogin']);
Route::get('/register', ['as' => 'register' , 'uses' => 'DtbLoginController@register']);
Route::post('/makeRegister', ['as' => 'makeRegister' , 'uses' => 'DtbLoginController@makeRegister']);
Route::get('/user/verify/{token}', 'DtbLoginController@verifyUser');
Route::get('email_confirm/{already}', ['as' => 'email_confirm' , 'uses' => 'DtbLoginController@emailConfirm']);
Route::get('/logout', ['as' => 'logout' , 'uses' => 'DtbLoginController@destroy']);
Route::get('/home', ['as' => 'home' , 'uses' => 'HomeController@index']);

Route::resource('role', 'DtbRoleController');// start Settings Route

// start for fitness project

// Start the Customer Area

Route::resource('/customer','FitnessCustomerControllers');
Route::get('/delete_customer_view/{id}', ['as' => 'delete_customer_view' , 'uses' => 'FitnessCustomerControllers@deleteView']);
Route::get('/change_to_staff_view/{id}', ['as' => 'change_to_staff_view' , 'uses' => 'FitnessCustomerControllers@changeToStaffView']);
Route::post('/change_to_staff/{id}', ['as' => 'change_to_staff' , 'uses' => 'FitnessCustomerControllers@changeToStaff']);



Route::post('/add_note', ['as' => 'add_note' , 'uses' => 'FitnessCustomerControllers@addNote']);
Route::post('/delete_note/{id}', ['as' => 'delete_note' , 'uses' => 'FitnessCustomerControllers@deleteNote']);

Route::post('/add_file', ['as' => 'add_file' , 'uses' => 'FitnessCustomerControllers@addFile']);
Route::post('/delete_file/{id}', ['as' => 'delete_file' , 'uses' => 'FitnessCustomerControllers@deleteFile']);


// End the Customer Area

// Start the Coach Area


// End the Coach Area
Route::resource('/coach','FitnessCoachController');
Route::get('/change_to_customer_view/{id}', ['as' => 'change_to_customer_view' , 'uses' => 'FitnessCoachController@changeToCustomerView']);
Route::post('/change_to_customer/{id}', ['as' => 'change_to_customer' , 'uses' => 'FitnessCoachController@changeToCustomer']);

Route::post('/add_note_c', ['as' => 'add_note_c' , 'uses' => 'FitnessCoachController@addNote']);
Route::post('/delete_note_c/{id}', ['as' => 'delete_note_c' , 'uses' => 'FitnessCoachController@deleteNote']);

// end for fitness project

Route::resource('/goal','FitnessGoalController');
Route::get('/delete_goals_view/{id}', ['as' => 'delete_goals_view' , 'uses' => 'FitnessGoalController@deleteGoalView']);

// workout_category
Route::resource('/workout_category','FitnessWorkOutCategoryController');
Route::get('/delete_category_view/{id}', ['as' => 'delete_category_view' , 'uses' => 'FitnessWorkOutCategoryController@deleteCategoryView']);

// content Video 
Route::resource('/content','FitnessContentController');

Route::resource('/memberships','FitnessMembershipController');
Route::get('/delete_membership_view/{id}', ['as' => 'delete_membership_view' , 'uses' => 'FitnessMembershipController@deleteMembershipView']);


Route::resource('/challenges','FitnessChallengesController');





Route::get('/files', 'FitnessCustomerControllers@files');

Route::get('/clear', function() {
   Artisan::call('cache:clear');
   Artisan::call('view:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
  
   
});

