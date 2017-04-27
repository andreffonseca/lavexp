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

// --- Use of env.conf.php from Cardoso? ----------------------
// define('APP_CONFIG_DIR', dirname(__FILE__));
// define('APP_ROOT_DIR', realpath(APP_CONFIG_DIR.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR));
// define('APP_INCLUDE_DIR', APP_ROOT_DIR.DIRECTORY_SEPARATOR.'include');
// define('APP_BIN_DIR', APP_ROOT_DIR.DIRECTORY_SEPARATOR.'bin');
// --- Error Reporting ----------------------------------------
// not sure if I can declare the error reporting here!
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

function app_error_handler($errno, $errmsg, $errfile, $errline) {
  //if (ini_get('error_reporting')) throw new ErrorException($errmsg, 0, $errno, $errfile, $errline);
  throw new ErrorException("$errno: $errmsg", 0, $errno, $errfile, $errline);
}
set_error_handler("app_error_handler", (E_NOTICE | E_WARNING | E_ERROR));
// --- End of Error Reporting ----------------------------------------

// Route to get to the main page (login?)
Route::get('/', function () {
    return view('welcome');
});

// UserController = controller that handles User Management
// Routes for showing login page if not logged in, otherwise send to welcome main page
Route::get('/login', 'UserController@showLogin');
// POST processes the login from /loginpage
Route::post('/login', 'UserController@doLogin');
// Route for obtaining info of current user (by current session)
Route::get('/apiuserinfo', 'UserController@getUserInfo');
Route::post('/apiuserinfo', 'UserController@getUserInfo');
// Route for trying to authenticate existent user by LDAP
Route::get('/apilogin', 'UserController@loginUser');
Route::post('/apilogin', 'UserController@loginUser');
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
