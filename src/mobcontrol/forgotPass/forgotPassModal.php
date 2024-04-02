<?php

namespace Packages\MobControl;

use Core\MClass\Mob;
use Database\MySQL\MySQL;
use Packages\MobControl\languages;

$mob = new Mob;

class forgotPass extends MySQL {

    private $mob;
    private $lang;

    function __construct(){
        parent::__construct();
        $this->mob = new Mob;
        $this->lang = new languages;
    }

    public function verify($sql){

        $result = $this->query($sql);

        if (count(json_decode($result,true))){
            return $result;
        } else {
            return false;
        }

    }

    public function sendMail($data){

        // Obtém a data e hora atual
        $today = new \DateTime;
    
        // Adiciona um dia
        $tomorrow = clone $today; // Cria uma cópia da data atual
        $tomorrow->modify('+1 day');
    
        $recoverPass = $this->mob->createPass(20,false,true,true,false);
        $recoverValidade = $tomorrow->format('Y-m-d H:i:s');
        $id = $data['ID'];
    
        // Atualizar um registro

        $dataToUpdate = ['RECOVER_PASS' =>  $recoverPass, 'RECOVER_VALIDATE' => $recoverValidade];
        $resultUpdate = $this->update('mb_user_account', $dataToUpdate, ['SEQ_ID' => $id]);

        $to = $data['EMAIL'];
        $subject = $this->lang->forgotPass['titleMail'];
        $path = ROOT."/templates/Email/forgot_pass.php";
        $url = APP['app_url']."access/new-pass?key=$recoverPass";

        if(file_exists($path)){
            $body = file_get_contents($path);
            $body = str_replace('[url]',$url,$body);
            $this->mob->sendMail($to, $subject, $body);
        }

        $result = json_decode($resultUpdate,true);

        if (isset($result['success'])){
            $message = $this->lang->forgotPass['sendEmail'] . " <strong>$to</strong>.";
            echo json_encode(["success" => $message], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => $this->lang->forgotPass['errorSendEmail']], JSON_UNESCAPED_UNICODE);
        };
    }
    

}