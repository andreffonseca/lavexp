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
// http://192.168.1.1/index.php/itsqd/v1/nmessage?id=1&plr=POLLER-TEST&t=Wed Apr 12 00:52:32 CEST 2017&tp=PROBLEM&s=WARNING&srv=TST0060 - AlertName&h=MACHINENAME05&ip=MACHINENAME05.domain&g=AlertGroup&ot=WARNING: The ALERT Output.&th=http://192.168.1.1/MonitoringLink1&sc=http://192.168.1.1/MonitoringLink2
// Example for a POST call from linux curl to webservice to add new alert
// curl -H "Content-Type: application/json" -X POST -d '{"id":"9","poller":"TEST Poller"}' http://192.168.1.1/index.php/itsqd/v1/nmessage
// Route to Webservice to add new alert by GET
Route::get('itsqd/v1/nmessage','MonitorController@message');
// Route to Webservice to add new alert by POST
Route::post('itsqd/v1/nmessage', 'MonitorController@message');
