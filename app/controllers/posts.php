<?php
session_start();
require_once('../models/Post.php');

$operacao = $_REQUEST['op'];

switch ($operacao) {
    case 'salvar':
        salvar();
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

function salvar()
{
    if (empty($_POST['titulo']) || empty($_POST['texto'])) {
        header('Location: ../../criar-post.php?erro=1');
        return false;
    }
    //sanitizacao   
    $idusuario = $_SESSION['id'];
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data = date('Y-m-d H:i:s');
    $texto = filter_var($_POST['texto'], FILTER_SANITIZE_SPECIAL_CHARS);

    $post = new Post();
    $post->setTitulo($titulo);
    $post->setData($data);
    $post->setTexto($texto);
    $post->setIdUsuario($idusuario);

    if ($post->salvar()) {
        header('Location: ../../meus-posts.php?sucesso=0');
    } else {
        //algo deu ruim
        header('Location: ../../criar-post.php?erro=0');
    }
}

function editar()
{
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $posts = new Post();
    $posts = $posts->selecionarPorId($id);
    require_once('../../editar-post.php');
}


function atualizar()
{

    if (empty($_POST['titulo']) || empty($_POST['texto']) || empty($_POST['id'])) {
        header('Location: ../../editar-post.php?erro=1&id='.$_POST['id']);
        return false; //ou exit
    }

    //sanitizacao
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $texto = filter_var($_POST['texto'], FILTER_SANITIZE_SPECIAL_CHARS);

    //simular um UPDATE no BD
    $posts = new Post(); //objeto de suporte -> model
    $post = $posts->selecionarPorId($id);
    $post->setTitulo($titulo);
    $post->setTexto($texto);


    if ($post->atualizar($id)) {
        header('Location: ../../meus-posts.php?sucesso=2&id=' . $_POST['id']);
        return true; //ou exit
    } else {
        header('Location: ../../editar-post.php?erro=0');
        return false; //ou exit
    }
}


function excluir()
{
    if (empty($_GET['id'])) {
        header('Location: ../../meus-posts.php?erro=1');
        return false; //ou exit
    }
    //se continuar aqui, deu boa com ID
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post = new Post();
    if ($post->excluir($id)) {
        header('Location: ../../meus-posts.php?sucesso=1');
        return true; //ou exit
    } else {
        header('Location: ../../meus-posts.php?erro=0');
        return false; //ou exit
    }
}
