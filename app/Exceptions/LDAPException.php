<?php

namespace App\Exceptions;

use Exception;

/* 
 * Class for an exception to the LDAP connection
 */

class LDAPException extends Exception {
    const LDAP_CONNECTION_ERROR = 1;
    const LDAP_WRONG_AUTH_USER_PASS = 2;
    
    public function __construct()
    {
        parent::__construct();
    }
}