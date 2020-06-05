<?php require "../Conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    <title>Editar Conta</title>
</head>

<body>
    <?php
    $User_Id = isset($_SESSION["SessaoUserId"]) ? $_SESSION["SessaoUserId"] : 0;
    $Conta_Id = isset($_SESSION["SessaoContaId"]) ? $_SESSION["SessaoContaId"] : 0;
    $Nome = isset($_GET["Nome"]) ? $_GET["Nome"] : "Nome";
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

    if (isset($Conta_Id) & isset($User_Id) & isset($Nome) & isset($Valor) & isset($Mensalidade) & isset($DataFinal) & isset($Descricao)) {
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
    } else {
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
    <a href="../../Pages/Dashboard/Conta/index.php?Conta_Id=<?php echo $Conta_Id; ?>">Voltar</a>
</body>

</html>