<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" href="../assets/img/imagens/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>
        <?= $titulo ?>
    </title>
</head>

<style>
    a .trailer {
        position: relative;
        height: 600px;
        overflow: hidden;
    }

    .trailer iframe {
        width: 850px;
        height: 450px;
        position: center;
        margin-top: 70px;
        margin-bottom: 70px;
    }

    .img-fluid {
        width: 111px;
        height: 111px;
    }


    .custom-shadow {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        /*intensidade e cor da sombra*/
    }
</style>


<body style="background-color: #101524; color: white;">

    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a href="./index.php" class="navbar-brand">
                <img src="./assets/img/imagens/logobranco.png" alt="Logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex">
                    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) { ?>
                        <a href="./minha-conta.php" class="btn btn-outline-light mx-2">Minha Conta</a>
                        <a href="./meus-posts.php" class="btn btn-outline-light mx-2">Meus Posts</a>
                        <a href="./criar-post.php" class="btn btn-outline-light mx-2">Criar Post</a>
                        <a href="./app/controllers/autenticacao.php?op=logout" class="btn btn-outline-light mx-2">Logout</a>
                    <?php } else { ?>
                        <a href="../login.php" class="btn btn-outline-light mx-2">Entrar</a>
                        <a href="../register.php" class="btn btn-outline-light mx-2">Registrar</a>
                    <?php } ?>
                </form>
            </div> 
        </div>
    </nav>