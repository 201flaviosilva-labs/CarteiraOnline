<?php require "../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Conta</title>
</head>

<body>
    <?php
    $User_Id = $_SESSION["SessaoUserId"];
    $Nome =  isset($_GET["Nome"]) ? $_GET["Nome"] : "Null";
    $Balanco = $_GET["Balanco"];
    $Valor = $_GET["Valor"];
    $Mensalidade = $_GET["Mensalidade"];
    $DataFinal = $_GET["DataFinal"];
    $Descricao = $_GET["Descricao"];

    // echo "$User_Id <br>";
    // echo "$Nome <br>";
    // echo "$Balanco <br>";
    // echo "$Valor <br>";
    // echo "$Mensalidade <br>";
    // echo "$DataFinal <br>";
    // echo "$Descricao <br>";

    $sql = "INSERT INTO Contas (User_Id, Nome, Balanco, Valor, Mensalidade, DataFinal, Descricao)
    VALUES ('$User_Id', '$Nome', '$Balanco', '$Valor', '$Mensalidade', '$DataFinal', '$Descricao');";

    if ($conn->query($sql) === TRUE) {
        echo "A Conta foi criada!";
    } else {
        echo "Deu um erro a criar a conta, tanta mais tarde ou certifica que os dados estão corretos";
        echo "<br>";
        echo "Ou então tenta voltar a fazer login";
    }

    ?>
</body>

</html>