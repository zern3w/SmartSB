<?php

Auth::routes();

Route::get('/', function () {
  return view('main');
});

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
 Route::get('/login', 'SbparentAuth\LoginController@showLoginForm')->middleware('guest');
 Route::post('/login', 'SbparentAuth\LoginController@login')->middleware('guest');
 Route::post('/logout', 'SbparentAuth\LoginController@logout')->middleware('sbparent');
 Route::get('/register', 'SbparentAuth\RegisterController@showRegistrationForm')->middleware('guest');
 Route::post('/register', 'SbparentAuth\RegisterController@register')->middleware('guest');
 Route::post('/password/email', 'SbparentAuth\ForgotPasswordController@sendResetLinkEmail')->middleware('guest');
 Route::post('/password/reset', 'SbparentAuth\ResetPasswordController@reset')->middleware('guest');
 Route::get('/password/reset', 'SbparentAuth\ForgotPasswordController@showLinkRequestForm');
 Route::get('/password/reset/{token}', 'SbparentAuth\ResetPasswordController@showResetForm');
 Route::get('/profile', 'ParentsController@showProfile')->middleware('sbparent');
 Route::post('/profile', 'ParentsController@update_photo')->middleware('sbparent');
 Route::get('/review', 'ParentsController@showReview')->middleware('sbparent');
 Route::get('/childrenList', 'ParentsController@childrenList')->middleware('sbparent');
});

Route::get('sbparent/changepassword/', 'SbparentAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('/deleteParent', 'ParentsController@deleteParent');
Route::post('/newParent', 'ParentsController@newParent');

Route::patch('sbparent/profile', [
  'uses' => 'ParentsController@update_photo',
  'as' => 'sbparent/profile',
  'middleware' => ['sbparent']
  ]);

Route::patch('sbparent/login', [
  'uses' => 'SbparentAuth\LoginController@showLoginForm',
  'as' => 'sbparent/login',
  'middleware' => ['guest']
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

Route::get('drivers/{id}/{sId}', [
  'uses' => 'ReviewsController@showDriverProfile',
  'as' => 'review'
  ]);

Route::post('drivers/{id}/{sId}', [
  'uses' => 'ReviewsController@createReview',
  'as' => 'review',
  'middleware' => ['sbparent']
  ]);

Route::get('service/request/{id}/{dId}', [
  'uses' => 'ServiceController@serviceRequest',
  'as' => 'service.request',
  'middleware' => ['sbparent']
  ]);

Route::get('sbparent', [
  'uses' => 'ParentsController@showIndex',
  'as' => 'parent.index',
  'middleware' => ['sbparent']
  ]);

Route::get('request', [
  'uses' => 'ServiceController@showrequest',
  'as' => 'service.showrequest',
  'middleware' => ['auth']
  ]);

Route::get('children/list/{dId}', [
  'uses' => 'ParentsController@childRequest',
  'as' => 'service.childrequest',
  'middleware' => ['sbparent']
  ]);

Route::get('/request/delete/{id}', [
  'uses' => 'ServiceController@deleteRequest',
  'as' => 'request.delete',
  'middleware' => ['auth'],
  ]);

Route::get('/request/accept/{id}', [
  'uses'       => 'ServiceController@acceptRequest',
  'as'         => 'request.accept',
  'middleware' => ['auth'],
  ]);

