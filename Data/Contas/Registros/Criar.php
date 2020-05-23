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
    $User_Id = $_SESSION["SessaoUserId"];
    $Conta_Id = $_SESSION["SessaoContaId"];
    $Nome =  $_GET["Nome"];
    $Montante =  $_GET["Montante"];
    $Data =  isset($_GET["Data"]) ? $_GET["Data"] : date("Y/m/d");

    // echo "$User_Id <br>";
    // echo "$Conta_Id <br>";
    // echo "$Nome <br>";
    // echo "$Montante <br>";
    // echo "$Data <br>";


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

        $sql = "INSERT INTO Registros (User_Id, Conta_Id, Nome, Montante, Data)
    VALUES ('$User_Id', '$Conta_Id', '$Nome', '$Montante', '$Data');";

        if ($conn->query($sql) === TRUE) {
            echo "A Registro foi criada na conta!";
        } else {
            echo "Deu um erro a criar a conta, tanta mais tarde ou certifica que os dados estão corretos";
            echo "<br>";
            echo "Ou então tenta voltar a fazer login";
        }
    }

    ?>
</body>

</html>