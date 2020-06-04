<?php require "../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    <title>Criar Conta</title>
</head>

<body>
    <?php
        $User_Id = isset($_SESSION["SessaoUserId"]) ? $_SESSION["SessaoUserId"] : 0;
        $Nome = isset($_GET["Nome"])? $_GET["Nome"] : "Nome";
        $Valor = isset($_GET["Valor"]) ? $_GET["Valor"] : 0;
        $Mensalidade = isset($_GET["Mensalidade"]) ? $_GET["Mensalidade"] : 0;
        $DataFinal = isset($_GET["DataFinal"]) ? $_GET["DataFinal"] : date("Y-m-d");
        $Descricao = isset($_GET["Descricao"]) ? $_GET["Descricao"] : "";

        echo "<div>";
        echo "<p>Nome: $Nome;</p>";
        echo "<p>Valor: $Valor;</p>";
        echo "<p>Mensalidade: $Mensalidade;</p>";
        echo "<p>Data Final: $DataFinal;</p>";
        echo "<p>Descrição: $Descricao:</p>";
        echo "</div>";

        if (isset($User_Id) & isset($Nome) & isset($Valor) & isset($Mensalidade) & isset($DataFinal)& isset($Descricao)) {
            $sql = "INSERT INTO Contas (User_Id, Nome, Valor, Mensalidade, DataFinal, Descricao)
                VALUES ('$User_Id', '$Nome', '$Valor', '$Mensalidade', '$DataFinal', '$Descricao');";

            if ($conn->query($sql) === TRUE) {
                MensFunc("A Conta foi criada!", false);
            } else {
                MensFunc("Erro ao criar a conta!");
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