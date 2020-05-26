<?PHP
require "../Conexao.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
</head>

<body>
    <h1>A Resolver o pedido de Log In</h1>
    <?php
    try {
        $UserName = isset($_POST["UserName"]) ? $_POST["UserName"] : "Bug";
        $PalavraPasse = isset($_POST["PalavraPasse"]) ? $_POST["PalavraPasse"] : "123";

        echo "User: " . $UserName;
        echo "<br/>";
        echo "PP: " . $PalavraPasse;
        echo "<br/>";

        $sql = "SELECT * FROM Useres WHERE UserName='$UserName';"; // Query
        $result = $conn->query($sql);

        $resultadoImport = $result->fetch_assoc();
        echo "<br/>";

        if ($resultadoImport["UserName"]) {
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
    } catch (Exception $e) {
        MensFunc("Algo Não Correu Como Experado ao Iniciar Sessão!");
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