<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar-producto-form"])) {
    $codigo = $_POST["codigo"];
    $producto = $_POST["producto"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];

    $sql = "UPDATE productos SET producto='$producto', precio=$precio, cantidad=$cantidad WHERE codigo='$codigo'";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página principal con un parámetro indicando éxito
        header('Location: añadir.php?success=1');
        exit();
    } else {
        $response = ["message" => "Error al actualizar producto: " . $conn->error];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = ["message" => "No se recibieron datos del formulario de producto."];
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
