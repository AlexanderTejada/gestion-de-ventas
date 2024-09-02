
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Premios Mensuales</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
</head>
<body>

<?php include '../menuVendedor.php'; ?>

<div class="main p-3 ms-5">
    <h1 class="tituloPremios">Premios Mensuales</h1>

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

    // Obtener premios para vendedores
    $consulta_vendedores = "SELECT e.id, e.nombre AS vendedor, z.id AS zona_id, z.nombre AS zona, SUM(v.monto) AS total_vendido, 
                            CASE 
                                WHEN SUM(v.monto) > 10000 THEN SUM(v.monto) * 0.10
                                ELSE 0
                            END AS premio
                            FROM ventas v
                            JOIN empleados e ON v.vendedor_id = e.id
                            JOIN zonas z ON e.zona_id = z.id
                            WHERE MONTH(v.fecha) = MONTH(CURRENT_DATE())
                            GROUP BY e.id, z.id";
    $resultado_vendedores = mysqli_query($enlace, $consulta_vendedores);

    // Calcular los premios de los supervisores en función de los premios de los vendedores de su zona
    $premios_supervisores = [];
    while ($row = mysqli_fetch_assoc($resultado_vendedores)) {
        $zona_id = $row['zona_id'];
        $premio_vendedor = $row['premio'];
        $supervisor_id_query = mysqli_query($enlace, "SELECT supervisor_id FROM zonas WHERE id = $zona_id");
        $supervisor_id = mysqli_fetch_assoc($supervisor_id_query)['supervisor_id'];

        if (!isset($premios_supervisores[$supervisor_id])) {
            $supervisor_nombre_query = mysqli_query($enlace, "SELECT nombre FROM supervisores WHERE id = $supervisor_id");
            $supervisor_nombre = mysqli_fetch_assoc($supervisor_nombre_query)['nombre'];
            $premios_supervisores[$supervisor_id] = [
                'supervisor' => $supervisor_nombre,
                'zona' => $row['zona'],
                'total_vendido' => 0,
                'premio' => 0
            ];
        }

        $premios_supervisores[$supervisor_id]['total_vendido'] += $row['total_vendido'];
        $premios_supervisores[$supervisor_id]['premio'] += $premio_vendedor * 0.05;
    }

    // Obtener premios para clientes
    $consulta_clientes = "SELECT c.nombre AS cliente, z.nombre AS zona, SUM(v.monto) AS total_comprado, SUM(v.monto) * 0.05 AS premio
                          FROM ventas v
                          JOIN clientes c ON v.cliente_id = c.id
                          JOIN zonas z ON c.zona_id = z.id
                          WHERE MONTH(v.fecha) = MONTH(CURRENT_DATE())
                          GROUP BY c.id, z.id";
    $resultado_clientes = mysqli_query($enlace, $consulta_clientes);
    ?>

    <h1 style="font-size: 30px;">Supervisores</h1>
    <table class="table table-hover">
        <thead class="head-premios">
            <tr>
                <th>Supervisor</th>
                <th>Zona</th>
                <th>Total Vendido</th>
                <th>Premio</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($premios_supervisores as $supervisor) { ?>
                <tr>
                    <td><?php echo $supervisor['supervisor']; ?></td>
                    <td><?php echo $supervisor['zona']; ?></td>
                    <td><?php echo $supervisor['total_vendido']; ?></td>
                    <td><?php echo $supervisor['premio']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h1 style="font-size: 30px;">Vendedores</h1>
    <table class="table table-hover">
        <thead class="head-premios" >
            <tr>
                <th>Vendedor</th>
                <th>Zona</th>
                <th>Total Vendido</th>
                <th>Premio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Reiniciar el cursor de resultado para volver a recorrer los vendedores
            mysqli_data_seek($resultado_vendedores, 0);
            while ($row = mysqli_fetch_assoc($resultado_vendedores)) { ?>
                <tr>
                    <td><?php echo $row['vendedor']; ?></td>
                    <td><?php echo $row['zona']; ?></td>
                    <td><?php echo $row['total_vendido']; ?></td>
                    <td><?php echo $row['premio']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h1 style="font-size: 30px;">Clientes</h1>
    <table class="table table-hover">
        <thead class="head-premios">
            <tr>
                <th>Cliente</th>
                <th>Zona</th>
                <th>Total Comprado</th>
                <th>Premio</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado_clientes)) { ?>
                <tr>
                    <td><?php echo $row['cliente']; ?></td>
                    <td><?php echo $row['zona']; ?></td>
                    <td><?php echo $row['total_comprado']; ?></td>
                    <td><?php echo $row['premio']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
