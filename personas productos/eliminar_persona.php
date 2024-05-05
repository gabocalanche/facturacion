<?php
include '../db.php';

// Obtener el ID de la persona a eliminar desde la URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    // Eliminar la persona de la base de datos
    $query = "DELETE FROM personas WHERE id='$id'";
    $result = $conn->query($query);

    if ($result) {
        echo "Persona eliminada correctamente.";
    } else {
        echo "Error al eliminar persona: " . $conn->error;
    }
} else {
    echo "ID de persona no proporcionado.";
}

$conn->close();
?>
