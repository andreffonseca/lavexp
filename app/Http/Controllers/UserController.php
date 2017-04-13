<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller {
    const LDAP_VERSION_1 = 1;
    const LDAP_VERSION_2 = 2;
    const LDAP_VERSION_3 = 3;

    private $username;
    private $password;
    private $server;
    private $connection;
    private $bind;
    public $baseDN;
    
    function __construct($params = array()) {
        parent::__construct();
        //loadLib("org.programming.tolls.debuglib");
        if (isset($params["username"])) {
            $this->setUsername($params["username"]);
        }
        if (isset($params["password"])) {
            $this->setPassword($params["password"]);
        }
        if (isset($params["server"])) {
            $this->setServer($params["server"]);
        }
    }
    
    public function index() {
        
    }
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
        $ldap = new UserController($params);
        $ldap->baseDN = "OU=Users,OU=REDOUTE PT,OU=RED Branches,DC=siege,DC=red";
        $ldap->authenticate();
        var_dump("connect/bind result is " . $ds . "<br />");
        // Connect to LDAP server, must be a valid LDAP server!
        $ds = ldap_connect("ldap.siege.red");
        $user_data = $ldap->loadUserInfo($params["username"]);
        var_dump("loadUserInfo result is " . $user_data . "<br />");
        // Close Connection to LDAP server when no longer needed
        $ldap->close();
        /*
        if ($ds) {
            $ub = ldap_bind($ds, "itxxx@siege.red", 'xxx');
            var_dump("bind result is " . $ub . "<br />");
        } else {
            //var_dump("<h4>Unable to connect to LDAP server</h4>");
            $data = [ 'errno' => '401', 'msg' => 'Unable to connect to LDAP server' ];
            header('Content-type: application/json');
            echo json_encode( $data );
        }*/
        die();
    }
    
    public function logoutUser(Request $request) {
        $data = [ 'errno' => '401', 'msg' => 'Unauthorized' ];
        header('Content-type: application/json');
        echo json_encode( $data );
    }
    /**
     * Athenticate user in the DC
    */
    private function authenticate() {
        try {
             $conn = $this->connect();
             $bind = $this->bind();
             //$this->close();
        } catch (LDAPException $e) {
             echo $e->getCode();
        }
    }
    private function connect() {
        $this->connection = @ldap_connect($this->server);
        if(!$this->connection) {
            throw new LDAPException("Error Connection do LDAP Server " . $this->server, LDAPException::LDAP_CONNECTION_ERROR);
        }

        ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, LDAPLib::LDAP_VERSION_3);
        ldap_set_option($this->connection, LDAP_OPT_REFERRALS, 0);
    }
    /**
     * Bind do Domain Controller
     * @throws LDAPException
    */
    private function bind() {
        $this->bind = @ldap_bind($this->connection, $this->username, $this->password);
        if(!$this->bind) {
            throw new LDAPException('Error authenticating', LDAPException::LDAP_WRONG_AUTH_USER_PASS);
        }
    }
    private function close() {
        @ldap_close($this->connection);
    }
    private function loadUserInfo($samAccName) {
        $searchFilter = "(&(samaccountname=" . $samAccName . "))";
        $result = ldap_search($this->connection, $this->baseDN, $searchFilter);
        return ldap_get_entries($this->connection, $result);
    }
    /**
     * username
     * @param string $username
     * @return LDAP
     */
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    /**
     * password
     * @param string $password
     * @return LDAP
     */
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }
    /**
     * server
     * @param string $server
     * @return LDAP
     */
    public function setServer($server){
        $this->server = $server;
        return $this;
    }
}
