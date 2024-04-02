<?php

// Importa as classes necessárias
use Core\MClass\Application;
use Core\MClass\Mob;
use Packages\MobControl\languages;
use Packages\MobControl\newAccount;

// Instância da classe NewAccount
$newAccount = new newAccount;

// Instância da classe Languages
$lang = new languages;

// Instância da classe Application
$app = new Application;

// Instância da classe Mob
$mob = new Mob;

// Lista de domínios de e-mail permitidos
$listWhite = [
    
];

// Obtém o valor do parâmetro 'action' da requisição POST ou GET
$action = isset ($_POST['action']) ? $_POST['action'] : @$_GET['action'];

// Verifica se a ação é 'verifyUser'
if ($action == 'verifyUser') {
    // Obtém o valor do parâmetro 'usr' da requisição GET
    $user = @$_GET['usr'];

    // Chama o método 'verifyUser' da classe NewAccount e decodifica o resultado como JSON
    $json = json_decode($newAccount->verifyUser($user), true);

    // Obtém o resultado e a mensagem da resposta
    $result = $json[0]['result'];
    $message = ($result > 0) ? $lang->newAccount['userExists'] : '';

    // Cria um array com o resultado e a mensagem
    $array = [
        "result" => $result,
        "message" => $message
    ];

    // Retorna o array como JSON
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
}

// Verifica se a ação é 'verifyEmail'
if ($action == 'verifyEmail') {
    // Obtém o valor do parâmetro 'mail' da requisição GET
    $mail = @$_GET['mail'];

    $verify = false;

    // Verifica se a lista de domínios permitidos está vazia
    if (empty($listWhite)) {
        $verify = true;
    } else {
        // Extrai o domínio do e-mail fornecido
        $domain = explode('@', $mail)[1];
        // Verifica se o domínio está na lista de domínios permitidos
        if (!in_array($domain, $listWhite)) {
            // Se o domínio não estiver na lista, define um resultado e mensagem de erro
            $result = 1;
            $message = $lang->newAccount['unauthorizedEmail'];
        } else {
            // Caso contrário, prossegue com a verificação do e-mail
            $verify = true;
        }
    }

    // Se a verificação do domínio permitido passar, verifica o e-mail
    if ($verify) {
        // Chama o método 'verifyEmail' da classe NewAccount e decodifica o resultado como JSON
        $json = json_decode($newAccount->verifyEmail($mail), true);

        // Obtém o resultado e a mensagem da resposta
        $result = $json[0]['result'];
        $message = ($result > 0) ? $lang->newAccount['emailExists'] : '';
    }

    // Cria um array com o resultado e a mensagem
    $array = [
        "result" => $result,
        "message" => $message
    ];

    // Retorna o array como JSON
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
}

// Verifica se a ação é 'addUser'
if ($action == 'addUser') {
    // Obtém os dados da requisição POST
    $data = @$_POST;

    // Criptografa a senha antes de adicionar o novo usuário
    $data['PASSWORD'] = $mob->createHash($data['PASSWORD']);

    // Adiciona um novo usuário com os dados fornecidos e retorna o resultado
    echo $newAccount->addNew($data);
}
