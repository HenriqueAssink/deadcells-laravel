<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: ./index.php");
    exit();
}

require_once("./app/models/Post.php");
$titulo = 'Editar Post';

if (!isset($_GET['id'])) {
    echo '<p class="alert alert-danger">ID não foi fornecido para a edição.</p>';
    exit();
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$posts = new Post();
$post = $posts->selecionarPorId($id);

if (!$post) {
    echo '<p class="alert alert-danger">Post não encontrado.</p>';
    exit();
}

require_once('./layouts/header.php');
?>

<main class="container mt-5">
    <?php
    if (isset($_GET['erro'])) {
        if ($_GET['erro'] == 1) {
            echo '<p class="text-danger text-center">Campos obrigatórios não preenchidos (Título e Texto)</p>';
        }
    }
    ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="./app/controllers/posts.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="form-titulo" class="form-label">Título:</label>
                        <input type="text" name="titulo" id="form-titulo" class="form-control" placeholder="Informe o título do post" value="<?php echo $post->getTitulo(); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="form-texto" class="form-label">Texto:</label>
                        <textarea name="texto" id="form-texto" class="form-control" rows="5" cols="8"><?php echo $post->getTexto(); ?></textarea>
                    </div>
                    <input type="hidden" name="op" value="atualizar">
                    <input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
                    <button type="submit" class="btn btn-outline-danger">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once('./layouts/footer.php'); ?>