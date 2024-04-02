<?php

namespace Packages\MobControl;

use Core\MClass\Mob;
use Database\MySQL\MySQL;
use Packages\MobControl\languages;

class newPass extends MySQL
{

    private $lang;

    private $mob;

    function __construct()
    {
        parent::__construct();
        $this->lang = new languages;
        $this->mob = new Mob;
    }

    public function verify()
    {

        $e = explode('key=', $_SERVER['HTTP_REFERER']);

        if (isset($e[1])) {

            $recoverPass = $e[1];

            $code = "SELECT a.NAME, COUNT(*) 'ROW' 
            FROM mb_user_account a 
            WHERE a.RECOVER_PASS = '$recoverPass'
            AND a.RECOVER_VALIDATE >= NOW()";

            $array = json_decode($this->query($code), true);
            $count = @$array[0]['ROW'];

            if ($count > 0) {

            } else {
                echo '<meta http-equiv="refresh" content="0; /access/recovery-error">';
            }

        } else {

            //header("Location: /access/recovery-error");
            echo '<meta http-equiv="refresh" content="0; /access/recovery-error">';
            exit;

        }

    }

    public function updatePass($array)
    {

        $key = $array['key'];
        $pas = $this->mob->createHash($array['newPass']);

        $data = [
            'PASSWORD' => $pas,
            'RECOVER_PASS' => NULL,
            'RECOVER_VALIDATE' => NULL
        ];

        $conditions = [
            'RECOVER_PASS' => $key
        ];

        $var = json_decode($this->query("SELECT a.NAME, a.EMAIL FROM mb_user_account a WHERE a.RECOVER_PASS = ?", [$key]), true);

        if (isset($var[0])) {
            $this->sendMail($var[0]['NAME'], $var[0]['EMAIL']);
            $var = json_decode($this->update('mb_user_account', $data, $conditions), true);
            if ($var['success']) {
                return json_encode(['success', $this->lang->newPass['success']], JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(['error', $this->lang->newPass['erro0']], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return json_encode(['error', $this->lang->newPass['erro0']], JSON_UNESCAPED_UNICODE);
        }

    }

    public function sendMail($user, $email)
    {

        $to = $email;
        $subject = $this->lang->newPass['titleMail'];
        $path = ROOT . "/templates/Email/change_password.php";

        if (file_exists($path)) {

            $logo = APP['app_url'] . "/public/assets/Images/logo-mobi-2.png";

            $body = file_get_contents($path);
            $body = str_replace('[user]', $user, $body);
            $body = str_replace('[logo]', $logo, $body);
            $body = str_replace('[app]', APP['app_name'], $body);
            $body = str_replace('[mailto]', APP['support_mail'], $body);
            $body = str_replace('[team]', APP['app_company'], $body);

            $this->mob->sendMail($to, $subject, $body);
        }

    }

}

