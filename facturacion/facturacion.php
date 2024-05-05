<?php

include '../db.php';

$sql = "SELECT MAX(id) AS ultimo_id FROM facturas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ultimoId = $row["ultimo_id"];
    $proximoId = $ultimoId + 1;
} else {
    $proximoId = 1;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación de Productos</title>
    <link rel="stylesheet" href="css/facturacion.css">
    <style>
        .eliminar-btn {
            background-color: red;
            color: white;
        }

        .agregar-impuesto-btn {
            font-size: 12px;
        }

        .input-cantidad {
            width: 50px;
        }

        #factura {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: white;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<button type="button" class="btn btn-primary" onclick="window.location.href='../index.php'" style="margin-top: 20px; margin-left: 20px;">
    <i class="fa-solid fa-chevron-left"></i> Regresar al Menú
</button>

<button type="button" class="btn btn-success" onclick="window.location.href='ver_facturas.php'" style="background-color: #2FC84C;">
        Ver Facturas <i class="fa-solid fa-calculator"></i>
    </button>



<h1>Facturación de Productos</h1>
<div class="container">
    <div class="fecha-numero-factura" style="display: flex; justify-content: center;">
        <div class="col-md-6" style="display: flex; align-items: center;">
            <label for="numeroFactura" style="margin-right: 10px; width: 100px;">Nro. Factura:</label>
            <input type="text" id="numeroFactura" name="numeroFactura" style="width: 150px; text-align: center;" value="00<?php echo $proximoId; ?>" readonly>
        </div>
        <div class="col-md-6" style="display: flex; align-items: center; margin-left: 20px;">
            <label for="fechaEmision" style="margin-right: 10px;">Fecha:</label>
            <input type="text" id="fecha" name="fecha" style="width: 150px; text-align: center;" readonly>
        </div>
    </div>

    <div class="cliente-factura" style="display: flex; justify-content: space-between;">
        <div style="flex: 0 1 30%; col-3;">
            <label for="identidad" style="display: block;">No Identidad:</label>
            <div style="display: flex;">
                <input type="text" id="identidad" name="identidad" style="width: 70%;">
                <button type="button" id="botonBuscarPersona" style="width: 40px; height: 40px; padding: 10px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <div style="flex: 0 1 30%;">
            <label for="nombreCliente">Nombre del Cliente:</label>
            <input type="text" id="nombreCliente" name="nombreCliente" readonly>
        </div>
        <div style="flex: 0 1 30%;">
            <label for="direccionCliente">Dirección del Cliente:</label>
            <input type="text" id="direccionCliente" name="direccionCliente" readonly>
        </div>
    </div>
</div>

<script>
function buscarPersona() {
    var identidad = document.getElementById("identidad").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "buscar_persona.php?identidad=" + identidad, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var persona = JSON.parse(xhr.responseText);
            if (persona && persona.nombre) {
                document.getElementById("nombreCliente").value = persona.nombre + "" + persona.apellido;
                document.getElementById("direccionCliente").value = persona.direccion;
            } else {
                document.getElementById("nombreCliente").value = "No hay registros";
                document.getElementById("direccionCliente").value = "No hay registros";
            }
        }
    };
    xhr.send();
}

document.getElementById("botonBuscarPersona").addEventListener("click", buscarPersona);
</script>

<div class="container">
    <table id="tablaArticulos">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
                <th style="padding-left: 25px;">Impuesto 16%</th>
                <th>Total</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="row" style="display: flex; justify-content: space-between;">
        <div>
            <button type="button" id="agregarArticulo"><i class="fa-solid fa-plus"></i> Añadir artículo</button>
        </div> 
        <div>
            <button type="button" id="guardarFactura" style="background-color: #2FC84C;">Guardar Factura</button>
        </div>
    </div>

    <div id="factura" style="text-align: right;">
        <div>
            <p>Subtotal: <span id="subtotalFactura">$0.00</span></p>
            <p>Impuesto: <span id="impuestoFactura">$0.00</span></p>
            <p><strong>Total: </strong> <span id="totalFactura">$0.00</span></p>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/9230d479f2.js" crossorigin="anonymous"></script>
<script src="script.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var eliminarBotones = document.querySelectorAll(".eliminar-btn");
        eliminarBotones.forEach(function(boton) {
            boton.addEventListener("click", function() {
                var fila = this.closest("tr");
                fila.parentNode.removeChild(fila);
                calcularTotalesFactura();
            });
        });
    });
</script>


<script>
function calcularTotalesFactura() {
    var subtotalFactura = 0;
    var impuestoFactura = 0;
    var totalFactura = 0;

    var table = document.getElementById("tablaArticulos");
    var rows = table.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            var subtotal = parseFloat(cells[3].textContent.replace("$", ""));
            var impuesto = parseFloat(cells[4].dataset.impuesto || 0);
            var total = parseFloat(cells[5].textContent.replace("$", ""));

            subtotalFactura += subtotal;
            impuestoFactura += impuesto;
            totalFactura += total;
        }
    }

    document.getElementById("subtotalFactura").textContent = "$" + subtotalFactura.toFixed(2);
    document.getElementById("impuestoFactura").textContent = "$" + impuestoFactura.toFixed(2);
    document.getElementById("totalFactura").textContent = "$" + totalFactura.toFixed(2);
}

function agregarImpuesto(btn) {
    var row = btn.closest("tr");
    var subtotal = parseFloat(row.cells[3].textContent.replace("$", ""));
    var totalCell = row.cells[5];
    
    var impuesto = subtotal * 0.16;
    var total = parseFloat(totalCell.textContent.replace("$", ""));
    total += impuesto;
    totalCell.textContent = "$" + total.toFixed(2);

    row.cells[4].dataset.impuesto = impuesto;

    btn.textContent = "Impuesto Agregado";
    btn.disabled = true;

    calcularTotalesFactura();
}

