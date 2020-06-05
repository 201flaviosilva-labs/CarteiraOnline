<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CarteiraOnline";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ocorreu um erro na ligação á base de dados");
}
echo "<br/>";
