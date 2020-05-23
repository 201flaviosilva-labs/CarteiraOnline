<?php
require "../../Data/Conexao.php";

$UserName = $_SESSION["SessaoUserId"];
$sql = "SELECT Conta_Id, Nome, Balanco, Valor FROM Contas INNER JOIN Useres ON Contas.User_Id = Useres.User_Id WHERE Useres.User_Id = $UserName";
$resultContas = $conn->query($sql);

$resultHistorico = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- DataTables -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../style/reset.css">
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>

<body>
    <header>
        <h1>Dashboard</h1>
    </header>

    <main>
        <form class="d-flex flex-column justify-content-around shadow-lg p-3 mb-5 bg-white rounded" action="../../Data/Contas/Criar.php" method="get">
            <h2>Criar Conta</h2>
            <input type="text" placeholder="Nome da Conta" pattern=".{1,30}" name="Nome" required>
            <input type="number" placeholder="Valor" name="Valor">
            <input type="number" placeholder="Mensalidade" title="Objetivo mensal" name="Mensalidade">
            <input type="date" name="DataFinal" id="DataFinal">
            <textarea placeholder="Descrição" pattern=".{0,500}" name="Descricao">Descrição</textarea>
            <button type="submit" class="btn btn-primary">Criar Conta</button>
        </form>

        <ul class="shadow-lg p-3 mb-5 bg-white rounded">
            <h2>Contas</h2>
            <?php
            if ($resultContas->num_rows > 0) {

                while ($row = $resultContas->fetch_assoc()) { ?>
                    <li><a href="./Conta/Ver.php?Conta_Id=<?php echo $row['Conta_Id']; ?>">

                            <h4> <?php echo $row["Nome"]; ?></h4>
                            <p> <?php echo $row['Balanco'] . "/" . $row['Valor']; ?></p>
                        </a>
                    </li>
            <?php }
            } else {
                echo "<li>Não tens nenhuma conta registrada!</li>";
            }
            ?>
        </ul>

        <div class="container table-responsive">
            <h2>Registros</h2>
            <?php
            if ($resultHistorico->num_rows > 0) { ?>

                <table class="table table-bordered table-striped table-hover table-condensed" cellspacing="0" width="100%" id="TabelaContas">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Conta</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($row = $resultHistorico->fetch_assoc()) { ?>
                            <tr>
                                <!-- <td> <?php echo $row["Nome"]; ?></td>
                                <td class="TabBalanco"> <?php echo $row["Balanco"]; ?></td>
                                <td lass="TabValor"> <?php echo $row["Valor"]; ?></td>
                                <td lass="TabMensalidade"> <?php echo $row["Mensalidade"]; ?></td>
                                <td lass="TabDataFinal"> <?php echo $row["DataFinal"]; ?> </td>
                                <td class="TabDescricao"> <?php echo $row["Descricao"]; ?></td>
                                <td>
                                    <a href="./recebido.php?Musicas_Id=<?php echo $row['Musicas_Id']; ?>" class="btn btn-success">Adicionar</a>
                                    <a href="./recebido.php?Musicas_Id=<?php echo $row['Musicas_Id']; ?>" class="btn btn-info">Alterar</a>
                                    <a href="../Data/Musicas/Apagar.php?Musicas_Id=<?php echo $row['Musicas_Id']; ?>" class="btn btn-danger">Apagar</a>
                                </td> -->
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            <?php } else {
                echo "<p>Não tens nenhum histórico de contas registrada!</p>";
            }
            ?>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/dataTables.bootstrap4.min.js"></script>

    <script src="./scrtipt.js"></script>
</body>

</html>