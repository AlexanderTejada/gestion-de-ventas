<?php
session_start();
$enlace = mysqli_connect("localhost", "root", "", "gestion_de_ventas");
if (!$enlace) {
    die("Error: No se pudo conectar a la base de datos.");
}

$action = $_POST['action'];

if ($action == "crear") {
    $nombre = $_POST['nombre_nuevo'];
    $dni = $_POST['dni_nuevo'];
    $mail = $_POST['mail_nuevo'];
    $direccion = $_POST['direccion_nueva'];
    $zona_id = $_POST['zona_id_nueva'];

    // Verificar si el DNI ya existe
    $verificarConsulta = "SELECT * FROM empleados WHERE dni = '$dni'";
    $verificarResultado = mysqli_query($enlace, $verificarConsulta);

    if (mysqli_num_rows($verificarResultado) > 0) {
        $_SESSION['mensaje'] = "Error: Este empleado ya se encuentra registrado.";
    } else {
        $consulta = "INSERT INTO empleados (nombre, dni, mail, direccion, zona_id) VALUES ('$nombre', '$dni', '$mail', '$direccion', '$zona_id')";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            $_SESSION['mensaje'] = "Error al crear el empleado: " . mysqli_error($enlace);
        } else {
            $_SESSION['mensaje'] = "Empleado creado exitosamente.";
        }
    }
} elseif ($action == "editar") {
    $id = $_POST['id_empleado'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $mail = $_POST['mail'];
    $direccion = $_POST['direccion'];
    $zona_id = $_POST['zona_id'];

    // Verificar si el DNI ya existe y pertenece a otro empleado
    $verificarConsulta = "SELECT * FROM empleados WHERE dni = '$dni' AND id != $id";
    $verificarResultado = mysqli_query($enlace, $verificarConsulta);

    if (mysqli_num_rows($verificarResultado) > 0) {
        $_SESSION['mensaje'] = "Error: Este empleado ya se encuentra registrado.";
    } else {
        $consulta = "UPDATE empleados SET nombre='$nombre', dni='$dni', mail='$mail', direccion='$direccion', zona_id='$zona_id' WHERE id=$id";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            $_SESSION['mensaje'] = "Error al actualizar el empleado: " . mysqli_error($enlace);
        } else {
            $_SESSION['mensaje'] = "Empleado actualizado exitosamente.";
        }
    }
} elseif ($action == "eliminar") {
    $id = $_POST['id_empleado'];

    $consulta = "DELETE FROM empleados WHERE id=$id";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        $_SESSION['mensaje'] = "Error al eliminar el empleado: " . mysqli_error($enlace);
    } else {
        $_SESSION['mensaje'] = "Empleado eliminado exitosamente.";
    }
}

mysqli_close($enlace);
header('Location: Pantalla_empleados.php');
exit;
?>
