<?php

namespace Packages\MobControl;

use Database\MySQL\MySQL;
use Packages\MobControl\languages;

class Login extends languages {

    private $sqli;

    function __construct(){
        $this->sqli = new MySQL;
    }

    public function login($user, $pass){

        $code = "SELECT COUNT(*) 'CONTADOR', u.NAME, u.USERNAME, u.`STATUS`, u.`PASSWORD` FROM mb_user_account u WHERE u.SURNAME LIKE '$user' OR u.USERNAME LIKE '$user'";

        $result = $this->sqli->query($code);

        $array = json_decode($result,true);

        $array = $array[0];

        if($array['STATUS'] == 0){
            $_SESSION['STATE_USER'] = $array;
        }

        return $result;

    }

}

