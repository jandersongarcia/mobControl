<?php

    use Packages\MobControl\forgotPass;
    use Packages\MobControl\languages;
    

    $forgotPass = new forgotPass;

    $lang = new languages;

    $action = @$_GET['action'];

    /**
     * 
     * VERIFICA OS DADOS DE ENVIO PARA RECUPERAÇÃO DE SENHA
     * 
     */
    if($action == 'verify'){

        $array = @$_POST['nameUser'];

        if($array){

            $sql = "SELECT a.SEQ_ID 'ID', a.NAME, a.USERNAME, a.`STATUS`, a.EMAIL FROM mb_user_account a WHERE a.EMAIL LIKE '$array' OR a.USERNAME LIKE '$array'";

            $src = $forgotPass->verify($sql);

            if($src){
                
                $data = json_decode($src, true);
                echo $forgotPass->sendMail($data[0]);

            } else {
                echo json_encode(['error'=>$lang->forgotPass['notfound']],JSON_UNESCAPED_UNICODE);
            }
        }

    } else if ($action == 'recovery'){

    }