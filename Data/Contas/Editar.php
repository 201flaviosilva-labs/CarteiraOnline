<?php require "../Conexao.php"; ?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conta</title>
</head>

<body>
    <?php
    try {
        $User_Id = $_SESSION["SessaoUserId"];
        $Nome =  $_GET["Nome"];
        $Valor = $_GET["Valor"] ? $_GET["Valor"] : 0;
        $Mensalidade = $_GET["Mensalidade"] ? $_GET["Mensalidade"] : 0;
        $DataFinal = $_GET["DataFinal"] ? $_GET["DataFinal"] : date("Y-m-d");
        $Descricao = $_GET["Descricao"] ? $_GET["Descricao"] : "";

        echo "<div>";
        echo "<p>Nome: $Nome;</p>";
        echo "<p>Valor: $Valor;</p>";
        echo "<p>Mensalidade: $Mensalidade;</p>";
        echo "<p>Data Final: $DataFinal;</p>";
        echo "<p>Descrição: $Descricao:</p>";
        echo "</div>";

        $sql = "SELECT *
        FROM Contas
        INNER JOIN Useres
        ON Contas.User_Id = Useres.User_Id
        WHERE Useres.User_Id = $User_Id
        AND $Conta_Id = Contas.Conta_Id";
        $resultContas = $conn->query($sql);

        if (!$resultContas->num_rows > 0) {
            MensFunc("Não tens acesso a esta opetação!");
        } else {

            $sql = "UPDATE Contas SET Nome = '$Nome',
        Valor = '$Valor',
        Mensalidade = '$Mensalidade',
        DataFinal = '$DataFinal',
        Descricao = '$Descricao'
        WHERE Conta_Id = $Conta_Id;";

            if ($conn->query($sql) === TRUE) {
                MensFunc("A Conta foi Salva!", false);
            } else {
                MensFunc("O ocurreu um erro ao Salvar a conta!");
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