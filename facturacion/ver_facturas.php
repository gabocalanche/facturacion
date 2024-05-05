<?php
include '../db.php';

// Consulta para obtener todos los registros de la tabla facturas
$sql = "SELECT * FROM facturas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/facturacion.css">
    <title>Facturas</title>
</head>
<body> 
    




    <button type="button" class="btn btn-primary" onclick="window.location.href='facturacion.php'" style="margin-top: 20px; margin-left: 20px;">
        <i class="fa-solid fa-chevron-left"></i> Regresar
    </button>



<div class="container">
        <div class="crud" id="persona-crud">

            <!-- Lista de Facturas -->
            <h2>Listado de Facturas:</h2>
            <br>
            <table>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Subtotal</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th style="text-align: center;">Fecha</th>
                </tr>
                <?php
                // Verificar si hay registros
                if (mysqli_num_rows($result) > 0) {
                    // Iterar sobre cada fila de resultados
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Mostrar cada registro como una fila de la tabla
                        echo '<tr>';
                        echo '<td>' . "00" . $row['id'] . '</td>';
                        echo '<td>' . $row['nombreCliente'] . '</td>';
                        echo '<td>' . $row['direccionCliente'] . '</td>';
                        echo '<td>' . $row['subtotalFactura'] . "$" . '</td>';
                        echo '<td>' . $row['impuestoFactura'] . "$" . '</td>';
                        echo '<td>' . $row['totalFactura'] . "$" . '</td>';
                        echo '<td>' . $row['fechaFactura'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    // Si no hay registros
                    echo '<tr><td colspan="7">No hay facturas registradas.</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/9230d479f2.js" crossorigin="anonymous"></script>
    <script src="js/formulario.js"></script>
</body>
</html>
