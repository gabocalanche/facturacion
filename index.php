<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Tienda de Productos</title>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    /* Estilos para los botones */
    .custom-btn {
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        text-decoration: none !important;
        color: inherit;
        font-size: 15px; /* Ajusta el tamaño del texto según tus preferencias */
        padding: 4px 8px; /* Ajusta el espaciado interno del botón según tus preferencias */
        margin-right: 5px; /* Ajusta el margen derecho del botón según tus preferencias */
    }

    /* Estilos adicionales al pasar el cursor sobre los botones */
    .custom-btn:hover {
        transform: scale(1.05);
    }

    .custom-link {
        text-decoration: none !important;
        color: fff;
    }

    .custom-link:hover {
        text-decoration: none !important;
        color: inherit;
    }
    .zoom-animation {
        transition: transform 0.3s ease-in-out;
    }

    .zoom-animation:hover {
        transform: scale(1.05);
    }
    .btn-outline-primary {
    border-width: 2px; 
    border-style: solid; 
    border-color: #D7D9DC; /* color del borde según tus necesidades */
    }

    .btn-outline-primary:hover {
    background-color: rgba(255, 255, 255, 0.5); /* Cambia el color de fondo al pasar el cursor por encima */
}

    /* Estilo para los botones de grados con sombra */
    .custom-link.btn-outline-primary.custom-btn {
        color: #000000; 
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.2); 
    }

    /* Estilo para cambiar el color del texto a blanco al pasar el ratón */
    .custom-link.btn-outline-primary.custom-btn:hover {
        color: #000000; 
    }

    /* Estilos para el título */
    h2 {
        text-align: center; /* Centra el texto */
        margin-top: 20px; /* Ajusta el margen superior según tus preferencias */
    }

    /* Estilo para el h5 */
    h5.footer {
        text-align: center;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        margin: 0;
        padding: 10px 0;
        background-color: #f8f9fc; /* Color de fondo según tus preferencias */
        z-index: 1000; /* Ajusta el índice z según tus necesidades */
    }
    </style>

</head>

<body>

<div class="container-fluid">
    <br>
    <br>
    <h2>Tienda de Productos</h2>
    <br>
    <br>

    <div class="row justify-content-center"> <!-- Centra los botones -->
        <!-- Botón para CRUD de personas y productos -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="personas productos/añadir.php" class="card border-left-primary shadow h-100 py-2 custom-link zoom-animation">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 custom-link">
                                Registro de Personas y Productos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                CRUDS
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Botón para facturación -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="facturacion/facturacion.php" class="card border-left-primary shadow h-100 py-2 custom-link zoom-animation">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 custom-link">
                                Realizar Facturas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Facturación
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<h5 class="footer">Jesus Torrealba - 29.889.261  /  Gabriel Colmenarez - 30.767.068  /  Sergio Rodriguez - 30. 667.980</h5>

</body>
</html>
