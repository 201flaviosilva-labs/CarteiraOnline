<?PHP
require "../Conexao.php";
require "../Sessao.php";
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>

<body>
    <?php
    // $UserName =  "user" . rand();
    $UserName =  isset($_POST["UserName"]) ? $_POST["UserName"] : "nop";
    $PalavraPasse = isset($_POST["PalavraPasse"]) ? $_POST["PalavraPasse"] : "123";
    $CodigoRecuperacao = rand();

    // echo "User: " . $UserName;
    // echo "<br/>";
    // echo "PP: " . $PalavraPasse;
    // echo "<br/>";
    $PalavraPasse = password_hash("$PalavraPasse", PASSWORD_DEFAULT);
    echo " Este é o teu código de recuperação, para o caso de te esqueceres da Palavra-Passe: $CodigoRecuperacao";
    $CodigoRecuperacao = password_hash("$CodigoRecuperacao", PASSWORD_DEFAULT);
    echo "<br />";
    // echo "PP Ecriptado: " . $PalavraPasse;
    // echo "<br/>";


    $sqlChek = "SELECT UserName FROM Useres WHERE UserName='$UserName';";
    $result = $conn->query($sqlChek);
    $resultadoImport = $result->fetch_assoc();

    if (!isset($resultadoImport["UserName"])) {
        $sql = "INSERT INTO Useres (UserName, PalavraPasse, CodigoRecuperacao)
    VALUES ('$UserName', '$PalavraPasse', '$CodigoRecuperacao');";

        if ($conn->query($sql) === TRUE) {
            echo "Os dados foram adicionados!";
        } else {
            echo "Olha deu erro nisto ao adicionar osx dados: " . $sql;
        }
    } else {
        echo "Opá já existe um mens com esse nome";
    }

    ?>
</body>

</html>