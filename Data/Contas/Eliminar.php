<?php require "../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    <title>Eliminar Conta</title>
</head>

<body>
    <?php
        $User_Id = isset($_SESSION["SessaoUserId"]) ? $_SESSION["SessaoUserId"] : 0;
        $Conta_Id =  isset($_GET["Conta_Id"]) ? $_GET["Conta_Id"] : 0;
        if (isset($Conta_Id) & isset($User_Id)) {
            $sql = "SELECT *
                    FROM Contas
                    INNER JOIN Useres
                    ON Contas.User_Id = Useres.User_Id
                    WHERE Useres.User_Id = $User_Id
                    AND $Conta_Id = Contas.Conta_Id";
            $resultContas = $conn->query($sql);
            if (!(isset($resultContas->num_rows) > 0)) {
                MensFunc("Não tens açesso a esta operação!");
            } else {
                $sql = "DELETE FROM Registros WHERE $Conta_Id = Conta_Id;";
                if ($conn->query($sql) === TRUE) {
                    MensFunc("Os registros foram todos eliminados!", false);
                    $sql = "DELETE FROM Contas WHERE $Conta_Id = Conta_Id;";
                    if ($conn->query($sql) === TRUE) {
                        MensFunc("A Conta foi eliminada!", false);
                        // header('Location: ' . "../../Pages/Dashboard/index.php");
                    }
                } else {
                    MensFunc("Deu um erro a elimminar a conta");
                }
            }
        }else {
            MensFunc("Dados errados ou insuficientes!");
        }

    function MensFunc($mensagem, $IsErro = true)
    {
        echo "<h2>$mensagem<h2><br>";
        if ($IsErro) { // É um erro
            echo "<p>Porfavor tenta mais tarde ou confirma se escreveste tudo corretamente e tens a sessão iniciada!<p><br>";
        }
    }
    ?>
    <a href="../../Pages/Dashboard/index.php">Voltar</a>
</body>

</html>