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

if ($action == 'crear') {
    $nombre_completo = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $perfil = $_POST['perfil'];

    $consulta = "INSERT INTO usuarios (nombre_completo, usuario, clave, perfil) VALUES ('$nombre_completo', '$usuario', '$clave', '$perfil')";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado) {
        $_SESSION['mensaje'] = "Usuario creado exitosamente.";
    } else {
        $_SESSION['mensaje'] = "Error al crear el usuario: " . mysqli_error($enlace);
    }
} elseif ($action == 'editar') {
    $id = $_POST['id_usuario'];
    $nombre_completo = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $perfil = $_POST['perfil'];

    $consulta = "UPDATE usuarios SET nombre_completo='$nombre_completo', usuario='$usuario', clave='$clave', perfil='$perfil' WHERE id=$id";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado) {
        $_SESSION['mensaje'] = "Usuario actualizado exitosamente.";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el usuario: " . mysqli_error($enlace);
    }
} elseif ($action == 'eliminar') {
    $id = $_POST['id_usuario'];

    $consulta = "DELETE FROM usuarios WHERE id=$id";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado) {
        $_SESSION['mensaje'] = "Usuario eliminado exitosamente.";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el usuario: " . mysqli_error($enlace);
    }
}

mysqli_close($enlace);
header('Location: Pantalla_usuarios.php');
exit();
?>
