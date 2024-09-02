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
    $empresa = $_POST['empresa_nueva'];
    $direccion = $_POST['direccion_nueva'];
    $zona_id = $_POST['zona_id_nueva'];

    // Verificar si el DNI ya existe
    $verificarConsulta = "SELECT * FROM clientes WHERE dni = '$dni'";
    $verificarResultado = mysqli_query($enlace, $verificarConsulta);

    if (mysqli_num_rows($verificarResultado) > 0) {
        $_SESSION['mensaje'] = "Error: Este cliente ya se encuentra registrado.";
    } else {
        $consulta = "INSERT INTO clientes (nombre, dni, mail, empresa, direccion, zona_id) VALUES ('$nombre', '$dni', '$mail', '$empresa', '$direccion', '$zona_id')";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            $_SESSION['mensaje'] = "Error al crear el cliente: " . mysqli_error($enlace);
        } else {
            $_SESSION['mensaje'] = "Cliente creado exitosamente.";
        }
    }
} elseif ($action == "editar") {
    $id = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $mail = $_POST['mail'];
    $empresa = $_POST['empresa'];
    $direccion = $_POST['direccion'];
    $zona_id = $_POST['zona_id'];

    // Verificar si el DNI ya existe y pertenece a otro cliente
    $verificarConsulta = "SELECT * FROM clientes WHERE dni = '$dni' AND id != $id";
    $verificarResultado = mysqli_query($enlace, $verificarConsulta);

    if (mysqli_num_rows($verificarResultado) > 0) {
        $_SESSION['mensaje'] = "Error: Este cliente ya se encuentra registrado.";
    } else {
        $consulta = "UPDATE clientes SET nombre='$nombre', dni='$dni', mail='$mail', empresa='$empresa', direccion='$direccion', zona_id='$zona_id' WHERE id=$id";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            $_SESSION['mensaje'] = "Error al actualizar el cliente: " . mysqli_error($enlace);
        } else {
            $_SESSION['mensaje'] = "Cliente actualizado exitosamente.";
        }
    }
} elseif ($action == "eliminar") {
    $id = $_POST['id_cliente'];

    $consulta = "DELETE FROM clientes WHERE id=$id";
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        $_SESSION['mensaje'] = "Error al eliminar el cliente: " . mysqli_error($enlace);
    } else {
        $_SESSION['mensaje'] = "Cliente eliminado exitosamente.";
    }
}

mysqli_close($enlace);
header('Location: Pantalla_clientes.php');
exit;
?>
