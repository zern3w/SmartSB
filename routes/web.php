<?php

Auth::routes();

Route::get('/', function () {
  return view('main');
});

// Route::get('/', 'SearchController@getResults');
Route::get('/search', 'SearchController@postResults');

Route::get('/bookservice', function () {
  return view('bookservice');
});

//------------------------------SchoolBusDriver------------------------------
Route::get('/home', 'DriversController@showIndex');
Route::get('/studentlist', 'DriversController@showStudentList');
Route::get('/profile', 'DriversController@showProfile');
Route::get('/report/{id}', ['uses' =>'DriversController@getStudentReport']);
Route::get('driver/changepassword/', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::post('profile', 'DriversController@update_photo');
Route::post('/searchDrivers', 'DriversController@searchDrivers');
Route::post('/getLocation', 'DriversController@getLocation');

Route::group(['middleware' => ['web']], function() {
  Route::resource('driver','DriversController');
});

//----------------------------------Parent-----------------------------------
Route::group(['prefix' => 'sbparent'], function () {
 Route::get('/', 'ParentsController@index')->middleware('sbparent');
  Route::get('/login', 'SbparentAuth\LoginController@showLoginForm');
  Route::post('/login', 'SbparentAuth\LoginController@login');
  Route::post('/logout', 'SbparentAuth\LoginController@logout');
  Route::get('/register', 'SbparentAuth\RegisterController@showRegistrationForm');
  Route::post('/register', 'SbparentAuth\RegisterController@register');
  Route::post('/password/email', 'SbparentAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'SbparentAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'SbparentAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'SbparentAuth\ResetPasswordController@showResetForm');
  Route::get('/profile', 'ParentsController@showProfile')->middleware('sbparent');
  Route::post('/profile', 'ParentsController@update_photo');
  Route::get('/review', 'ParentsController@showReview');
   Route::get('/childrenList', 'ParentsController@childrenList')->middleware('sbparent');
});

Route::get('sbparent/changepassword/', 'SbparentAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('/deleteParent', 'ParentsController@deleteParent');
Route::post('/newParent', 'ParentsController@newParent');

Route::patch('sbparent/profile', [
  'uses' => 'ParentsController@update_photo',
  'as' => 'sbparent/profile'
  ]);

Route::patch('sbparent/login', [
  'uses' => 'SbparentAuth\LoginController@showLoginForm',
  'as' => 'sbparent/login'
  ]);

Route::group(['middleware' => ['sbparent']], function() {
    Route::resource('parent','ParentsController');
  });
//------------------------------Student-------------------------------------
Route::get('/addchild', 'StudentsController@addchild')->middleware('sbparent');

Route::get('/pdf', array('as'=>'htmltopdf', 'uses'=> 'StudentsController@generateTag'))->middleware('sbparent');

Route::group(['middleware' => ['web']], function() {
  Route::resource('student','StudentsController');
});

//------------------------------------------------------------------------------

Route::post('/getSchool', 'SchoolsController@getSchool');

Route::get('drivers/{id}', 'ReviewsController@showDriverProfile');

// Route::post('drivers/{id}', 'ReviewsController@createReview');

Route::post('drivers/{id}', [
  'uses' => 'ReviewsController@createReview',
  'as' => 'review'
  ])->middleware('sbparent');

Route::get('sbparent/service', 'ServiceController@getIndex')->middleware('sbparent');