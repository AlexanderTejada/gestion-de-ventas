
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premios Mensuales</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="main p-3 ms-5">
    <h1>Premios Mensuales</h1>

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

    $objetivo_mensual = 10000; // Objetivo mensual de ventas
    $porcentaje_premio = 0.10; // Porcentaje del premio

    // Obtener premios para supervisores
    $consulta_supervisores = "SELECT s.nombre AS supervisor, SUM(v.monto) AS total_vendido
                              FROM ventas v
                              JOIN empleados e ON v.vendedor_id = e.id
                              JOIN supervisores s ON e.supervisor_id = s.id
                              WHERE MONTH(v.fecha) = MONTH(CURRENT_DATE())
                              GROUP BY s.id";
    $resultado_supervisores = mysqli_query($enlace, $consulta_supervisores);

    // Obtener premios para vendedores
    $consulta_vendedores = "SELECT e.nombre AS vendedor, SUM(v.monto) AS total_vendido
                            FROM ventas v
                            JOIN empleados e ON v.vendedor_id = e.id
                            WHERE MONTH(v.fecha) = MONTH(CURRENT_DATE())
                            GROUP BY e.id";
    $resultado_vendedores = mysqli_query($enlace, $consulta_vendedores);

    // Obtener premios para clientes
    $consulta_clientes = "SELECT c.nombre AS cliente, SUM(v.monto) AS total_comprado
                          FROM ventas v
                          JOIN clientes c ON v.cliente_id = c.id
                          WHERE MONTH(v.fecha) = MONTH(CURRENT_DATE())
                          GROUP BY c.id";
    $resultado_clientes = mysqli_query($enlace, $consulta_clientes);
    ?>

    <h2>Supervisores</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Supervisor</th>
                <th>Total Vendido</th>
                <th>Premio</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado_supervisores)) { 
                $premio = $row['total_vendido'] > $objetivo_mensual ? $row['total_vendido'] * $porcentaje_premio : 0;
            ?>
                <tr>
                    <td><?php echo $row['supervisor']; ?></td>
                    <td><?php echo $row['total_vendido']; ?></td>
                    <td><?php echo $premio; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Vendedor</th>
                <th>Total Vendido</th>
                <th>Premio</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado_vendedores)) { 
                $premio = $row['total_vendido'] > $objetivo_mensual ? $row['total_vendido'] * $porcentaje_premio : 0;
            ?>
                <tr>
                    <td><?php echo $row['vendedor']; ?></td>
                    <td><?php echo $row['total_vendido']; ?></td>
                    <td><?php echo $premio; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Clientes</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Total Comprado</th>
                <th>Premio</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado_clientes)) { ?>
                <tr>
                    <td><?php echo $row['cliente']; ?></td>
                    <td><?php echo $row['total_comprado']; ?></td>
                    <td><?php echo $row['total_comprado'] * 0.05; // Ejemplo de cálculo de premio ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
