<?php require "../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Conta</title>
</head>

<body>
    <?php
    $User_Id = $_SESSION["SessaoUserId"];
    $Conta_Id =  $_GET["Conta_Id"];

    // TODO: Fazer aqui uma verificação para ver se o user pode aceder á conta
    // selct user form ...   -> if 1 linha then ....

    $sql = "DELETE FROM Contas WHERE Conta_Id = $Conta_Id;";

    if ($conn->query($sql) === TRUE) {
        echo "A Conta foi Eliminada!";
    } else {
        echo "Deu um erro a elimminar a conta, tanta mais tarde ou certifica que os dados estão corretos";
        echo "<br>";
        echo "Ou então tenta voltar a fazer login";
    }

    ?>
</body>

</html>