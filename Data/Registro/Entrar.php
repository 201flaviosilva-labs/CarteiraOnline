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
    <h1>A Resolver o pedido de Log In</h1>
    <?php
        $UserName = isset($_POST["UserName"]) ? $_POST["UserName"] : "";
        $PalavraPasse = isset($_POST["PalavraPasse"]) ? $_POST["PalavraPasse"] : "";
        $sql = "SELECT * FROM Useres WHERE UserName='$UserName';"; // Query
        $result = $conn->query($sql);
        $resultadoImport = $result->fetch_assoc();
        if (isset($resultadoImport["UserName"])) {
            if (password_verify("$PalavraPasse", $resultadoImport["PalavraPasse"])) {
                $_SESSION["SessaoUserId"] = $resultadoImport["User_Id"];
                MensFunc("nome de User e Palavra-Passe estão corretas!", false);
                header('Location: ' . "../../Pages/Dashboard/index.php");
            } else {
                MensFunc("Erro no UserName ou na Palavra-Passe!");
            }
        } else {
            MensFunc("Erro no UserName ou na Palavra-Passe!");
        }

    function MensFunc($mensagem, $IsErro = true)
    {
        echo "<h2>$mensagem<h2><br>";
        if ($IsErro) { // É um erro
            echo "<p>Porfavor tenta mais tarde ou confirma se escreveste tudo corretamente!<p><br>";
        }
    }
    ?>
    <a href="../../Pages/LogIn_Registro/index.php">Voltar</a>
</body>

</html>