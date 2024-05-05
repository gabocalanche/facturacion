<?php
include '../db.php';

// Obtener el código del producto a editar desde la URL
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;

if ($codigo !== null) {
    // Consultar la información del producto
    $query = "SELECT * FROM productos WHERE codigo='$codigo'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $datos = $result->fetch_assoc();
        $producto = $datos['producto'];
        $precio = $datos['precio'];
        $cantidad = $datos['cantidad'];
    } else {
        echo "Código no encontrado.";
        exit();
    }
} else {
    echo "Código no proporcionado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Editar Producto</title>
</head>
<body>
    <div class="container">
        <div class="crud" id="editar-producto-crud">
            <h2>Editar Producto</h2>
            <!-- Formulario de Edición de Producto con Validaciones -->
            <form id="editar-producto-form" method="post" action="actualizar_producto.php">
                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                <label for="producto">Producto:</label>
                <input type="text" id="producto" name="producto" value="<?php echo $producto ?? ''; ?>" required>
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" min="0" step="0.01" value="<?php echo $precio ?? ''; ?>" required>
                
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" min="0" value="<?php echo $cantidad ?? ''; ?>" required>
                
                <button type="submit" name="editar-producto-form">Actualizar Producto</button>
            </form>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
