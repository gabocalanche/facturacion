<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["persona-form"])) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $dni = $_POST["dni"];
        $direccion = $_POST["direccion"];

        $sql = "INSERT INTO personas (nombre, apellido, dni, direccion)
                VALUES ('$nombre', '$apellido', '$dni', '$direccion')";

        if ($conn->query($sql) === TRUE) {
            // Redirigir a la página principal con un parámetro indicando éxito
            header('Location: añadir.php?success=1');
            exit();
        } else {
            $response = ["message" => "Error al agregar persona: " . $conn->error];
        }
    } elseif (isset($_POST["producto-form"])) {
        $codigo = $_POST["codigo"];
        $producto = $_POST["producto"];
        $precio = $_POST["precio"];
        $cantidad = $_POST["cantidad"];

        $sql = "INSERT INTO productos (codigo, producto, precio, cantidad)
                VALUES ('$codigo', '$producto', $precio, $cantidad)";

        if ($conn->query($sql) === TRUE) {
            $response = ["message" => "Producto agregado correctamente."];
        } else {
            $response = ["message" => "Error al agregar producto: " . $conn->error];
        }
    } else {
        $response = ["message" => "Formulario no reconocido."];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = ["message" => "No se recibieron datos del formulario."];
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
