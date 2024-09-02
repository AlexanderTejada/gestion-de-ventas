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

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
$resultado = mysqli_query($enlace, $consulta);

if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);
    $_SESSION['usuario'] = $row['usuario'];
    $_SESSION['perfil'] = $row['perfil'];
    $_SESSION['username'] = $row['nombre_completo'];

    if ($row['perfil'] == 'Supervisor') {
        header('Location: indexSupervisor.php');
    } elseif ($row['perfil'] == 'Vendedor') {
        header('Location: indexVendedor.php');
    } elseif ($row['perfil'] == 'Administrador') {
        header('Location: indexAdministrador.php');
    } else {
        header('Location: index.php');
    }
} else {
    $_SESSION['mensaje'] = "Nombre de usuario o contraseña incorrectos.";
    header('Location: login.php');
}

mysqli_close($enlace);
exit();
?>
