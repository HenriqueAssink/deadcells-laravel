<?php
session_start();
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
        echo '<p class="text-success">Seu post foi excluido com sucesso!</p>';
    }
}
if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 0) {
        echo '<p class="text-danger">Algo deu errado</p>';
    }
}
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 2) {
        echo '<p class="text-success">Post atualizado com sucesso!</p>';
    }
}
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 0) {
        echo '<p class="text-success">Seu post foi postado com sucesso!</p>';
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