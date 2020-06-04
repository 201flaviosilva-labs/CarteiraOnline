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
    try {
        $UserName =  isset($_POST["UserName"]) ? $_POST["UserName"] : "";
        $PalavraPasse = isset($_POST["PalavraPasse"]) ? $_POST["PalavraPasse"] : "";

        if (isset($UserName)) {
            $sqlChek = "SELECT UserName FROM Useres WHERE UserName = '$UserName';";
            $result = $conn->query($sqlChek);
            $resultadoImport = $result->fetch_assoc();

            if (!isset($resultadoImport["UserName"])) {

                $PalavraPasse = password_hash("$PalavraPasse", PASSWORD_DEFAULT);
                echo "<br />";

                $sql = "INSERT INTO Useres (UserName, PalavraPasse)
                        VALUES ('$UserName', '$PalavraPasse');";

                if ($conn->query($sql) === TRUE) {
                    MensFunc("A tua conta foi criada!", false);
                } else {
                    MensFunc("Algo Não Correu Como Experado ao Criar Conta!");
                }
            } else {
                MensFunc("Não podes usar esse Nome de Utilizador porque já existe!");
                MensFunc("Os dados não estão corretos!");
            }
        }else {
            MensFunc("Os dados não estão corretos!");
        }
    } catch (Exception $e) {
        MensFunc("Algo Não Correu Como Experado ao Criar Conta!");
    }

    function MensFunc($mensagem, $IsErro = true)
    {
        echo "<h2>$mensagem</h2><br>";
        if ($IsErro) { // É um erro
            echo "<p>Porfavor tenta mais tarde ou confirma se escreveste tudo corretamente!<p><br>";
        }
    }
    ?>
</body>

</html>