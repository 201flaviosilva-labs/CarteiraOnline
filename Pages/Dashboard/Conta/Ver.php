<?php
require "../../../Data/Conexao.php";
$Conta_Id = isset($_GET["Conta_Id"]) ? $_GET["Conta_Id"] : "1";
$UserName = $_SESSION["SessaoUserId"];

$sql = "SELECT * FROM Contas INNER JOIN Useres ON Contas.User_Id = Useres.User_Id WHERE Useres.User_Id = $UserName AND $Conta_Id = Contas.Conta_Id";
$resultContas = $conn->query($sql);
$numLinhasContas = $resultContas->num_rows;
$linha = $resultContas->fetch_assoc();

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

    <link rel="stylesheet" href="../../../style/reset.css">
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <title>Carteira Online</title>
</head>

<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <main>
        <?php if ($numLinhasContas > 0) { ?>
            <h2>
                <a href="../../../Data/Contas/Historico/Adicionar.php">
                    <button class="btn btn-success">
                        <i>
                            <img src="../../../Assets/Icons/plus.svg" alt="Adicionar">
                        </i>
                    </button>
                </a>
                <span>Editar</span>
                <a href="../../../Data/Contas/Eliminar.php?Conta_Id=<?php echo $Conta_Id; ?>"> <button class="btn btn-danger">
                        <i>
                            <img src="../../../Assets/Icons/trash.svg" alt="Eliminar">
                        </i>
                    </button>
                </a>
            </h2>
            <form class="shadow-lg p-3 mb-5 bg-white rounded" action="../../../Data/Contas/Editar.php" method="get">
                <input type="text" placeholder="Nome da Conta" pattern=".{1,30}" name="Nome" value="<?php echo $linha["Nome"]; ?>" required>
                <input type="number" placeholder="Balanço Atual" name="Balanco" value="<?php echo $linha["Balanco"]; ?>">
                <input type="number" placeholder="Valor" name="Valor" value="<?php echo $linha["Valor"]; ?>">
                <input type="number" placeholder="Mensalidade" title="Objetivo mensal" name="Mensalidade" value="<?php echo $linha["Mensalidade"]; ?>">
                <textarea placeholder="Descrição" pattern=".{0,500}" name="Descricao" value="<?php echo $linha["Descricao"]; ?>">Descrição</textarea>
                <input type="date" placeholder="Data Final" name="DataFinal" id="DataFinal" value="<?php echo $linha["DataFinal"]; ?>">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>

            <div class="container table-responsive">
                <h2>Histórico</h2>
                <table class="table table-bordered table-striped table-hover table-condensed" cellspacing="0" width="100%" id="TabelaContas">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($row = $resultHistorico->fetch_assoc()) { ?>
                            <tr>
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

            <?php
        } else {
            echo "<h2>Não tens acesso a esta conta!! <i>🚷</i></h2>";
        }
            ?>
            </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#TabelaContas").DataTable();
        });
    </script>
</body>

</html>