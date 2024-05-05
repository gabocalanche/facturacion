<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar-persona-form"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $direccion = $_POST["direccion"];

    // Actualizar la persona en la base de datos
    $sql = "UPDATE personas SET nombre='$nombre', apellido='$apellido', dni='$dni', direccion='$direccion' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página principal con un parámetro indicando éxito
        header('Location: añadir.php?success=1');
        exit();
    } else {
        // Redirigir a la página principal con un parámetro indicando error
        header('Location: añadir.php?error=1');
        exit();
    }
} else {
    // Redirigir a la página principal si no se recibieron datos del formulario
    header('Location: añadir.php');
    exit();
}

$conn->close();
?>
