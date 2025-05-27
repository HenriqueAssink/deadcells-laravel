<?php
session_start();
if (!isset($_SESSION['logado'])) {
    require_once("./index.php");
}
$titulo = 'Criar Post';
?>
<?php require_once('./layouts/header.php'); ?>

<main class="container mt-5">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php
                if (isset($_GET['erro'])) {
                    if ($_GET['erro'] == 1) {
                        echo '<p class="text-danger">Campos obrigatórios não preenchidos (Título e Texto)</p>';
                    }
                }
                ?>

                <form method="post" action="./app/controllers/posts.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="form-titulo" class="form-label text-white">Título:</label>
                        <input type="text" name="titulo" id="form-titulo" class="form-control" placeholder="Informe o título do post" required>
                    </div>
                    <div class="mb-3">
                        <label for="form-texto" class="form-label text-white">Texto:</label>
                        <textarea name="texto" id="form-texto" class="form-control" rows="5" cols="8" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="op" value="salvar">
                        <button type="submit" class="btn btn-outline-danger">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


<?php require_once('./layouts/footer.php'); ?>