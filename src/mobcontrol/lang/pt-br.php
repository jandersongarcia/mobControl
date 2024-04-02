<?php

    namespace Packages\MobControl;

    class languages {

        public $login = [
            "title" => "Faça o login para continuar",
            "userOrEmail" => "Nome de usuário ou e-mail",
            "password" => "Senha",
            "signIn" => "Entrar",
            "rememberMe" => "Lembrar-me",
            "needHelp" => "Esqueçeu a senha?",
            "createAccount" => "Criar nova conta",
            "error_user" => "Nome de usuário ou senha incorretos.",
            "blocked_user" => "Usuário bloqueado."
        ];

        public $newAccount = [
            "createYurAccountOn" => "Crie sua conta no " . APP['app_name'],
            "name" => "Nome",
            "surname" => "Sobrenome",
            "username" => "Nome de usuário",
            "createPassword" => "Criar uma senha",
            "confirmPassword" => "Confirmar sua senha",
            "dateOfBirth" => "Data de nascimento",
            "emailAddress" => "Endereço de e-mail",
            "register" => "Cadastrar",
            "returnToLogin" => "Voltar ao Login",
            "userExists" => "Este nome de usuário já existe.",
            "emailExists" => "Endereço de e-mail já cadastrado.",
            "unauthorizedEmail" => "Servidor de e-mail não autorizado para cadastro!"
        ];

        public $recoveryError = [
            "message" => "O código de recuperação inserido pode estar incorreto ou expirado. Por favor, solicite um novo código de recuperação <a href='/access/forgot-pass'>clicando aqui</a>!"
        ];

        public $forgotPass = [
            "title" => "Recuperar senha",
            "titleMail" => "Recuperação de senha",
            "nameUser" => "Nome de usuário ou endereço de e-mail",
            "message" => "Digite o seu nome de usuário ou endereço de e-mail. Você receberá um e-mail com instruções sobre como redefinir sua senha",
            "newPass" => "Obter nova senha",
            "notfound" => "Nome do usuário ou endereço de e-mail não encontrado.",
            "sendEmail" => "Um e-mail com os dados de recupeção de senha foi enviado para o endereço ",
            "errorSendEmail" => "Houve um erro interno ao tentar enviar e-mail de recuperação. Entre em contato com o administrador do sistema."        
        ];

        public $newPass = [
            "message" => "Digite sua nova senha abaixo ou gere uma.",
            "newPass" => "Nova senha",
            "tip" => "Dica: A senha deve ter pelo menos oito caracteres e conter uma combinação de letras maiúsculas, minúsculas, números e símbolos como ! * $ % ^ & para aumentar sua segurança.",
            "savePass" => "Salvar senha",
            "generate" => "Gerar senha",
            "titleMail" => "Alteração de Senha",
            "success" => "Sua nova senha foi definida com sucesso! Por favor, clique em <strong>'Voltar ao login'</strong> para acessar sua conta.",
            "erro0" => "Encontramos um problema ao nos conectar com o banco de dados. Por favor, tente novamente mais tarde ou entre em contato com nossa equipe de suporte técnico.",
            "erro1" => "Não conseguimos alterar sua senha devido a um erro técnico. Por favor, tente novamente em alguns momentos. Se o problema continuar, nossa equipe de suporte está à disposição para ajudar."
        ];

    }