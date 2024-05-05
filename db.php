<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "cruds"; // Reemplaza con el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Definir la codificación de caracteres a UTF-8
$conn->set_charset("utf8");
?>
