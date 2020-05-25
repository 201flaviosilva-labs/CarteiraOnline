<?php require "../../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
</head>

<body>
    <?php
    $User_Id = $_SESSION["SessaoUserId"];
    $Conta_Id =  $_SESSION["SessaoContaId"];
    $Registro_Id =  $_GET["Registro_Id"];

    $sql = "SELECT *
        FROM Contas
        INNER JOIN Useres
        ON Contas.User_Id = Useres.User_Id
        WHERE Useres.User_Id = $User_Id
        AND $Conta_Id = Contas.Conta_Id";
    $resultContas = $conn->query($sql);

    if (!$resultContas->num_rows > 0) {
        echo "<h2>Não tens acesso a esta operação!</h2>";
    } else {

        $sql = "SELECT *
        FROM Registros
        WHERE $User_Id = User_Id
        AND $Conta_Id = Conta_Id
        AND $Registro_Id = Registro_Id";
        $resultRegistro = $conn->query($sql);

        if (!$resultRegistro->num_rows > 0) {
            echo "<h2>Operação não foi possivel de ser concluida!</h2>";
        } else {

            $sql = "DELETE FROM Registros WHERE $Registro_Id = Registro_Id;";

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
                    echo 'Erro: ' . $e->getMessage();
                }

                echo "<h2>A Registro Eliminado!</h2>";
                header('Location: ' . "../../../Pages/Dashboard/Conta/index.php?Conta_Id=$Conta_Id");
            } else {
                echo "Deu um erro a elimminar na operação, tenta novamente!";
                echo "<br>";
                echo "Ou então tenta voltar a fazer login";
            }
        }
    }
    ?>
</body>

</html>