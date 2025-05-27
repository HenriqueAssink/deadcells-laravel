<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
    exit;
}
require_once('./app/models/Post.php');
$id_usuario = $_SESSION['id'];
$posts = new Post();
$lista_posts = $posts->selecionarPorIdUsuario($id_usuario);
$titulo = 'Meus Posts';
require_once('./layouts/header.php');
?>

<?php
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Seu post foi excluído com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Algo deu errado
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 2) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Post atualizado com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Seu post foi postado com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
?>

<main class="container mt-4">
    <?php if ($lista_posts) { ?>
        <div class="row">
            <?php foreach ($lista_posts as $post) { ?>
                <div class="col-md-4 mb-4">
                    <div class="custom-shadow p-4 mb-4 bg-dark text-white">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $post->getTitulo(); ?></h3>
                            <p class="card-text"><?php echo $post->getTexto(); ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo $post->getData(); ?></small></p>
                            <a href="post.php?id=<?php echo $post->getId(); ?>" class="btn btn-outline-secondary">Ver mais detalhes</a>
                            <a href="editar-post.php?id=<?php echo $post->getId(); ?>" class="btn btn-outline-light">Editar Post</a>
                            <a href="./app/controllers/posts.php?op=excluir&id=<?php echo $post->getId(); ?>" class="btn btn-outline-danger">Excluir</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="mt-4">O usuário não tem posts cadastrados.</p>
    <?php } ?>
</main>

<?php require_once('./layouts/footer.php'); ?>