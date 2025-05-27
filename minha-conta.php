<?php
session_start();
require_once('./app/models/Usuario.php');
$id_usuario = $_SESSION['id'];
$usuario = new Usuario();
$usuarios = $usuario->selecionarPorIdUsuario($id_usuario);
$titulo = "Minha Conta";
require_once('./layouts/header.php');
?>

<?php

if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 0) {
        echo '<div class="alert alert-danger shadow" role="alert" role="alert">Algo deu errado
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 0) {
        echo '<div class="alert alert-success shadow role="alert"" role="alert">Cadastro atualizado com sucesso!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

?>

<main class="container mt-5">
    <?php if ($usuarios) { ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 mb-4">
                <div class="custom-shadow p-4 mb-4 bg-dark text-white">
                    <div class="card-body text-center">
                        <h3 class="card-title">
                            <?php echo $usuarios->getNome(); ?>
                        </h3>
                        <p class="card-text">
                            <img src="assets/img/usuarios/<?php echo $usuarios->getFoto(); ?>" alt="Foto do usuário"
                                class="img-fluid rounded-circle">
                        </p>

                        <a href="editar-usuario.php?id=<?php echo $usuarios->getId(); ?>"
                            class="btn btn-outline-light">Editar usuário</a>
                        <a href="./app/controllers/usuarios.php?op=excluir&id=<?php echo $usuarios->getId(); ?>"
                            class="btn btn-outline-danger">Excluir</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-center mt-4">Não há usuários cadastrados.</p>
    <?php } ?>
</main>


<?php require_once('./layouts/footer.php'); ?>
