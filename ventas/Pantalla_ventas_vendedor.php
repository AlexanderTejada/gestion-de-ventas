

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include '../menuVendedor.php'; ?>

<div class="main p-3 ms-5">
    <h1>Gestión de Ventas</h1>

    <div class="alert alert-info" role="alert">
    Si la hora de la venta es después de las 16:00, la venta será registrada para el día siguiente.
    </div>

    <!-- Formulario de búsqueda por fecha -->
    <form method="get" action="Pantalla_ventas.php" class="mb-3">
        <div class="input-group">
            <input type="date" class="form-control" name="fecha_busqueda" required>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <!-- Botón para abrir el modal de crear venta -->
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearVentaModal">Registrar Venta</button>
    </div>

    <?php 
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_nombre = "gestion_de_ventas";
    $enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

    if (!$enlace) {
        echo "<div class='alert alert-danger' role='alert'>Error: No se pudo conectar a la base de datos $db_nombre.</div>";
        exit();
    }

    $fecha_busqueda = isset($_GET['fecha_busqueda']) ? $_GET['fecha_busqueda'] : null;
    
    $consulta = "SELECT ventas.*, clientes.nombre AS cliente_nombre, empleados.nombre AS vendedor_nombre, productos.nombre AS producto_nombre
                 FROM ventas
                 JOIN clientes ON ventas.cliente_id = clientes.id
                 JOIN empleados ON ventas.vendedor_id = empleados.id
                 JOIN productos ON ventas.producto_id = productos.id";

    if ($fecha_busqueda) {
        $consulta .= " WHERE ventas.fecha = '$fecha_busqueda'";
    }

    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas, verificar ($consulta).</div>";
        exit();
    }

    echo "<h5 class='cantidadCargados'>Ventas Registradas: " . mysqli_num_rows($resultado) . "</h5>";
    ?>

    <table class="table table-hover">
        <thead class="encabezado">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Monto</th>
                <th scope="col">Cliente</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $row['hora'] . "</td>";
                echo "<td>" . $row['monto'] . "</td>";
                echo "<td>" . $row['cliente_nombre'] . "</td>";
                echo "<td>" . $row['vendedor_nombre'] . "</td>";
                echo "<td>" . $row['producto_nombre'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>";
                // Botones que activan modales
                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editarVentaModal' 
                        data-id='" . $row['id'] . "' 
                        data-fecha='" . $row['fecha'] . "' 
                        data-hora='" . $row['hora'] . "' 
                        data-cliente_id='" . $row['cliente_id'] . "' 
                        data-vendedor_id='" . $row['vendedor_id'] . "' 
                        data-producto_id='" . $row['producto_id'] . "' 
                        data-cantidad='" . $row['cantidad'] . "'>Editar</button> ";
                echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarVentaModal' 
                        data-id='" . $row['id'] . "' 
                        data-fecha='" . $row['fecha'] . "' 
                        data-hora='" . $row['hora'] . "' 
                        data-cliente_nombre='" . $row['cliente_nombre'] . "' 
                        data-vendedor_nombre='" . $row['vendedor_nombre'] . "' 
                        data-producto_nombre='" . $row['producto_nombre'] . "' 
                        data-cantidad='" . $row['cantidad'] . "'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>

<?php include 'modalCrearVenta.php'; ?>
<?php include 'modalEditarVenta.php'; ?>
<?php include 'modalEliminarVenta.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var clienteSelect = document.getElementById('cliente_id');
    var vendedorSelect = document.getElementById('vendedor_id');

    clienteSelect.addEventListener('change', function() {
        var clienteZona = clienteSelect.options[clienteSelect.selectedIndex].getAttribute('data-zona');
        
        for (var i = 0; i < vendedorSelect.options.length; i++) {
            var vendedorZona = vendedorSelect.options[i].getAttribute('data-zona');
            if (vendedorZona === clienteZona) {
                vendedorSelect.options[i].disabled = false;
            } else {
                vendedorSelect.options[i].disabled = true;
            }
        }
    });

    var crearVentaModal = document.getElementById('crearVentaModal');
    crearVentaModal.addEventListener('show.bs.modal', function(event) {
        var now = new Date();
        var formattedDate = now.toISOString().slice(0, 10);
        var formattedTime = now.toTimeString().slice(0, 5);

        crearVentaModal.querySelector('#fecha').value = formattedDate;
        crearVentaModal.querySelector('#hora').value = formattedTime;
    });
});

</script>

</body>
</html>
