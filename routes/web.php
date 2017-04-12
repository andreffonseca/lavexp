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

Route::get('/', function () {
    return view('welcome');
});

// create our route, return a view file (app/views/viewdata.blade.php)
// we will also send the records we want to the view
/*Route::get('/viewdata', function() {
    return View::make('viewdata')
        // all the bears (will also return the fish, trees, and picnics that belong to them)
        ->with('itsqd_mon_messages', MonitorMessages::all());//->with('trees', 'picnics'));
});*/

Route::get('itsqd', 'MonitorController@message2');

/* http://localhost/itsqd/v1/nmessage?id=1&plr=POLLER-PMS-MMK&t=Wed Apr 12 00:52:32 CEST 2017&tp=PROBLEM&s=WARNING&srv=MMK0060 - DB_Oracle_PSEM_AlertLog&h=RACPRD05&ip=RACPRD05.siege.red&g=0_DB_RAC_ORACLE_PROD&ot=WARNING: ALERTLOG. there are logs with errors. SBPSEM2_ORA-01555=( WARNING )&th=http%3A%2F%2F172.25.66.75%2Fthruk%2F%23cgi-bin%2Fextinfo.cgi%3Ftype%3D2%26host%3DRACPRD05%26service%3DDB_Oracle_PSEM_AlertLog&sc=http%3A%2F%2Fsitd_moss%2Fitsqd%2FWeb_part_page%2FHost_id.aspx%3Fhostname%3DRACPRD05%26alertid%3DMMK0060*/

/*Route::get('itsqd/v1/nmessage','MonitorController@message');*/
Route::post('itsqd/v1/nmessage', 'MonitorController@message');
