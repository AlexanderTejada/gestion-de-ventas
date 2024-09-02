

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Supervisores</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include '../menu.php'; ?>

<div class="main p-3 ms-5">
    <h1>Gestión de Supervisores</h1>

    <!-- Botón para abrir el modal de crear supervisor -->
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearSupervisorModal">Crear Supervisor</button>
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

    $consulta = "SELECT * FROM supervisores";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas, verificar ($consulta).</div>";
        exit();
    }

    echo "<h5 class='cantidadCargados'>Supervisores: " . mysqli_num_rows($resultado) . "</h5>";
    ?>

    <table class="table table-hover">
        <thead class="encabezado">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">DNI</th>
                <th scope="col">Email</th>
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
                echo "<td>";
                // Botones que activan modales
                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editarSupervisorModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre='" . $row['nombre'] . "' 
                        data-dni='" . $row['dni'] . "' 
                        data-mail='" . $row['mail'] . "'>Editar</button> ";
                echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarSupervisorModal' 
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

<?php include 'modalCrearSupervisor.php'; ?>
<?php include 'modalEditarSupervisor.php'; ?>
<?php include 'modalEliminarSupervisor.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editarSupervisorModal = document.getElementById('editarSupervisorModal');
    editarSupervisorModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var dni = button.getAttribute('data-dni');
        var mail = button.getAttribute('data-mail');

        editarSupervisorModal.querySelector('#id_supervisor_editar').value = id;
        editarSupervisorModal.querySelector('#nombre_editar').value = nombre;
        editarSupervisorModal.querySelector('#dni_editar').value = dni;
        editarSupervisorModal.querySelector('#mail_editar').value = mail;
    });

    var eliminarSupervisorModal = document.getElementById('eliminarSupervisorModal');
    eliminarSupervisorModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var dni = button.getAttribute('data-dni');
        var mail = button.getAttribute('data-mail');

        eliminarSupervisorModal.querySelector('#id_supervisor_eliminar').value = id;
        eliminarSupervisorModal.querySelector('#nombre_supervisor_eliminar').textContent = nombre;
        eliminarSupervisorModal.querySelector('#dni_supervisor_eliminar').textContent = dni;
        eliminarSupervisorModal.querySelector('#mail_supervisor_eliminar').textContent = mail;
    });
});
</script>

</body>


</html>
