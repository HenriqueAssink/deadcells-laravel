<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: ./index.php");
    exit();
}

require_once("./app/models/Usuario.php");
$titulo = 'Editar Usuario';

if (!isset($_GET['id'])) {
    echo '<p class="alert alert-danger">ID não foi fornecido para a edição.</p>';
    exit();
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$usuarios = new Usuario();
$usuario = $usuarios->selecionarPorId($id);

if (!$usuario) {
    echo '<p class="alert alert-danger">Usuario não encontrado.</p>';
    exit();
}

require_once('./layouts/header.php');

if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 1) {
        echo '<p class="text-danger">Campo obrigatório não preenchido</p>';
    }
}
?>

<main class="container mt-5">
    <div class="container mt-4 ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Altere os seus dados cadastrais</h2>
                <form name="form-contato" method="post" action="./app/controllers/usuarios.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="form-nome" class="form-label">Informe o seu nome:</label>
                        <input type="text" name="nome" id="form-nome" class="form-control" placeholder="Nome Completo" value="<?php echo $usuario->getNome(); ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="form-email" class="form-label">Informe o seu e-mail:</label>
                        <input type="email" name="email" id="form-email" class="form-control" placeholder="email@dominio.com" value="<?php echo $usuario->getEmail(); ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="form-senha" class="form-label">Informe uma nova senha:</label>
                        <input type="password" name="senha" class="form-control" placeholder="Use caracteres especiais e números na sua senha" required />
                    </div>

                    <div class="mb-3">
                        <label for="form-foto" class="form-label text-white">Escolha uma foto:</label>
                        <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg" required>
                    </div>

                    <input type="hidden" name="op" value="atualizar">
                    <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                    <button type="submit" class="btn btn-outline-danger">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once('./layouts/footer.php'); ?>