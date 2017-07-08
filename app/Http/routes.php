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
    Route::get('/ITAdm/{onboardId}',['as'=>'ITAdm','uses'=>'OnboardController@itadm']);
    Route::post('/ITAdm', ['as'=>'ITAdm','uses'=>'OnboardController@itstore']);
});

Route::group(['middleware' => ['role:itinfra|admin']], function() {  #ITINFRA
    Route::get('/ITInfra/{onboardId}','OnboardController@itinf');
    Route::post('/ITInfra', ['as'=>'ITInfra','uses'=>'OnboardController@itstore']);
});

Route::group(['middleware' => ['role:itapps|admin']], function() {  #ITAPPS
    Route::get('/ITApps/{onboardId}','OnboardController@itapp');
    Route::post('/ITApps', ['as'=>'ITApps','uses'=>'OnboardController@itstore']);
});

Route::group(['middleware' => ['role:hr|admin|hr-rct']], function() {
    #ONBOARD REQUEST
    Route::get('/onboard','OnboardController@create');
    Route::post('/onboard','OnboardController@store');
    #UNTUK HR CHECKLIST
    Route::get('/review/{onboardId}','OnboardController@reviewer');
    Route::post('/review','OnboardController@createstore');
    #LIST EMPLOYEE
    Route::get('/employee','Master\EmployeeController@index');
    Route::get('/employee/{employeeid}','Master\EmployeeController@show');
    Route::post('/employee','Master\EmployeeController@store');

});
#ROUTE UNTUK EXIT REQUEST
Route::group(['middleware' => ['role:itadmin|itinfra|itapps|hr|admin|ga']], function() {
    Route::get('/hrexit', 'HRExitController@index'); #INDEX EXIT
    Route::get('/hrexit/{onboard_id}', 'HRExitController@hrexit'); #VIEW EXIT
    Route::post('/hrexit', 'HRExitController@store'); #STORE FORM EXIT
    Route::post('/ITAdm/Exit', ['as'=>'ITAdm/Exit','uses'=>'HRExitController@itstore']); #IT ADMIN EXIT
    Route::post('/ITInfra/Exit', ['as'=>'ITInfra/Exit','uses'=>'HRExitController@itstore']); #IT INFRA EXIT
    Route::post('/ITApps/Exit', ['as'=>'ITApps/Exit','uses'=>'HRExitController@itstore']); #IT APPS EXIT
    Route::post('/hr-detail/exit', ['as'=>'hr-detail/exit','uses'=>'HRExitController@itstore']); #HR DETAIL EXIT
    Route::post('/ga-detail/exit', ['as'=>'ga-detail/exit','uses'=>'HRExitController@itstore']); #GA DETAIL EXIT
});


Route::group(['middleware' => ['role:user|admin']], function() {
    #UNTUK USER MELAKUKAN CHECKLIST
    Route::get('/users/{onboardId}','OnboardController@userview');
    Route::post('/users','OnboardController@userstore');

});

#Route::resource('ListOnBoard','ListboardController');
Route::get('/ListOnBoard','ListboardController@index');
#GA DETAIL (ROLE : GA)
Route::get('/ga-detail/{request_id}','Onboard\HRGAController@show');
Route::post('/ga-detail/',['as'=>'ga-detail','uses'=>'OnboardController@itstore']);
#HR DETAIL (ROLE : HR)
Route::get('/hr-detail/{request_id}','Onboard\HRGAController@hrshow');
Route::post('/hr-detail/',['as'=>'hr-detail','uses'=>'OnboardController@itstore']);

Route::resource('Division','Master\DivisionController');
Route::get('/slareport/',['as'=>'slareport','uses'=>'ListboardController@slareport']);
Route::post('/slareport/',['as'=>'slareport','uses'=>'ListboardController@generatesla']);
Route::get('/ListOnBoard/divisions', ['as'=>'listonboard/divisions','uses'=>'ListboardController@show']);
Route::get('/ListOnBoard/company', ['as'=>'listonboard/company','uses'=>'ListboardController@showcompany']);