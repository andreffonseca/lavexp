<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserLDAP {
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
    
    public function index() {}
    
    /**
     * Athenticate user in the DC
    */
    public function authenticate() {
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
    public function close() {
        @ldap_close($this->connection);
    }
    public function loadUserInfo($samAccName) {
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