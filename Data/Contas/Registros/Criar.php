<?php require "../../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicioar Registro</title>
</head>

<body>
    <?php
    try {
        $User_Id = $_SESSION["SessaoUserId"];
        $Conta_Id = $_SESSION["SessaoContaId"];
        $Nome =  $_GET["Nome"];
        $Montante =  $_GET["Montante"];
        $Data =  isset($_GET["Data"]) ? $_GET["Data"] : date("Y/m/d");

        $sql = "SELECT *
        FROM Contas
        INNER JOIN Useres
        ON Contas.User_Id = Useres.User_Id
        WHERE Useres.User_Id = $User_Id
        AND $Conta_Id = Contas.Conta_Id";
        $resultContas = $conn->query($sql);

        if (!$resultContas->num_rows > 0) {
            MensFunc("Não acesso a esta operação!");
        } else {

            $resultContaNome = "SELECT Nome AS ContaNome
                    FROM Contas
                    WHERE $Conta_Id = Conta_Id;";
            $resultContaNome = $conn->query($resultContaNome);
            $resultContaNome = $resultContaNome->fetch_assoc();
            $resultContaNome = $resultContaNome["ContaNome"];

            $sql = "INSERT INTO Registros (User_Id, Conta_Id, ContaNome, Nome, Montante, Data)
                VALUES ('$User_Id', '$Conta_Id', '$resultContaNome', '$Nome', '$Montante', '$Data');";

            if ($conn->query($sql) === TRUE) {

                $sqlSoma = "SELECT SUM(Montante) AS Montante
                    FROM Registros
                    WHERE $Conta_Id = Conta_Id;";
                $resultSoma = $conn->query($sqlSoma);
                $resultSoma = $resultSoma->fetch_assoc();
                $resultSoma = $resultSoma["Montante"];

                try {
                    $sqlBalanco = "UPDATE `Contas`
                        SET Balanco = $resultSoma
                        WHERE `Contas`.`Conta_Id` = $Conta_Id;";
                    $conn->query($sqlBalanco);
                } catch (Exception $e) {
                    MensFunc("Não foi possivel alterar o balanço!");
                }
                MensFunc("Registro criado!", false);
                // header('Location: ' . "../../../Pages/Dashboard/Conta/index.php?Conta_Id=$Conta_Id");
            } else {
                MensFunc("Não foi possivel criar a conta!");
            }
        }
    } catch (Exception $e) {
        MensFunc("Algo deu errado!");
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