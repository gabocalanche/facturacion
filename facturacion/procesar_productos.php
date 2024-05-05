<?php
include '../db.php';

// Consulta para obtener los nombres y precios de los productos
$sql = "SELECT producto, precio FROM productos";
$result = $conn->query($sql);

$productos = array();

if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        // Almacena el nombre y el precio de cada producto como un objeto
        $producto = array(
            "nombre" => $row["producto"],
            "precio" => $row["precio"]
        );
        $productos[] = $producto;
    }
} else {
    echo "0 resultados";
}

$conn->close();

// Convertir el array a formato JSON y devolverlo como respuesta
echo json_encode($productos);
?>
