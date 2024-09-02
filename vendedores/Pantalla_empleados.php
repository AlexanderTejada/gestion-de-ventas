

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vendedores</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include '../menu.php'; ?>

<div class="main p-3 ms-5">
    <h1>Gestión de Vendedores</h1>

    <!-- Botón para abrir el modal de crear vendedor -->
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearEmpleadoModal">Crear Vendedor</button>
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

    $consulta = "
        SELECT empleados.id, empleados.nombre, empleados.dni, empleados.mail, empleados.direccion, zonas.nombre AS zona 
        FROM empleados
        JOIN zonas ON empleados.zona_id = zonas.id
    ";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas, verificar ($consulta).</div>";
        exit();
    }

    echo "<h5 class='cantidadCargados'>Vendedores: " . mysqli_num_rows($resultado) . "</h5>";
    ?>

    <table class="table table-hover">
        <thead class="encabezado">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">DNI</th>
                <th scope="col">Email</th>
                <th scope="col">Direccion</th>
                <th scope="col">Zona</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['dni'] . "</td>";
                echo "<td>" . $row['mail'] . "</td>"; 
                echo "<td>" . $row['direccion'] . "</td>"; 
                echo "<td>" . $row['zona'] . "</td>"; 
                echo "<td>";
                // Botones que activan modales
                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editarEmpleadoModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre='" . $row['nombre'] . "' 
                        data-dni='" . $row['dni'] . "' 
                        data-mail='" . $row['mail'] . "' 
                        data-direccion='" . $row['direccion'] . "' 
                        data-zona='" . $row['zona'] . "'>Editar</button> ";
                echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarEmpleadoModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre='" . $row['nombre'] . "' 
                        data-dni='" . $row['dni'] . "' 
                        data-mail='" . $row['mail'] . "'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>

<?php include 'modalCrearEmpleado.php'; ?>
<?php include 'modalEditarEmpleado.php'; ?>
<?php include 'modalEliminarEmpleado.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editarEmpleadoModal = document.getElementById('editarEmpleadoModal');
    editarEmpleadoModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var dni = button.getAttribute('data-dni');
        var mail = button.getAttribute('data-mail');
        var direccion = button.getAttribute('data-direccion');
        var zona = button.getAttribute('data-zona');

        editarEmpleadoModal.querySelector('#id_empleado_editar').value = id;
        editarEmpleadoModal.querySelector('#nombre_editar').value = nombre;
        editarEmpleadoModal.querySelector('#dni_editar').value = dni;
        editarEmpleadoModal.querySelector('#mail_editar').value = mail;
        editarEmpleadoModal.querySelector('#direccion_editar').value = direccion;
        editarEmpleadoModal.querySelector('#zona_editar').value = zona;
    });

    var eliminarEmpleadoModal = document.getElementById('eliminarEmpleadoModal');
    eliminarEmpleadoModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var dni = button.getAttribute('data-dni');
        var mail = button.getAttribute('data-mail');

        eliminarEmpleadoModal.querySelector('#id_empleado_eliminar').value = id;
        eliminarEmpleadoModal.querySelector('#nombre_empleado_eliminar').textContent = nombre;
        eliminarEmpleadoModal.querySelector('#dni_empleado_eliminar').textContent = dni;
        eliminarEmpleadoModal.querySelector('#mail_empleado_eliminar').textContent = mail;
    });
});
</script>

</body>
</html>
