<?php
// Verificar si se recibieron los datos de la factura
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos de la factura del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

include '../db.php';

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar y ejecutar la consulta para insertar la factura en la tabla
    $stmt = $conn->prepare("INSERT INTO facturas (nombreCliente, direccionCliente, subtotalFactura, impuestoFactura, totalFactura, fechaFactura) VALUES (?, ?, ?, ?, ?, ?)");

    // Vincular los parámetros de la consulta
    $stmt->bind_param("ssddds", $nombreCliente, $direccionCliente, $subtotalFactura, $impuestoFactura, $totalFactura, $fechaFactura);

    // Obtener los datos de la factura
    $nombreCliente = $data['nombreCliente'];
    $direccionCliente = $data['direccionCliente'];
    $subtotalFactura = 0;
    $impuestoFactura = 0;
    $totalFactura = 0;
    $fechaFactura = $data['fecha'];

    // Iterar sobre los productos de la factura y sumar los totales
    foreach ($data['articulos'] as $articulo) {
        $subtotalFactura += $articulo['subtotal'];
        $impuestoFactura += $articulo['impuesto'];
        $totalFactura += $articulo['total'];
    }

    // Ejecutar la consulta
    $stmt->execute();

    // Cerrar la conexión y liberar los recursos
    $stmt->close();
    $conn->close();

    // Devolver una respuesta exitosa
    echo json_encode(array("message" => "Factura guardada correctamente."));
} else {
    // Devolver un mensaje de error si la solicitud no es POST
    echo json_encode(array("message" => "Error: se esperaba una solicitud POST."));
}
?>