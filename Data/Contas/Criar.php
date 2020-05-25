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
    $Valor = $_GET["Valor"];
    $Mensalidade = $_GET["Mensalidade"];
    $DataFinal = $_GET["DataFinal"];
    $Descricao = $_GET["Descricao"];

    $sql = "INSERT INTO Contas (User_Id, Nome, Valor, Mensalidade, DataFinal, Descricao)
            VALUES ('$User_Id', '$Nome', '$Valor', '$Mensalidade', '$DataFinal', '$Descricao');";

    if ($conn->query($sql) === TRUE) {
        MensFunc("A Conta foi criada!", $IsErro = false);
        echo "<button onclick='window.history.back()'>Voltar</button>";
    } else {
        MensFunc("Erro ao criar a conta!");
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