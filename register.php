<?php
$titulo = 'Página de Registro';
require_once('./layouts/header.php'); ?>


<main class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-white text-center mb-4">Cadastre-se aqui</h2>

            <?php
            if (isset($_GET['erro'])) {
                if ($_GET['erro'] == 1) {
                    echo '<p class="text-danger text-center">Campos obrigatórios não preenchidos</p>';
                }
            }
            ?>

            <form name="form-contato" method="post" action="./app/controllers/usuarios.php" enctype="multipart/form-data">
                <label for="form-nome" class="form-label text-white">Informe o seu nome: </label>
                <input type="text" name="nome" id="form-nome" class="form-control" placeholder="Nome Completo" required />
                <br />
                <label for="form-email" class="form-label text-white">Informe o seu e-mail: </label>
                <input type="email" name="email" id="form-email" class="form-control" placeholder="email@dominio.com" required />
                <br />
                <label for="form-senha" class="form-label text-white">Informe uma senha: </label>
                <input type="password" name="senha" class="form-control" placeholder="Use caracteres especiais e números na sua senha" required>
                <br />
                <label for="form-foto" class="form-label text-white">Escolha uma foto: </label>
                <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg" required>
                <input type="hidden" name="op" value="cadastrar">
                <br />
                <button type="submit" class="btn btn-outline-danger">Enviar</button>
                <br /><br /><br /><br />
            </form>
        </div>
    </div>
    
</main>
<?php require_once('./layouts/footer.php'); ?>