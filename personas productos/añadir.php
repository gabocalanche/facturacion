<?php
include '../db.php';

// Obtener lista de personas
$personasQuery = "SELECT * FROM personas";
$personasResult = $conn->query($personasQuery);
$personas = $personasResult->fetch_all(MYSQLI_ASSOC);

// Obtener lista de productos
$productosQuery = "SELECT * FROM productos";
$productosResult = $conn->query($productosQuery);
$productos = $productosResult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>CRUD de Personas y Productos</title>
</head>
<body> 
    


<div class="container">

    <button type="button" class="btn btn-primary" onclick="window.location.href='../index.php'">
        <i class="fa-solid fa-chevron-left"></i> Regresar al Menú
    </button>

</div>

<div class="container">
        <div class="crud" id="persona-crud">
            <h2>CRUD de Personas</h2>
            <!-- Formulario de Personas con Validaciones -->
            <form id="persona-form" method="post" action="guardar_persona.php">
                <!-- Grupo para el nombre -->
                <div class="formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="formulario__label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="formulario__input" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">El nombre solo puede contener letras y espacios.</p>
                </div>

                <!-- Grupo para el apellido -->
                <div class="formulario__grupo" id="grupo__apellido">
                    <label for="apellido" class="formulario__label">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" class="formulario__input" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">El apellido solo puede contener letras y espacios.</p>
                </div>

                <!-- Grupo para el DNI -->
                <div class="formulario__grupo" id="grupo__dni">
                    <label for="dni" class="formulario__label">DNI:</label>
                    <input type="text" id="dni" name="dni" class="formulario__input" pattern="[0-9]{8}" title="El DNI debe tener 8 dígitos" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">El DNI debe tener 8 dígitos numéricos.</p>
                </div>

                <!-- Grupo para la direccion -->
                <div class="formulario__grupo" id="grupo__direccion">
                    <label for="direccion" class="formulario__label">Direccion:</label>
                    <input type="text" id="direccion" name="direccion" class="formulario__input" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">direccion invalida.</p>
                </div>

                <button type="submit" name="persona-form">Agregar Persona</button>
            </form>

            <!-- Lista de Personas -->
            <h3>Listado de Personas:</h3>
            <ul>
                <?php foreach ($personas as $persona) : ?>
                    <li><?php echo $persona['nombre'] . ' ' . $persona['apellido'] . ' - DNI: ' . $persona['dni']; ?>
                        <a href="editar_persona.php?id=<?php echo $persona['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="eliminar_persona.php?id=<?php echo $persona['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="crud" id="producto-crud">
            <h2>CRUD de Productos</h2>
            <!-- Formulario de Productos con Validaciones -->
            <form id="producto-form" method="post" action="guardar_producto.php">
                <!-- Grupo para el código -->
                <div class="formulario__grupo" id="grupo__codigo">
                    <label for="codigo" class="formulario__label">Código:</label>
                    <input type="text" id="codigo" name="codigo" class="formulario__input" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">Ingrese un código válido.</p>
                </div>

                <!-- Grupo para el producto -->
                <div class="formulario__grupo" id="grupo__producto">
                    <label for="producto" class="formulario__label">Producto:</label>
                    <input type="text" id="producto" name="producto" class="formulario__input" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">Ingrese un nombre de producto válido.</p>
                </div>

                <!-- Grupo para el precio -->
                <div class="formulario__grupo" id="grupo__precio">
                    <label for="precio" class="formulario__label">Precio:</label>
                    <input type="number" id="precio" name="precio" class="formulario__input" min="0" step="0.01" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">Ingrese un precio válido.</p>
                </div>

                <!-- Grupo para la cantidad -->
                <div class="formulario__grupo" id="grupo__cantidad">
                    <label for="cantidad" class="formulario__label">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" class="formulario__input" min="0" required>
                    <i class="formulario__validacion-icono"></i>
                    <p class="formulario__input-error">Ingrese una cantidad válida.</p>
                </div>

                <button type="submit" name="producto-form">Agregar Producto</button>
            </form>

            <!-- Lista de Productos -->
            <h3>Listado de Productos:</h3>
            <ul>
                <?php foreach ($productos as $producto) : ?>
                    <li><?php echo $producto['producto'] . ' - Precio: $' . $producto['precio']; ?>
                        <a href="editar_producto.php?codigo=<?php echo $producto['codigo']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="eliminar_producto.php?codigo=<?php echo $producto['codigo']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/9230d479f2.js" crossorigin="anonymous"></script>
    <script src="js/formulario.js"></script>
</body>
</html>
