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
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $cliente_id = $_POST['cliente_id'];
    $vendedor_id = $_POST['vendedor_id'];
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $monto = $_POST['monto'];

    $consulta = "INSERT INTO ventas (fecha, hora, cliente_id, vendedor_id, producto_id, cantidad, monto) VALUES ('$fecha', '$hora', '$cliente_id', '$vendedor_id', '$producto_id', '$cantidad', '$monto')";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado) {
        $_SESSION['mensaje'] = "Venta registrada exitosamente.";
    } else {
        $_SESSION['mensaje'] = "Error al registrar la venta.";
    }
    header('Location: Pantalla_ventas.php');
    exit();
}
?>
