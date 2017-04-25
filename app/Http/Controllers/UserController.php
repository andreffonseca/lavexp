<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller {
    function __construct() {}
    
    public function index() {}
    
    /*
     * Function to obtain information if current user is logged in or not
     * @param user Username for domain of LDAP
     */
    public function getUserInfo(Request $request) {
        $data = [ 'errno' => '401', 'msg' => 'Unauthorized' ];
        header('Content-type: application/json');
        echo json_encode( $data );
    }
    
    /*
     * Function to obtain information if current user is logged in or not, can come from POST or GET
     * http://localhost/index.php/login?user=itxxx&pass=xxx
     * @param user Username for domain of LDAP
     * @param pass Password for domain of LDAP
     */
    
    public function loginUser(Request $request) {
        // LDAP server can also be 'DCPT02VPW.siege.red'
        $params = array("username" => 'redoute_france\itxxx', 'password' => 'xxx', 'server' => 'ldap.siege.red');
        if ($request->input('user') != null) {
            $params["username"] = $request->input('user');
        }
        if ($request->input('pass') != null) {
            $params["password"] = $request->input('pass');
        }
        
        // Connect to LDAP server, must be a valid LDAP server!
        $ds = ldap_connect("ldap.siege.red");
        var_dump("connect result is " . $ds . "<br />");
        if ($ds) {
            // need to add the domain to apply, no need for user to say it explicitly
            //$ub = ldap_bind($ds, $params["username"]."@siege.red", $params["password"]);
            // could not bind itxxx@siege.red, but could bind adm-xxx@siege.red
            // can bind redoute_france\itxxx ???
            $ub = ldap_bind($ds, $params["username"], $params["password"]);
            var_dump("bind result is " . $ub . "<br />");
        } else {
            //var_dump("<h4>Unable to connect to LDAP server</h4>");
            $data = [ 'errno' => '401', 'msg' => 'Unable to connect to LDAP server' ];
            header('Content-type: application/json');
            echo json_encode( $data );
        }
        
        // using class from -> Andre Fonseca
        // problem using LDAPException - not explicit what error was
        // after bypassing LDAPException, it seems bind not made correctly, does not return bind result either with good or bad credentials
        /*
        $ldap = new UserLDAP($params);
        $ldap->baseDN = "OU=Users,OU=REDOUTE PT,OU=RED Branches,DC=siege,DC=red";
        //try {
            $ldap->authenticate();
            var_dump("connect/bind result is " . $ldap->connection . "<br />");
            var_dump("bind result is " . $ldap->bind . "<br />");
            $user_data = $ldap->loadUserInfo($params["username"]);
            var_dump("loadUserInfo result is " . $user_data . "<br />");
        //} catch (LDAPException $e) {
        //     echo $e->getMessage();
        //}
        // Close Connection to LDAP server when no longer needed (Only if connection is not false)
        if(!$$ldap->connection) {
        } else {
            $ldap->close();
        }
        //if user was correctly authenticated, return sucess json, otherwise failure json
        //if()
        //return view('welcome');
        */
        die();
    }
    
    public function logoutUser(Request $request) {
        $data = [ 'errno' => '401', 'msg' => 'Unauthorized' ];
        header('Content-type: application/json');
        echo json_encode( $data );
    }
}