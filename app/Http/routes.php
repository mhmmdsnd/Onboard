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

Route::get('/ListOnBoard/usermail', 'Onboard\ListboardController@usermail');

Route::group(['middleware' => ['role:itadmin|admin']], function() {    #ITADMIN
    Route::get('/ITAdm/{onboardId}',['as'=>'ITAdm','uses'=>'Onboard\OnboardController@itdetail']);
    Route::post('/ITAdm', ['as'=>'ITAdm','uses'=>'Onboard\OnboardController@itstore']);
});

Route::group(['middleware' => ['role:itinfra|admin']], function() {  #ITINFRA
    Route::get('/ITInfra/{onboardId}',['as'=>'ITInfra','uses'=>'Onboard\OnboardController@itdetail']);
    Route::post('/ITInfra', ['as'=>'ITInfra','uses'=>'Onboard\OnboardController@itstore']);
});

Route::group(['middleware' => ['role:itapps|admin']], function() {  #ITAPPS
    Route::get('/ITApps/{onboardId}',['as'=>'ITApps','uses'=>'Onboard\OnboardController@itdetail']);
    Route::post('/ITApps', ['as'=>'ITApps','uses'=>'Onboard\OnboardController@itstore']);
});

Route::group(['middleware' => ['role:hr|admin|hr-rct|management']], function() {
    #ONBOARD REQUEST
    Route::get('/onboard',['as'=>'onboard','uses'=>'Onboard\OnboardController@create']);
    Route::get('/onboard/{request_id}',['as'=>'onboard','uses'=>'Onboard\OnboardController@detail']);
    Route::post('/onboard',['as'=>'onboard','uses'=>'Onboard\OnboardController@store']);
    Route::post('/hrdetail',['as'=>'hrdetail','uses'=>'Onboard\OnboardController@update']);
    #UNTUK HR CHECKLIST
    Route::get('/review/{onboardId}','Onboard\HRGAController@reviewer');
    Route::post('/review','Onboard\HRGAController@createstore');
    #LIST EMPLOYEE
    Route::get('employee/data-employee','Master\EmployeeController@dataEmployee');
    Route::resource('/employee','Master\EmployeeController');
});
#ROUTE UNTUK EXIT REQUEST
Route::group(['middleware' => ['role:itadmin|itinfra|itapps|hr|admin|ga']], function() {
    Route::get('/hrexit', 'Onboard\HRExitController@index'); #INDEX EXIT
    Route::get('/hrexit/{onboard_id}', 'Onboard\HRExitController@hrexit'); #VIEW EXIT
    Route::post('/hrexit', 'Onboard\HRExitController@store'); #STORE FORM EXIT
    Route::post('/ITAdm/exit', ['as'=>'ITAdm/exit','uses'=>'Onboard\HRExitController@itstore']); #IT ADMIN EXIT
    Route::post('/ITInfra/exit', ['as'=>'ITInfra/exit','uses'=>'Onboard\HRExitController@itstore']); #IT INFRA EXIT
    Route::post('/ITApps/exit', ['as'=>'ITApps/exit','uses'=>'Onboard\HRExitController@itstore']); #IT APPS EXIT
    Route::post('/hr-detail/exit', ['as'=>'hr-detail/exit','uses'=>'Onboard\HRExitController@itstore']); #HR DETAIL EXIT
    Route::post('/ga-detail/exit', ['as'=>'ga-detail/exit','uses'=>'Onboard\HRExitController@itstore']); #GA DETAIL EXIT
});
Route::group(['middleware' => ['role:hr|admin|ga']], function (){
    #GA DETAIL (ROLE : GA)
    Route::get('/ga-detail/{request_id}',['as'=>'ga-detail','uses'=>'Onboard\OnboardController@itdetail']);
    Route::post('/ga-detail/',['as'=>'ga-detail','uses'=>'Onboard\OnboardController@itstore']);
    #HR DETAIL (ROLE : HR)
    Route::get('/hr-detail/{request_id}',['as'=>'hr-detail','uses'=>'Onboard\OnboardController@itdetail']);
    Route::post('/hr-detail/',['as'=>'hr-detail','uses'=>'Onboard\OnboardController@itstore']);
});

Route::group(['middleware' => ['role:user|admin|management|hrcomb']], function() {
    #UNTUK USER MELAKUKAN CHECKLIST
    Route::get('/users/{onboardId}','Onboard\HRGAController@userview');
    Route::post('/users','Onboard\HRGAController@userstore');
});

#ROUTE FOR ALL USERS
Route::group(['middleware'=>['role:admin']], function (){
    Route::resource('manage-role','Admin\ManageController');
    Route::resource('company','Master\CompanyController');
    Route::resource('holding','Master\HoldingController');
    Route::resource('Division','Master\DivisionController');
    Route::get('/slareport/',['as'=>'slareport','uses'=>'Onboard\ListboardController@slareport']);
    Route::post('/slareport/',['as'=>'slareport','uses'=>'Onboard\ListboardController@generateonboard']);
});

Route::group(['middleware'=>'auth'], function (){
    Route::get('/ListOnBoard','Onboard\ListboardController@index');
    Route::get('/ListOnBoard/divisions', ['as'=>'listonboard/divisions','uses'=>'Onboard\ListboardController@show']);
    Route::get('/ListOnBoard/company', ['as'=>'listonboard/company','uses'=>'Onboard\ListboardController@showcompany']);
    Route::get('/ListOnBoard/excel', ['as'=>'listonboard/excel','uses'=>'Onboard\ListboardController@exportexcel']);
});

#ROUTE FOR ROLE_USER
