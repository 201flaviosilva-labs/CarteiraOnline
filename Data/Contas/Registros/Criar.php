<?php require "../../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <title>Adicionar Registro</title>
</head>

<body>
    <?php
        $User_Id = isset($_SESSION["SessaoUserId"])?$_SESSION["SessaoUserId"]:0;
        $Conta_Id = isset($_SESSION["SessaoContaId"])?$_SESSION["SessaoContaId"]:0;
        $Nome =  isset($_GET["Nome"])?$_GET["Nome"]:"Registro";
        $Montante =  isset($_GET["Montante"])?$_GET["Montante"]:0;
        $Data =  isset($_GET["Data"]) ? $_GET["Data"] : date("Y/m/d");
        echo "<div>";
        echo "<p>Nome: $Nome;</p>";
        echo "<p>Valor: $Montante;</p>";
        echo "<p>Mensalidade: $Data;</p>";
        echo "</div>";
        if (isset($User_Id) & isset($Conta_Id) & isset($Nome) & isset($Montante) & isset($Data)) {
            $sql = "SELECT *
                    FROM Contas
                    INNER JOIN Useres
                    ON Contas.User_Id = Useres.User_Id
                    WHERE Useres.User_Id = $User_Id
                    AND $Conta_Id = Contas.Conta_Id";
            $resultContas = $conn->query($sql);
            if (!(isset($resultContas->num_rows) > 0)) {
                MensFunc("Não acesso a esta operação!");
            } else {
                $resultContaNome = "SELECT Nome AS ContaNome
                                    FROM Contas
                                    WHERE $Conta_Id = Conta_Id;";
                $resultContaNome = $conn->query($resultContaNome);
                $resultContaNome = $resultContaNome->fetch_assoc();
                $resultContaNome = isset($resultContaNome["ContaNome"]);
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
                    header('Location: ' . "../../../Pages/Dashboard/Conta/index.php?Conta_Id=$Conta_Id");
                } else {
                    MensFunc("Não foi possivel criar o Registro!");
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
    <a href="../../../Pages/Dashboard/Conta/index.php?Conta_Id=<?php echo $Conta_Id;?>">Voltar</a>
</body>

</html>