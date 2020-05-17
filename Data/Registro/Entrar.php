<?PHP
require "../Conexao.php";
require "../Sessao.php";
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>

<?php
$UserName = isset($_POST["UserName"]) ? $_POST["UserName"] : "Bug";
$PalavraPasse = isset($_POST["PalavraPasse"]) ? $_POST["PalavraPasse"] : "123";

echo "User: " . $UserName;
echo "<br/>";
echo "PP: " . $PalavraPasse;
echo "<br/>";

$sql = "SELECT * FROM Useres WHERE UserName='$UserName';"; // Query
$result = $conn->query($sql);

$resultadoImport = $result->fetch_assoc();
echo "<br/>";

if ($resultadoImport["UserName"]) {
    if (password_verify("$PalavraPasse", $resultadoImport["PalavraPasse"])) {
        $_SESSION["SessaoUserId"] = $resultadoImport["User_Id"];
        echo "Muito bem acabas-te de entrar no site";
        header('Location: ' . "../../Pages/Dashboard/index.php");
    } else {
        echo "Falhas-te na palavra passe";
    }
} else {
    echo "Olha mas tu não existes!!";
}


echo "<br/>";
?>