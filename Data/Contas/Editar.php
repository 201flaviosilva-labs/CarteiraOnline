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
    $User_Id = $_SESSION["SessaoUserId"];
    $Conta_Id =  $_SESSION["SessaoContaId"];
    $Nome =  isset($_GET["Nome"]) ? $_GET["Nome"] : "Null";
    $Valor = $_GET["Valor"];
    $Mensalidade = $_GET["Mensalidade"];
    $DataFinal = $_GET["DataFinal"];
    $Descricao = $_GET["Descricao"];

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

        $sql = "UPDATE Contas SET Nome = '$Nome',
        Valor = '$Valor',
        Mensalidade = '$Mensalidade',
        DataFinal = '$DataFinal',
        Descricao = '$Descricao'
        WHERE Conta_Id = $Conta_Id;";

        if ($conn->query($sql) === TRUE) {
            echo "A Conta foi Editada!";
        } else {
            echo "Deu um erro a editar a conta, tanta mais tarde ou certifica que os dados estão corretos";
            echo "<br>";
            echo "Ou então tenta voltar a fazer login";
        }
    }

    ?>
</body>

</html>