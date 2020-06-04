<?PHP
require "../Conexao.php";
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    <title>Registrar</title>
</head>

<body>
    <?php
        $UserName =  isset($_POST["UserName"]) ? $_POST["UserName"] : "";
        $PalavraPasse = isset($_POST["PalavraPasse"]) ? $_POST["PalavraPasse"] : "";
        if ($UserName == "" || $PalavraPasse == "") {
            MensFunc("Os dados não estão corretos!");
            die();
        }
        echo "<div><p>User name: $UserName </p></div>";
        if (isset($UserName)) {
            $sqlChek = "SELECT UserName FROM Useres WHERE UserName = '$UserName';";
            $result = $conn->query($sqlChek);
            $resultadoImport = $result->fetch_assoc();
            if (!isset($resultadoImport["UserName"])) {
                $PalavraPasse = password_hash("$PalavraPasse", PASSWORD_DEFAULT);
                $sql = "INSERT INTO Useres (UserName, PalavraPasse)
                        VALUES ('$UserName', '$PalavraPasse');";
                if ($conn->query($sql) === TRUE) {
                    MensFunc("A tua conta foi criada!", false);
                } else {
                    MensFunc("Algo Não Correu Como Experado ao Criar Conta!");
                }
            } else {
                MensFunc("Não podes usar esse Nome de Utilizador porque já existe!
                <br> Os dados não estão corretos!");
            }
        }else {
            MensFunc("Os dados não estão corretos!");
        }

    function MensFunc($mensagem, $IsErro = true)
    {
        echo "<h2>$mensagem</h2><br>";
        if ($IsErro) { // É um erro
            echo "<p>Porfavor tenta mais tarde ou confirma se escreveste tudo corretamente!<p><br>";
        }
    }
    ?>
    <a href="../../Pages/LogIn_Registro/index.php">Voltar</a>
</body>

</html>