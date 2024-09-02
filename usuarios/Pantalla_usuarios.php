

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include '../menu.php'; ?>

<div class="main p-3 ms-5">
    <h1>Gestión de Usuarios</h1>

    <!-- Botón para abrir el modal de crear usuario -->
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">Crear Usuario</button>
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

    $consulta = "SELECT * FROM usuarios";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas, verificar ($consulta).</div>";
        exit();
    }

    echo "<h5 class='cantidadCargados'>Usuarios Registrados: " . mysqli_num_rows($resultado) . "</h5>";
    ?>

    <table class="table table-hover">
        <thead class="encabezado">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Perfil</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre_completo'] . "</td>";
                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['perfil'] . "</td>";
                echo "<td>";
                // Botones que activan modales
                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editarUsuarioModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre_completo='" . $row['nombre_completo'] . "' 
                        data-usuario='" . $row['usuario'] . "' 
                        data-perfil='" . $row['perfil'] . "'>Editar</button> ";
                echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarUsuarioModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre_completo='" . $row['nombre_completo'] . "' 
                        data-usuario='" . $row['usuario'] . "'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>

<?php include 'modalCrearUsuario.php'; ?>
<?php include 'modalEditarUsuario.php'; ?>
<?php include 'modalEliminarUsuario.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editarUsuarioModal = document.getElementById('editarUsuarioModal');
    editarUsuarioModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre_completo = button.getAttribute('data-nombre_completo');
        var usuario = button.getAttribute('data-usuario');
        var perfil = button.getAttribute('data-perfil');

        editarUsuarioModal.querySelector('#id_usuario_editar').value = id;
        editarUsuarioModal.querySelector('#nombre_completo_editar').value = nombre_completo;
        editarUsuarioModal.querySelector('#usuario_editar').value = usuario;
        editarUsuarioModal.querySelector('#perfil_editar').value = perfil;
    });

    var eliminarUsuarioModal = document.getElementById('eliminarUsuarioModal');
    eliminarUsuarioModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre_completo = button.getAttribute('data-nombre_completo');
        var usuario = button.getAttribute('data-usuario');

        eliminarUsuarioModal.querySelector('#id_usuario_eliminar').value = id;
        eliminarUsuarioModal.querySelector('#nombre_completo_usuario_eliminar').textContent = nombre_completo;
        eliminarUsuarioModal.querySelector('#usuario_usuario_eliminar').textContent = usuario;
    });
});
</script>

</body>
</html>
