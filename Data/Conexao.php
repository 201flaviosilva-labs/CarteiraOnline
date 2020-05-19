<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CarteiraOnline";

// Criar conecção
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conecção
if ($conn->connect_error) {
    die("Foi este o problema: " . $conn->connect_error);
}
echo "<br/>";
