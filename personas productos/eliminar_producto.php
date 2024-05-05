<?php
include '../db.php';

// Obtener el código del producto a eliminar desde la URL
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;

if ($codigo !== null) {
    // Eliminar el producto de la base de datos
    $query = "DELETE FROM productos WHERE codigo='$codigo'";
    $result = $conn->query($query);

    if ($result) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar producto: " . $conn->error;
    }
} else {
    echo "Código de producto no proporcionado.";
}

$conn->close();
?>
