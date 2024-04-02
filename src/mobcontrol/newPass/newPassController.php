<?php

    use Packages\MobControl\languages;
    use Packages\MobControl\newPass;

    $newPass = new newPass;

    $lang = new languages;

   $newPass->verify();

   if(isset($_POST['key'])){

    if(isset($_POST['key'])){

        echo $newPass->updatePass($_POST);

    } else {
        return json_encode(['error'=>'123'],JSON_UNESCAPED_UNICODE);
    }

   }