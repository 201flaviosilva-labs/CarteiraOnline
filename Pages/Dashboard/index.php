<?php
require "../../Data/Conexao.php";
try {
    if (isset($_SESSION["SessaoUserId"])) {
        $User_Id = $_SESSION["SessaoUserId"];

        $sqlUser = "SELECT UserName
            FROM Useres
            WHERE User_Id = $User_Id";
        $resultUser = $conn->query($sqlUser);
        $linhaUser = $resultUser->fetch_assoc();


        $sql = "SELECT Conta_Id, Nome, Balanco, Valor
            FROM Contas
            INNER JOIN Useres
            ON Contas.User_Id = Useres.User_Id
            WHERE Useres.User_Id = $User_Id";
        $resultContas = $conn->query($sql);


        $sqlRegistro = "SELECT `ContaNome`, `Nome`,`Montante`,`Data`
                    FROM Registros
                    WHERE `User_Id` = $User_Id";
        $resultRegistros = $conn->query($sqlRegistro);
    }
} catch (\Throwable $th) {
    echo "<h2> Erro!! </h2>";
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../style/reset.css">
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>

<body>
    <header>
        <h1 class="w-100 text-center align-middle">Dashboard</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="../../index.html">Carteira Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="../../index.html">Home</a>
                    <a class="nav-item nav-link active" href="#">Dashboard</a>
                </div>
                <div class="navbar-nav">
                    <?php if (isset($linhaUser["UserName"])) { ?>
                        <a class="nav-item nav-link" href="../../Data/Registro/Sair.php">
                            <?php echo $linhaUser["UserName"]; ?> (Sair)
                        </a>
                    <?php } else { ?>
                        <a class="nav-item nav-link" href="../LogIn_Registro/index.php">
                            Entrar/Registrar
                        </a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>

    <?php
    if (isset($User_Id) > 0) { ?>
        <main>
            <form class="d-flex flex-column justify-content-around shadow-lg p-3 mb-5 bg-white rounded" action="../../Data/Contas/Criar.php" method="get">
                <h2>Criar Conta</h2>
                <input type="text" placeholder="Nome da Conta" pattern=".{1,30}" name="Nome" required>
                <input type="number" placeholder="Valor" title="Valor do Objetivo" value="0" name="Valor">
                <input type="number" placeholder="Mensalidade" title="Objetivo mensal" value="0" name="Mensalidade">
                <input type="date" name="DataFinal" id="DataFinal">
                <textarea placeholder="Descrição" pattern=".{0,500}" name="Descricao">Descrição</textarea>
                <button type="submit" class="btn btn-primary">Criar Conta</button>
            </form>

            <ul class="shadow-lg p-3 mb-5 bg-white rounded">
                <h2>Contas</h2>
                <?php
                if ($resultContas->num_rows > 0) {

                    while ($row = $resultContas->fetch_assoc()) { ?>
                        <li><a href="./Conta/index.php?Conta_Id=<?php echo $row['Conta_Id']; ?>">

                                <h4> <?php echo $row["Nome"]; ?></h4>
                                <p> <?php echo $row["Balanco"] . "/" . $row["Valor"]; ?></p>
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
                if ($resultRegistros->num_rows > 0) { ?>

                    <table class="table table-bordered table-striped table-hover table-condensed" cellspacing="0" width="100%" id="TabelaContas">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Conta</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ($row = $resultRegistros->fetch_assoc()) { ?>
                                <tr>
                                    <td> <?php echo $row["ContaNome"]; ?></td>
                                    <td> <?php echo $row["Nome"]; ?></td>
                                    <td> <?php echo $row["Montante"]; ?></td>
                                    <td> <?php echo $row["Data"]; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                <?php } else {
                    echo "<p>Não tens nenhum registro nas contas!</p>";
                } ?>
            </div>
        </main>
    <?php } else {
        echo "<h2>Tens de iniciar sessão! <br> Ou Então aconteceu um erro!</h2>";
        echo "<a href='../../../index.html'>Home</a>";
    }
    ?>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/dataTables.bootstrap4.min.js"></script>

    <script src="./scrtipt.js"></script>
</body>

</html>