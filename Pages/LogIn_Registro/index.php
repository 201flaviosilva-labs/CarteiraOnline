<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="../../style/reset.css">
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <title>Bem Vindo</title>
</head>

<body>
    <header>
        <h1 class="w-100 text-center align-middle">Bem Vindo 🖖</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="../../index.html">Carteira Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="../../index.html">Home</a>
                    <a class="nav-item nav-link" href="../Dashboard/index.php">Dashboard</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Entrar/Registrar</a>
                    <!-- <a class="nav-item nav-link" href="../../Data/Registro/Sair.php">Sair</a> -->
                </div>
            </div>
        </nav>
    </header>

    <!-- Iniciar Sessão -->
    <main class="d-flex justify-content-around">
        <section class="d-flex align-items-center">
            <form class="h-50 d-flex flex-column justify-content-around shadow-lg p-3 mb-5 bg-white rounded" action="../../Data/Registro/Entrar.php" method="POST">
                <h2 class="w-100 text-center">Já nos conheçemos? ◀️</h2>

                <input type="text" placeholder="Nome de Usuário" pattern=".{1,30}" name="UserName" required>

                <input type="password" placeholder="Palavra-Passe" pattern=".{4,30}" name="PalavraPasse" required>

                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </section>

        <!-- Criar Conta -->
        <section class="d-flex align-items-center">
            <form class="h-50 d-flex flex-column justify-content-around shadow-lg p-3 mb-5 bg-white rounded" action="../../Data/Registro/Registrar.php" method="POST">
                <h2 class="w-100 text-center">Clica Start! ⏯</h2>

                <input type="text" placeholder="Nome de Usuário" pattern=".{1,30}" name="UserName" required>

                <input type="password" placeholder="Palavra-Passe" pattern=".{4,30}" name="PalavraPasse" required>

                <button type="submit" class="btn btn-primary">Criar Conta</button>
            </form>
        </section>
    </main>

</body>

</html>