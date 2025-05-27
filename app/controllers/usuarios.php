<?php
require_once('../models/Usuario.php');
session_start();

$opcao = $_REQUEST['op'];

switch ($opcao) {
    case 'cadastrar':
        cadastrar();
        break;

    case 'editar':
        editar();
        break;

    case 'atualizar':
        atualizar();
        break;

    case 'excluir':
        excluir();
        break;
}
function cadastrar()
{
    if (empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['nome']) || empty($_FILES['foto'])) {
        header('Location: ../../register.php?erro=1');
        return false;
    }

    // Sanitize 
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = sha1($_POST['senha'] . $email);

    $foto = uploadArquivoUsuario('foto', 'usuarios');
    if ($foto === false) {
        header('Location: ../../register.php?erro=2');
        return false;
    }


    $usuario = new Usuario();
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $usuario->setFoto($foto);

    // salvar o usuario
    if ($usuario->salvar()) {
        header('Location: ../../index.php?sucesso=2');
        return true;
    } else {
        header('Location: ../../index.php?erro=0');
        return false;
    }
}

function editar()
{
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $usuarios = new Usuario();
    $usuarios = $usuarios->selecionarPorId($id);
    require_once('../../editar-usuario.php');
}

function atualizar()
{

    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_FILES['foto']) || empty($_POST['id'])) {
        header('Location: ../../editar-usuario.php?erro=1&id=' . $_POST['id']);
        return false; //ou exit
    }

    //sanitizacao
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = sha1($_POST['senha'] . $email);

    $foto = uploadArquivoUsuario('foto', 'usuarios');
    if ($foto === false) {
        header('Location: ../../editar-cadastro.php?erro=2');
        return false;
    }

    //simular um UPDATE no BD
    $usuarios = new Usuario(); //objeto de suporte -> model
    $usuario = $usuarios->selecionarPorId($id);
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $usuario->setFoto($foto);

    if ($usuario->atualizar($id)) {
        header('Location: ../../minha-conta.php?sucesso=0&id=' . $_POST['id']);
        return true; //ou exit
    } else {
        header('Location: ../../editar-usuario.php?erro=0');
        return false; //ou exit
    }
}

function excluir()
{
    if (empty($_GET['id'])) {
        header('Location: ../../minha-conta.php?erro=1');
        return false; //ou exit
    }
    //se continuar aqui, deu boa com ID
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $usuario = new Usuario();
    if ($usuario->excluir($id)) {
        session_destroy();
        header('Location: ../../index.php?sucesso=1');
        return true; //ou exit
    } else {
        header('Location: ../../minha-conta.php?erro=0');
        return false; //ou exit
    }
}

function uploadArquivoUsuario($indiceArquivo, $diretorio)
{
    if ($_FILES[$indiceArquivo]['size'] <= 2000000) { //validacao de ate 2Mb
        //validar mime types (tipo do arquivo)
        $tiposValidos = ['image/png', 'image/jpeg'];
        $tipo = mime_content_type($_FILES[$indiceArquivo]['tmp_name']);
        if (in_array($tipo, $tiposValidos)) {
            $nomefoto = trim($_FILES[$indiceArquivo]['name']); //remove espacos em branco no inicio e no final da string
            $nomefoto = str_replace(' ', '-', $nomefoto); //substitui espacos em branco por hifens
            $nomefoto = preg_replace('/[^a-zA-Z0-9-.]/', '', $nomefoto); //remove qualquer caractere especial na string
            $mover = move_uploaded_file(
                $_FILES[$indiceArquivo]['tmp_name'],
                "../../assets/img/$diretorio/" . $nomefoto
            );
            if ($mover) {
                return $nomefoto;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    return false;
}
