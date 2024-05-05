<?php
include '../db.php'; 

// Obtener el número de identidad enviado desde la solicitud GET
$identidad = $_GET["identidad"];

// Consulta SQL para buscar la persona por número de identidad
$sql = "SELECT * FROM personas WHERE dni = '$identidad'";
$result = $conn->query($sql);

// Verificar si se encontró la persona
if ($result->num_rows > 0) {
    // Obtener los datos de la persona y almacenarlos en un array
    $row = $result->fetch_assoc();
    $persona = array(
        "id" => $row["id"],
        "nombre" => $row["nombre"],
        "apellido" => $row["apellido"],
        "direccion" => $row["direccion"],
        "dni" => $row["dni"]
    );

    // Devolver los datos de la persona como JSON
    echo json_encode($persona);
} else {
    // Si no se encuentra la persona, devolver un mensaje de error
    echo json_encode(array("error" => "Persona no encontrada"));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
