<?php

use Core\MClass\Mob;
use Packages\MobControl\languages;
use Packages\MobControl\Login;

$login = new Login;
$mob = new Mob;
$lang = new languages;

if (isset ($_POST['LOGIN'])) {

    $array = json_decode($login->login($_POST['LOGIN'], $_POST['PASSWORD']), true);

    $array = $array[0];

    if ($array['CONTADOR'] == 0) {
        $status = 0;
        $message = $lang->login['error_user'];
        $string = ["status" => $status, "message" => $message];
    } else {

        if ($array['STATUS'] > 0) {
            $status = 0;
            $message = $lang->login['blocked_user'];
            $string = ["status" => $status, "message" => $message];
        } else {
            $hash = $array['PASSWORD'];
            if ($mob->verifyHash($_POST['PASSWORD'], $hash)) {
                $string = $array;
            } else {
                $status = 0;
                $message = $lang->login['error_user'];
                $string = ["status" => $status, "message" => $message];
            }
        }

    }

    echo json_encode($string, JSON_UNESCAPED_UNICODE);

}