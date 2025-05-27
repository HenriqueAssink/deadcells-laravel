<?php
session_start();
require_once('./app/models/Post.php');
$produtos = new Post();
$lista = $produtos->selecionarTodos();
$titulo = "Blog";
require_once('./layouts/header.php');
?>

<?php
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 2) {
        echo '<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                Usuário cadastrado com sucesso
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}

if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 1) {
        echo '<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                Seu usuário foi excluído com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
?>

<body>

    <div class="trailer text-center" style="background-image: url('./assets/img/imagens/fundo.jpg');">

        <div class="container">
            <iframe src="https://www.youtube-nocookie.com/embed/02G3GUt6Nzo?rel=0&ampshowinfo=0" frameborder="0"></iframe>
        </div>
    </div>

    <div class="container mt-4 ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php foreach ($lista as $item) : ?>
                    <div class="custom-shadow p-3 mb-3 bg-dark text-white">
                        <h3 class="text-white"><?php echo $item->getTitulo(); ?></h3>
                        <p class="text-white"><?php echo $item->getTexto(); ?></p>
                        <p class="text-white"><?php echo $item->getData(); ?></p>
                        <a href="post.php?id=<?php echo $item->getId(); ?>" class="btn btn-outline-danger">Ver mais detalhes</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php require_once("./layouts/footer.php"); ?>
</body>

</html>