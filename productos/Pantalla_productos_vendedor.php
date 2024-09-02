

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include '../menuVendedor.php'; ?>

<div class="main p-3 ms-5">
    <h1>Gestión de Productos</h1>

    <!-- Formulario de búsqueda -->
    <form method="get" action="Pantalla_productos.php" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Buscar por nombre de producto" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Botón para abrir el modal de crear producto -->
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearProductoModal">Crear Producto</button>
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

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $search_query = $search ? "WHERE nombre LIKE '%$search%'" : '';

    $consulta = "SELECT * FROM productos $search_query";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas, verificar ($consulta).</div>";
        exit();
    }

    echo "<h5 class='cantidadCargados'>Productos Registrados: " . mysqli_num_rows($resultado) . "</h5>";
    ?>

    <table class="table table-hover">
        <thead class="encabezado">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>";
                // Botones que activan modales
                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editarProductoModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre='" . $row['nombre'] . "' 
                        data-descripcion='" . $row['descripcion'] . "' 
                        data-precio='" . $row['precio'] . "' 
                        data-stock='" . $row['stock'] . "'>Editar</button> ";
                echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarProductoModal' 
                        data-id='" . $row['id'] . "' 
                        data-nombre='" . $row['nombre'] . "'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>

<?php include 'modalCrearProducto.php'; ?>
<?php include 'modalEditarProducto.php'; ?>
<?php include 'modalEliminarProducto.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editarProductoModal = document.getElementById('editarProductoModal');
    editarProductoModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var descripcion = button.getAttribute('data-descripcion');
        var precio = button.getAttribute('data-precio');
        var stock = button.getAttribute('data-stock');

        editarProductoModal.querySelector('#id_producto_editar').value = id;
        editarProductoModal.querySelector('#nombre_editar').value = nombre;
        editarProductoModal.querySelector('#descripcion_editar').value = descripcion;
        editarProductoModal.querySelector('#precio_editar').value = precio;
        editarProductoModal.querySelector('#stock_editar').value = stock;
    });

    var eliminarProductoModal = document.getElementById('eliminarProductoModal');
    eliminarProductoModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');

        eliminarProductoModal.querySelector('#id_producto_eliminar').value = id;
        eliminarProductoModal.querySelector('#nombre_producto_eliminar').textContent = nombre;
    });
});
</script>

</body>
</html>
