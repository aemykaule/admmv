<?php

session_start();

// Limpa todas as informações da sessão
$_SESSION = [];

// Remove o cookie da sessão, se estiver sendo utilizado
if (ini_get('session.use_cookies')) {

    $parametros = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $parametros['path'],
        $parametros['domain'],
        $parametros['secure'],
        $parametros['httponly']
    );

}

// Encerra a sessão
session_destroy();

// Redireciona o aluno para a tela de login
header('Location: login_aluno.php?saida=sucesso');
exit;

?>