function agregarEliminarEventListeners() {
    var eliminarBotones = document.querySelectorAll(".eliminar-btn");
    eliminarBotones.forEach(function(boton) {
        boton.addEventListener("click", function() {
            var fila = this.closest("tr");
            fila.parentNode.removeChild(fila);
            calcularTotalesFactura();
        });
    });
}

document.getElementById("agregarArticulo").addEventListener("click", function() {
    var table = document.getElementById("tablaArticulos").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.rows.length);

    var cellProducto = newRow.insertCell(0);
    var cellCantidad = newRow.insertCell(1);
    var cellPrecioUnitario = newRow.insertCell(2);
    var cellSubtotal = newRow.insertCell(3);
    var cellImpuesto = newRow.insertCell(4);
    var cellTotal = newRow.insertCell(5);
    var cellEliminar = newRow.insertCell(6);

    var selectProducto = document.createElement("select");

    var optionEmpty = document.createElement("option");
    optionEmpty.text = "Seleccionar";
    selectProducto.add(optionEmpty);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var productos = JSON.parse(this.responseText);

            productos.forEach(function(producto) {
                var option = document.createElement("option");
                option.text = producto.nombre;
                option.setAttribute("data-precio", producto.precio);
                selectProducto.add(option);
            });

            calcularSubtotal();
        }
    };
    xhr.open("GET", "procesar_productos.php", true);
    xhr.send();

    selectProducto.addEventListener("change", function() {
        var precioUnitario = parseFloat(this.options[this.selectedIndex].getAttribute("data-precio"));
        cellPrecioUnitario.innerHTML = "$" + precioUnitario.toFixed(2);
        calcularSubtotal();
    });

    function calcularSubtotal() {
        var precioUnitario = parseFloat(selectProducto.options[selectProducto.selectedIndex].getAttribute("data-precio"));
        var cantidad = parseInt(cellCantidad.querySelector("input").value) || 1;
        
        if (!isNaN(precioUnitario) && !isNaN(cantidad)) {
            var subtotal = precioUnitario * cantidad;
            cellSubtotal.innerHTML = "$" + subtotal.toFixed(2);
            calcularTotal(subtotal);
        } else {
            cellSubtotal.innerHTML = "$0.00";
            cellTotal.innerHTML = "$0.00";
        }
    }

    function calcularTotal(subtotal) {
        var total = subtotal;

        if (cellImpuesto.dataset.impuesto) {
            var impuesto = parseFloat(cellImpuesto.dataset.impuesto);
            total += impuesto;
        }

        cellTotal.innerHTML = "$" + total.toFixed(2);

        calcularTotalesFactura();
    }

    var inputCantidad = document.createElement("input");
    inputCantidad.type = "number";
    inputCantidad.min = 1;
    inputCantidad.className = "input-cantidad";
    inputCantidad.addEventListener("input", calcularSubtotal);
    cellCantidad.appendChild(inputCantidad);

    cellProducto.appendChild(selectProducto);
    cellSubtotal.innerHTML = "$0.00";
    cellImpuesto.innerHTML = "<button type='button' class='agregar-impuesto-btn' onclick='agregarImpuesto(this)'>Agregar Impuesto</button>";
    cellTotal.innerHTML = "$0.00";
    cellEliminar.innerHTML = "<button type='button' class='eliminar-btn'><i class='fa-solid fa-xmark'></i></button>";

  
    agregarEliminarEventListeners();
});


agregarEliminarEventListeners();

calcularTotalesFactura();
</script>



<script>
var fechaActual = new Date();

var dia = String(fechaActual.getDate()).padStart(2, '0');
var mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
var año = fechaActual.getFullYear();
var fechaFormateada = año + '-' + mes + '-' + dia;

document.getElementById('fecha').value = fechaFormateada;

function validarFactura() {
    var nombreCliente = document.getElementById("nombreCliente").value;
    var direccionCliente = document.getElementById("direccionCliente").value;

    if (nombreCliente === "" || nombreCliente === "No hay registros" || direccionCliente === "" || direccionCliente === "No hay registros") {
        alert("Por favor, ingresa un nombre y dirección válidos.");
    } else {
        guardarFactura();
    }
}

function guardarFactura() {
    var numeroFactura = document.getElementById("numeroFactura").value;
    var fecha = document.getElementById("fecha").value;
    var identidad = document.getElementById("identidad").value;
    var nombreCliente = document.getElementById("nombreCliente").value;
    var direccionCliente = document.getElementById("direccionCliente").value;

    var articulos = [];
    var table = document.getElementById("tablaArticulos");
    var rows = table.getElementsByTagName('tr');
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var cantidad = parseInt(cells[1].innerText);
        var subtotal = parseFloat(cells[3].innerText.replace("$", ""));
        var impuesto = parseFloat(cells[4].dataset.impuesto || 0);
        var total = parseFloat(cells[5].innerText.replace("$", ""));
        articulos.push({
            cantidad: cantidad,
            subtotal: subtotal,
            impuesto: impuesto,
            total: total
        });
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesar_factura.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert("Factura guardada correctamente.");
        }
    };
    xhr.send(JSON.stringify({
        numeroFactura: numeroFactura,
        fecha: fecha,
        identidad: identidad,
        nombreCliente: nombreCliente,
        direccionCliente: direccionCliente,
        articulos: articulos
    }));
}

document.getElementById("guardarFactura").addEventListener("click", validarFactura);
</script>


</body>
</html>
