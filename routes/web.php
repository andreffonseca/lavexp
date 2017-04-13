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

// Route to get to the main page (login?)
Route::get('/', function () {
    return view('welcome');
});

// UserController = controller that handles User Management
// Route for obtaining info of current user (by current session)
Route::get('/userinfo', 'UserController@getUserInfo');
Route::post('/userinfo', 'UserController@getUserInfo');
// Route for trying to authenticate existent user by LDAP
Route::get('/login', 'UserController@loginUser');
Route::post('/login', 'UserController@loginUser');
// Route for trying to logout existent user (on portal, no need for LDAP)
Route::get('/logout', 'UserController@logoutUser');
Route::post('/logout', 'UserController@logoutUser');

// MonitorController = controller that handles Alerts
// Route to deal with call to page that show list of alerts
Route::get('itsqd', 'MonitorController@listAlerts');
// Example for a GET call to webservice to add new alert
// http://localhost/itsqd/v1/nmessage?id=1&plr=POLLER-PMS-MMK&t=Wed Apr 12 00:52:32 CEST 2017&tp=PROBLEM&s=WARNING&srv=MMK0060 - DB_Oracle_PSEM_AlertLog&h=RACPRD05&ip=RACPRD05.siege.red&g=0_DB_RAC_ORACLE_PROD&ot=WARNING: ALERTLOG. there are logs with errors. SBPSEM2_ORA-01555=( WARNING )&th=http%3A%2F%2F172.25.66.75%2Fthruk%2F%23cgi-bin%2Fextinfo.cgi%3Ftype%3D2%26host%3DRACPRD05%26service%3DDB_Oracle_PSEM_AlertLog&sc=http%3A%2F%2Fsitd_moss%2Fitsqd%2FWeb_part_page%2FHost_id.aspx%3Fhostname%3DRACPRD05%26alertid%3DMMK0060
// Example for a POST call from linux curl to webservice to add new alert
// curl -H "Content-Type: application/json" -X POST -d '{"id":"9","poller":"MMK %#%#"}' http://172.16.9.169/index.php/itsqd/v1/nmessage
// Route to Webservice to add new alert by GET
Route::get('itsqd/v1/nmessage','MonitorController@message');
// Route to Webservice to add new alert by POST
Route::post('itsqd/v1/nmessage', 'MonitorController@message');
