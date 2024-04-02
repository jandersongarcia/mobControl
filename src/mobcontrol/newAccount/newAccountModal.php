<?php

// Declaração do namespace e inclusão das classes necessárias
namespace Packages\MobControl;

use Database\MySQL\MySQL; // Importa a classe MySQL
use Packages\MobControl\languages; // Importa a classe languages

// Definição da classe newAccount, que herda da classe languages
class newAccount extends languages {

    // Propriedade privada para armazenar a instância da conexão MySQL
    private $sqli;

    // Método construtor
    function __construct(){
        // Inicializa a instância da conexão MySQL
        $this->sqli = new MySQL;
    }

    // Método para verificar a existência do usuário
    public function verifyUser($user){
        // Monta o código SQL para verificar a existência do usuário
        $code = "SELECT COUNT(*) 'result' FROM mb_user_account u WHERE LOWER(u.USERNAME) LIKE LOWER('$user')";
        // Executa a consulta SQL e retorna o resultado
        return $this->sqli->query($code);
    }

    // Método para verificar a existência do email
    public function verifyEmail($mail){
        // Monta o código SQL para verificar a existência do email
        $code = "SELECT COUNT(*) 'result' FROM mb_user_account u WHERE LOWER(u.EMAIL) LIKE LOWER('$mail')";
        // Executa a consulta SQL e retorna o resultado
        return $this->sqli->query($code);
    }

    // Método para adicionar um novo usuário
    public function addNew($data){
        // Executa a inserção na tabela 'mb_user_account' com os dados fornecidos
        return $this->sqli->insert('mb_user_account',$data);
    }
}
