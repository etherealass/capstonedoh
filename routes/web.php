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
Route::group(['middleware' =>'guest'], function()
{
	Route::any('/', [
	'uses' => 'LoginController@home', 
	'as' => 'login'
]);

Route::view('/register','register');

Route::post('/loginnow', "LoginController@loginnow");

Route::view('/login', "login");

  
});

Route::get('/logout', "LoginController@logout");



Route::group(['middleware' =>'auth'], function()
{
	 Route::get('/profile', [
      	'uses'=>'LoginController@getProfile',
      	'as'=> 'user.dashboard'
    ]);

	 Route::get('showUsers/{id}', [
      	'uses'=>'ViewController@getUsers',
      	'as'=> 'showUsers'
    ]);

	  Route::get('showDeps/{id}', [
      	'uses'=>'ViewController@getDeps',
      	'as'=> 'showDeps'
    ]);

    Route::get('/showCalendar', [
      	'uses'=>'CalendarController@showCalen',
      	'as'=> 'showCalendar'
    ]);

	 Route::get('/getEvent', ['as'=>'getEvent',
    'uses'=>'CalendarController@get_Events'

	]);

	Route::get('/getDeps1', ['as'=>'getDeps1',
    'uses'=>'CalendarController@get_Deps1'

	]);
	Route::get('/getDeps2', ['as'=>'getDeps2',
    'uses'=>'CalendarController@get_Deps2'

	]);  
	Route::get('/getDeps3', ['as'=>'getDeps3',
    'uses'=>'CalendarController@get_Deps3'

	]);
	Route::get('/getcountDeps1', ['as'=>'getcountDeps1',
    'uses'=>'CalendarController@getcount_Deps1'

	]);
	Route::get('/getcountDeps2', ['as'=>'getcountDeps2',
    'uses'=>'CalendarController@getcount_Deps2'

	]);  
	Route::get('/getcountDeps3', ['as'=>'getcountDeps3',
    'uses'=>'CalendarController@getcount_Deps3'

	]); 


	 Route::any('/create_event/{date}', "CalendarController@create_event");

	 Route::any('/add_event', "CalendarController@add_event");

	 Route::get('/view_event/{id}', "CalendarController@viewevent");

	 Route::get('/cancel_event/{id}', "CalendarController@updateEvent");

	 Route::get('/bar', 'CalendarController@chart');





	 Route::post('/update_employeenow',"EmployeeController@update_employeenow");

	 Route::post('/delete_employee', "EmployeeController@delete_employeenow");




	 Route::delete('/delete/patient/{id}', "EventController@delete_patient_event");

	 Route::any('/view/addpatient', "EventController@view_add_patient");

	 Route::get('/view/vieweventattended', "EventController@view_event_attended");
	 
	 Route::post('/patient/attendIntervention', "EventController@patient_attend_intervention");

	Route::post('/event_save_edit', "EventController@event_save_edit");




	  Route::any('/add_intervention', "InterventionController@addintervention");

	 Route::any('/showIntervention', "InterventionController@showintervention");
	 
	 Route::any('/create_intervention', "InterventionController@create_intervention");

	 Route::any('/viewIntervention/{id}', "InterventionController@viewIntervention");

	 Route::any('/patient/intervention', "InterventionController@patientInterven");





	 Route::get('/markAsRead', "NotificationsController@markAsRead");




	 Route::any('/add_a_city',"OthersController@add_a_city");

	 Route::post('/add_city',"OthersController@addcity");

	 Route::post('/delete_city',"OthersController@deletecity");

	 Route::any('/add_a_casetype',"OthersController@add_a_casetype");

	 Route::post('/add_casetype',"OthersController@add_casetype");

	 Route::post('/delete_case',"OthersController@delete_case");

	 Route::any('/add_a_reason',"OthersController@add_a_reason");

	 Route::post('/add_reason',"OthersController@add_reason");

	 Route::post('/delete_reason',"OthersController@deletereason");





	 Route::any('/addpatient', "PatientController@addpatient");

	 Route::post('/refer', "PatientController@refer");

	 Route::any('/showpatients/{stat}', "PatientController@showpatient");

	 Route::get('/viewpatient/{id}', "PatientController@viewpatient");

	 Route::get('/viewpatients/{id}/{pid}/{tid}', "PatientController@viewpatients");

	 Route::get('/viewpatientx/{id}/{pid}/{gid}', "PatientController@viewpatientx");

	 Route::get('/viewpatientz/{id}/{nid}', "PatientController@viewpatientz");

	 Route::any('/patient_dep', "PatientController@patientdep");

	 Route::get('/choosef/{id}', "PatientController@chooseform");

	 Route::get('/intakeform/{id}', "PatientController@intakeform");

	 Route::get('/ddeform/{id}', "PatientController@ddeform");

	 Route::post('/patientsave_intake', "PatientController@save_intake");

	 Route::post('/patientsave_dde', "PatientController@save_dde");

	 Route::post('/deletepatient', "PatientController@flagdelete");

	 Route::post('/patientTransfer', "PatientController@transferPatient");

	 Route::get('/transfer_patient_now/{id}/{did}/{tid}/{pid}',"PatientController@patientTransfer");

	 Route::post('/patientDismiss',"PatientController@dismiss_patient");

	 Route::post('/graduate_patient',"PatientController@graduate_patient");

	 Route::post('/graduateadmin_patient',"PatientController@graduateadmin_patient");

	 Route::get('/graduate_patient_now/{id}/{did}/{gid}/{pid}',"PatientController@patientGraduate");

	 Route::get('/declinet_patient_now/{id}/{did}/{gid}/{pid}',"PatientController@declineGraduate");

	 Route::post('/reenroll_patient',"PatientController@reenroll_patient");

	 Route::post('/add_notes',"PatientController@doctor_notes");
	 




	 Route::post('/refers', "ReferController@createRefer");

	Route::get('/refers/{id}', "ReferController@getRefer");

	Route::put('/refers/{id?}', "ReferController@putRefer"); 





	 Route::post('/register_role', "RegisterController@register_role");

	 Route::post('/register_dep', "RegisterController@register_dep");

	 Route::post('/registernow', "RegisterController@registernow");

	 Route::any('/newemployee',"RegisterController@newemployee");

	 Route::post('/create_employee',"RegisterController@create_employee");




	  Route::get('/create_service', "ServiceController@create_service");

	 Route::any('/show_services', "ServiceController@show_services");

	 Route::post('/add_service', "ServiceController@add_service");





	 Route::any('/chooseuser', "UserController@chooseuser_role");

	 Route::any('/createuserrole', "UserController@createuserrole");

	 Route::get('/create_user/{id}', "UserController@create_user");

	 Route::any('/create_dep', "UserController@postcreate_dep");

	 Route::any('/create_depnow', "UserController@create_depnow");

	 Route::post('/deletenow', "UserController@deletenow");

	 Route::post('/updatenow', "UserController@updatenow");

	 Route::post('/deleteuser', "UserController@deleteuser");





	 Route::get('/showdep_users/{did}/{rid}', "ViewController@showdepuser");

	 Route::any('/showemployees',"ViewController@showemployees");

	 Route::any('/logs', "ViewController@showlogs");

	 Route::any('/show_case_types', "ViewController@show_case_types");

	 Route::any('/show_cities', "ViewController@show_cities");

	 Route::any('/show_jails', "ViewController@show_jails");

	 Route::any('/show_dismiss_reason', "ViewController@show_dismiss_reason");

	 Route::any('/sampleform/{id}',"ViewController@sampleform");

	 Route::any('/samplecsv',"ViewController@samplecsv");




	 
});