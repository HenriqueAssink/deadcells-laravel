<?php
require_once('../models/Usuario.php');
ini_set('session.cookie_httponly', 1);
session_set_cookie_params(['samesite' => 'Strict']);
session_start([
    'cookie_lifetime' => 7200
]);

$opcao = isset($_REQUEST['op']) ? $_REQUEST['op'] : null;

switch ($opcao) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
}

function login()
{
    //validacao de campos obrigatorios
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        header('Location: ../../login.php?erro=1');
        return false;
    }

    //sanitizacao
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = sha1($_POST['senha'] . $email);

    //verificacao do login
    $usuario = new Usuario();
    $buscaUsuario = $usuario->verificarCredenciais($email, $senha);
    if ($buscaUsuario == false) {
        header('Location: ../../login.php?erro=3');
        return false;
    }

    // if (session_status() != PHP_SESSION_ACTIVE) {
    //     session_regenerate_id(true);
    //     session_id(bin2hex(random_bytes(16))); 
    // }

    $_SESSION['id'] = $buscaUsuario->getId();
    $_SESSION['email'] = $buscaUsuario->getEmail();
    $_SESSION['nome'] = $buscaUsuario->getNome();
    $_SESSION['perfil'] = 0;
    $_SESSION['logado'] = true;

    header('Location: ../../index.php?sucesso=3');
}


function logout()
{
    session_destroy();
    header('Location: ../../index.php?sucesso=0');
    return true;
}
