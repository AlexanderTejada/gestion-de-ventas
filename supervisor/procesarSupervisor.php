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

    // Verificar si el DNI ya existe
    $verificarConsulta = "SELECT * FROM supervisores WHERE dni = '$dni'";
    $verificarResultado = mysqli_query($enlace, $verificarConsulta);

    if (mysqli_num_rows($verificarResultado) > 0) {
        $_SESSION['mensaje'] = "Error: Este supervisor ya se encuentra registrado.";
    } else {
        $consulta = "INSERT INTO supervisores (nombre, dni, mail) VALUES ('$nombre', '$dni', '$mail')";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            $_SESSION['mensaje'] = "Error al crear el supervisor: " . mysqli_error($enlace);
        } else {
            $_SESSION['mensaje'] = "Supervisor creado exitosamente.";
        }
    }
} elseif ($action == "editar") {
    $id = $_POST['id_supervisor'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $mail = $_POST['mail'];

    // Verificar si el DNI ya existe y pertenece a otro supervisor
    $verificarConsulta = "SELECT * FROM supervisores WHERE dni = '$dni' AND id != $id";
    $verificarResultado = mysqli_query($enlace, $verificarConsulta);

    if (mysqli_num_rows($verificarResultado) > 0) {
        $_SESSION['mensaje'] = "Error: Este supervisor ya se encuentra registrado.";
    } else {
        $consulta = "UPDATE supervisores SET nombre='$nombre', dni='$dni', mail='$mail' WHERE id=$id";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            $_SESSION['mensaje'] = "Error al actualizar el supervisor: " . mysqli_error($enlace);
        } else {
            $_SESSION['mensaje'] = "Supervisor actualizado exitosamente.";
        }
    }
} elseif ($action == "eliminar") {
    $id = $_POST['id_supervisor'];

    $consulta = "DELETE FROM supervisores WHERE id=$id";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        $_SESSION['mensaje'] = "Error al eliminar el supervisor: " . mysqli_error($enlace);
    } else {
        $_SESSION['mensaje'] = "Supervisor eliminado exitosamente.";
    }
}

mysqli_close($enlace);
header('Location: Pantalla_supervisores.php');
exit;
