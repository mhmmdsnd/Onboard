<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/ListOnBoard/usermail', 'ListboardController@usermail');

Route::group(['middleware' => ['role:itadmin|admin']], function() {    #ITADMIN
    Route::get('/ITAdm/{onboardId}','OnboardController@itadm');
    #Route::post('/ITAdm','OnboardController@itadmstore');
    Route::post('/ITAdm', ['as'=>'ITAdm','uses'=>'OnboardController@itstore']);
});

Route::group(['middleware' => ['role:itinfra|admin']], function() {  #ITINFRA
    Route::get('/ITInfra/{onboardId}','OnboardController@itinf');
    #Route::post('/ITInfra','OnboardController@itinfstore');
    Route::post('/ITInfra', ['as'=>'ITInfra','uses'=>'OnboardController@itstore']);
});

Route::group(['middleware' => ['role:itapps|admin']], function() {  #ITAPPS
    Route::get('/ITApps/{onboardId}','OnboardController@itapp');
    #Route::post('/ITApps','OnboardController@itappstore');
    Route::post('/ITApps', ['as'=>'ITApps','uses'=>'OnboardController@itstore']);
});

Route::group(['middleware' => ['role:hr|admin']], function() {
    #ONBOARD REQUEST
    Route::get('/Onboard','OnboardController@create');
    Route::post('/Onboard','OnboardController@store');
    #UNTUK HR CHECKLIST
    Route::get('/Review/{onboardId}','OnboardController@reviewer');
    Route::post('/Review','OnboardController@createstore');
    #LIST EMPLOYEE
    Route::get('/Employee','Master\EmployeeController@index');
    Route::get('/Employee/{employeeid}','Master\EmployeeController@show');
    Route::post('/Employee','Master\EmployeeController@store');

});
#ROUTE UNTUK EXIT REQUEST
Route::group(['middleware' => ['role:itadmin|itinfra|itapps|hr|admin']], function() {
    Route::get('/HRExit', 'HRExitController@index'); #INDEX EXIT
    Route::get('/HRExit/{onboard_id}', 'HRExitController@hrexit'); #VIEW EXIT
    Route::post('/HRExit', 'HRExitController@store'); #STORE FORM EXIT
    Route::post('/ITAdm/Exit', ['as'=>'ITAdm/Exit','uses'=>'HRExitController@itstore']); #IT ADMIN FORM EXIT
    Route::post('/ITInfra/Exit', ['as'=>'ITInfra/Exit','uses'=>'HRExitController@itstore']); #IT INFRA FORM EXIT
    Route::post('/ITApps/Exit', ['as'=>'ITApps/Exit','uses'=>'HRExitController@itstore']); #IT APPS FORM EXIT
});


Route::group(['middleware' => ['role:user|admin']], function() {
    #UNTUK USER MELAKUKAN CHECKLIST
    Route::get('/Users/{onboardId}','OnboardController@userview');
    Route::post('/Users','OnboardController@userstore');

});

Route::resource('ListOnBoard','ListboardController');
Route::get('/ListOnBoard','ListboardController@index');

Route::resource('Division','Master\DivisionController');
Route::get('/ListOnBoard/divisions', ['as'=>'listonboard.divisions','uses'=>'ListboardController@show']);