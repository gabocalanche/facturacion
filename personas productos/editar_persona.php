<?php
include '../db.php';

// Obtener el ID de la persona a editar desde la URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    // Consultar la información de la persona
    $query = "SELECT * FROM personas WHERE id='$id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $datos = $result->fetch_assoc();
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $dni = $datos['dni'];
        $direccion = $datos['direccion'];
    } else {
        echo "ID no encontrado.";
        exit();
    }
} else {
    echo "ID no proporcionado.";
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
    <title>Editar Persona</title>
</head>
<body>
    <div class="container">
        <div class="crud" id="editar-persona-crud">
            <h2>Editar Persona</h2>
            <!-- Formulario de Edición de Persona con Validaciones -->
            <form id="editar-persona-form" method="post" action="actualizar_persona.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?? ''; ?>" required>
                
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido ?? ''; ?>" required>
                
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" pattern="[0-9]{8}" title="El DNI debe tener 8 dígitos" value="<?php echo $dni ?? ''; ?>" required>
                
                <label for="direccion">direccion:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion ?? ''; ?>" required>
                
                <button type="submit" name="editar-persona-form">Actualizar Persona</button>
            </form>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
