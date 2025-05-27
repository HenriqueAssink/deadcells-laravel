<?php
$titulo = 'Página de Login';
require_once("./layouts/header.php");
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-white text-center mb-4">Login</h2>

            <?php
            if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                echo '<p class="text-danger text-center">Por favor insira email e senha.</p>';
            } elseif (isset($_GET['erro']) && $_GET['erro'] == 3) {
                echo '<p class="text-danger text-center">Email e senha inválidos.</p>';
            }
            ?>

            <form action="./app/controllers/autenticacao.php" method="post">
                <label for="email" class="text-white">Email:</label>
                <input type="email" id="email" name="email" required class="form-control">

                <label for="senha" class="text-white mt-3">Password:</label>
                <input type="password" id="senha" name="senha" required class="form-control">

                <input type="hidden" name="op" value="login">

                <button type="submit" class="btn btn-outline-danger mt-3">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require_once("./layouts/footer.php"); ?>
