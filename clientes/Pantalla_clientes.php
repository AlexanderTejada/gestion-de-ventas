

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include '../menu.php'; ?>

<div class="main p-3 ms-5">
    <h1>Gestión de Clientes</h1>

    <!-- Botón para abrir el modal de crear cliente -->
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearClienteModal">Crear Cliente</button>
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

    $consulta = "SELECT clientes.*, zonas.nombre AS zona_nombre
                 FROM clientes
                 JOIN zonas ON clientes.zona_id = zonas.id";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas, verificar ($consulta).</div>";
        exit();
    }

    echo "<h5 class='cantidadCargados'>Clientes: " . mysqli_num_rows($resultado) . "</h5>";
    ?>

    <table class="table table-hover">
        <thead class="encabezado">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">DNI</th>
                <th scope="col">Email</th>
                <th scope="col">Empresa</th>
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
                echo "<td>" . $row['empresa'] . "</td>"; 
                echo "<td>" . $row['direccion'] . "</td>"; 
                echo "<td>" . $row['zona_nombre'] . "</td>"; 

                echo "<td>";
                // Botones que activan modales
                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editarClienteModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre='" . $row['nombre'] . "' 
                        data-dni='" . $row['dni'] . "' 
                        data-mail='" . $row['mail'] . "' 
                        data-empresa='" . $row['empresa'] . "' 
                        data-direccion='" . $row['direccion'] . "' 
                        data-zona_id='" . $row['zona_id'] . "'>Editar</button> ";
                echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarClienteModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre='" . $row['nombre'] . "' 
                        data-dni='" . $row['dni'] . "' 
                        data-mail='" . $row['mail'] . "' 
                        data-empresa='" . $row['empresa'] . "' 
                        data-direccion='" . $row['direccion'] . "' 
                        data-zona_id='" . $row['zona_id'] . "'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>

<?php include 'modalCrearCliente.php'; ?>
<?php include 'modalEditarCliente.php'; ?>
<?php include 'modalEliminarCliente.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editarClienteModal = document.getElementById('editarClienteModal');
    editarClienteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var dni = button.getAttribute('data-dni');
        var mail = button.getAttribute('data-mail');
        var empresa = button.getAttribute('data-empresa');
        var direccion = button.getAttribute('data-direccion');
        var zona_id = button.getAttribute('data-zona_id');

        editarClienteModal.querySelector('#id_cliente_editar').value = id;
        editarClienteModal.querySelector('#nombre_editar').value = nombre;
        editarClienteModal.querySelector('#dni_editar').value = dni;
        editarClienteModal.querySelector('#mail_editar').value = mail;
        editarClienteModal.querySelector('#empresa_editar').value = empresa;
        editarClienteModal.querySelector('#direccion_editar').value = direccion;
        editarClienteModal.querySelector('#zona_id_editar').value = zona_id;
    });

    var eliminarClienteModal = document.getElementById('eliminarClienteModal');
    eliminarClienteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var dni = button.getAttribute('data-dni');
        var mail = button.getAttribute('data-mail');
        var empresa = button.getAttribute('data-empresa');
        var direccion = button.getAttribute('data-direccion');
        var zona_id = button.getAttribute('data-zona_id');

        eliminarClienteModal.querySelector('#id_cliente_eliminar').value = id;
        eliminarClienteModal.querySelector('#nombre_cliente_eliminar').textContent = nombre;
        eliminarClienteModal.querySelector('#dni_cliente_eliminar').textContent = dni;
        eliminarClienteModal.querySelector('#mail_cliente_eliminar').textContent = mail;
        eliminarClienteModal.querySelector('#empresa_cliente_eliminar').textContent = empresa;
        eliminarClienteModal.querySelector('#direccion_cliente_eliminar').textContent = direccion;
        eliminarClienteModal.querySelector('#zona_id_cliente_eliminar').textContent = zona_id;
    });
});
</script>

</body>
</html>
