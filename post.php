<?php
session_start();
require_once('./app/models/Post.php');
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$posts = new Post();
$post = $posts->selecionarPorId($id, true);
$titulo = 'Mais Informações';
require_once('./layouts/header.php');
?>

<main class="container mt-5">
    <?php if ($post) : ?>
        <div class="custom-shadow p-3 mb-3 bg-dark text-white">
            <h3 class="text-white"><?php echo $post->getTitulo(); ?></h3>
            <p class="text-white"><?php echo $post->getTexto(); ?></p>
            <p class="text-white"><?php echo $post->getData(); ?></p>
            <a href="index.php" class="btn btn-outline-danger">Voltar para a lista</a>
        </div>
    <?php else : ?>
        <div class="alert alert-danger text-white" role="alert">
            Post não encontrado.
        </div>
    <?php endif; ?>
</main>

<?php require_once('./layouts/footer.php'); ?>

