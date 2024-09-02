<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_nombre = "gestion_de_ventas";
$enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

if (!$enlace) {
    die("Error: No se pudo conectar a la base de datos.");
}

$action = $_POST['action'];

if ($action == "crear") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $consulta = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES ('$nombre', '$descripcion', $precio, $stock)";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        $_SESSION['mensaje'] = "Error al crear el producto: " . mysqli_error($enlace);
    } else {
        $_SESSION['mensaje'] = "Producto creado exitosamente.";
    }
} elseif ($action == "editar") {
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $consulta = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, stock=$stock WHERE id=$id";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        $_SESSION['mensaje'] = "Error al actualizar el producto: " . mysqli_error($enlace);
    } else {
        $_SESSION['mensaje'] = "Producto actualizado exitosamente.";
    }
} elseif ($action == "eliminar") {
    $id = $_POST['id_producto'];

    $consulta = "DELETE FROM productos WHERE id=$id";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        $_SESSION['mensaje'] = "Error al eliminar el producto: " . mysqli_error($enlace);
    } else {
        $_SESSION['mensaje'] = "Producto eliminado exitosamente.";
    }
}

mysqli_close($enlace);
header('Location: Pantalla_productos.php');
exit;
?>
