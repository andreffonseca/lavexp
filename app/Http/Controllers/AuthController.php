<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    function __construct() {}
    
    public function index() {}
    
    public function getUserInfo(Request $request) {
        $data = [ 'errno' => '401', 'msg' => 'Unauthorized' ];
        header('Content-type: application/json');
        echo json_encode( $data );
    }
    
    public function loginUser(Request $request) {
        // Connect to LDAP server, must be a valid LDAP server!
        $ds=ldap_connect("ldap.siege.red");
        var_dump("connect result is " . $ds . "<br />");
        //dd($ds);
        if ($ds) {
            
        } else {
            var_dump("<h4>Unable to connect to LDAP server</h4>");
        }
        die();
        /*$data = [ 'errno' => '401', 'msg' => 'Unauthorized' ];
        header('Content-type: application/json');
        echo json_encode( $data );*/
    }
    
    public function logoutUser(Request $request) {
        $data = [ 'errno' => '401', 'msg' => 'Unauthorized' ];
        header('Content-type: application/json');
        echo json_encode( $data );
    }
}