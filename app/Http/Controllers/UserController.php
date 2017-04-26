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
        // verify if user is logged in from session variables
        if (!isset($_SESSION['username'])) {
            $data = [ 'status' => '401', 'msg' => 'Unauthorized' ];
            header('Content-type: application/json');
            echo json_encode( $data );
            // $url = BASE_URL . 'index.php'; // Define the URL.
            // ob_end_clean(); // Delete the buffer.
            // header("Location: ./login.php");
            // exit(); // Quit the script.
        } else {
            $data = [ 'status' => '200', 'msg' => 'OK', 'username' => $_SESSION['username'], 'name' => $_SESSION['name'] ];
            header('Content-type: application/json');
            echo json_encode( $data );
        }
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
        
        // Do not allow it users to login with itxxx user, only with ADM user
        /*if(strlen($params["username"])<4 || substr($params["username"], 0, 4) !== "adm-") {
            $data = [ 'status' => '401', 'msg' => 'Bad credentials, you should authenticate with ADM user.' ];
            header('Content-type: application/json');
            return json_encode( $data );
        }*/
        
        // Connect to LDAP server, must be a valid LDAP server!
        $ldap_connect = ldap_connect("ldap.siege.red");
        if ($ldap_connect) {
            // can bind with redoute_france\adm-xxx@siege.red or adm-xxx@siege.red
            // can bind with redoute_france\itxxx@siege.red or itxxx@siege.red
            // need to add the domain to apply, no need for user to say it explicitly
            // @ldap_bind suppresses error message, for some resason I could not catch the exception on it
            ldap_set_option($ldap_connect, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap_connect, LDAP_OPT_REFERRALS, 0);
            $ldap_bind = @ldap_bind($ldap_connect, $params["username"]."@siege.red", $params["password"]);
            if($ldap_bind) {
                $searchFilter = "(&(samaccountname=" . $params["username"] . "))";
                $result = ldap_search($ldap_connect, "DC=siege,DC=red", $searchFilter);
                $user_data = ldap_get_entries($ldap_connect, $result);
                ldap_close($ldap_connect);
                $first_name = $user_data[0]['givenname'][0];
                // from givenname remove ADM part if exists
                if(strlen($first_name)>4 && strcasecmp(substr($first_name, 0, 4), "ADM ") == 0) {
                    $first_name = substr($first_name, 4);
                }
                $last_name = $user_data[0]['sn'][0];
                // the user main id, normally his email
                $user_id = $user_data[0]['userprincipalname'][0];
                // $user_data[0]['displayname'][0] returns complete name, may have ADM in it
                $_SESSION['username'] = $user_id;
                $_SESSION['name'] = $first_name . ' ' . $last_name;
                $data = [ 'status' => '200', 'msg' => 'OK', 'username' => $_SESSION['username'], 'name' => $_SESSION['name'] ];
                header('Content-type: application/json');
                return json_encode( $data );
            } else {
                ldap_close($ldap_connect);
                $data = [ 'status' => '401', 'msg' => 'Bad credentials.' ];
                header('Content-type: application/json');
                return json_encode( $data );
            }
        } else {
            $data = [ 'status' => '401', 'msg' => 'Unable to connect to LDAP server' ];
            header('Content-type: application/json');
            return json_encode( $data );
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
        // remove session variables that indicate user is logged
        unset($_SESSION['username']);
        unset($_SESSION['name']);
        $_SESSION = array(); // Destroy the variables.
        session_destroy(); // Destroy the session itself.
        setcookie (session_name(), '', time()-300); // Destroy the cookie.
        // update user as logged out in database (table of logged users)
        $data = [ 'status' => '401', 'msg' => 'Unauthorized' ];
        header('Content-type: application/json');
        echo json_encode( $data );
    }
}