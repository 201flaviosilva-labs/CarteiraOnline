<?PHP
require "../Conexao.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    <title>LogIn</title>
</head>

<body>
    <h1>A realizar o pedido!</h1>
    <?php
    $_SESSION["SessaoUserId"] = 0;
    if ($_SESSION["SessaoUserId"] == 0) {
        MensFunc("Sessão terminada!", $IsErro = false);
    } else {
        MensFunc("Não foi possivel terminar sessão!");
    }

    function MensFunc($mensagem, $IsErro = true)
    {
        echo "<h2>$mensagem<h2><br>";
        if ($IsErro) { // É um erro
            echo "<p>Porfavor tenta mais tarde ou confirma se escreveste tudo corretamente!<p><br>";
        }
    }
    ?>
</body>

</html>