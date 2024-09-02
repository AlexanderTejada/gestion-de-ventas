
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Zona', 'Monto'],
                <?php
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_nombre = "gestion_de_ventas";
                $enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

                if (!$enlace) {
                    echo "Error: No se pudo conectar a la base de datos.";
                    exit();
                }

                $consulta = "SELECT zonas.nombre AS zona_nombre, SUM(ventas.monto) AS total_ventas 
                             FROM ventas 
                             JOIN clientes ON ventas.cliente_id = clientes.id
                             JOIN zonas ON clientes.zona_id = zonas.id
                             GROUP BY zonas.nombre";
                $resultado = mysqli_query($enlace, $consulta);

                if (!$resultado) {
                    echo "Error: La consulta SQL tiene problemas.";
                    exit();
                }

                $rows = [];
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $rows[] = "['" . $row['zona_nombre'] . "', " . $row['total_ventas'] . "]";
                }
                echo implode(",", $rows);
                ?>
            ]);

            var options = {
                title: 'Ventas del mes por zona',
                pieHole: 0,
                colors: ['#003857', '#9DDCFF', '#6BB285', '#FF33A1', '#FFFF33'],
                pieSliceBorderColor: 'none'
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div id="donutchart" style="width: 100%; height: 500px;"></div>
        </div>
        <!-- Vendedores del mes -->
        <div class="col-lg-4 vendedores-del-mes">
            <h1 class="letrasBonitas">Vendedores del mes</h1>
            <?php
            $consulta_vendedores = "SELECT empleados.nombre, zonas.nombre AS zona_nombre, SUM(ventas.monto) AS total_ventas
                                    FROM ventas
                                    JOIN empleados ON ventas.vendedor_id = empleados.id
                                    JOIN zonas ON empleados.zona_id = zonas.id
                                    WHERE ventas.fecha >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                    GROUP BY empleados.id, zonas.nombre
                                    ORDER BY total_ventas DESC
                                    LIMIT 3";
            $resultado_vendedores = mysqli_query($enlace, $consulta_vendedores);

            if (!$resultado_vendedores) {
                echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas.</div>";
                exit();
            }

            while ($vendedor = mysqli_fetch_assoc($resultado_vendedores)) {
                echo "<div class='vendedor-mes'>";
                echo "<h3 >" . $vendedor['zona_nombre'] . "</h3>";
                echo "<p class='datos'>" . $vendedor['nombre'] . "</p>";
                echo "<p class='datos'>Total recaudado: $" . number_format($vendedor['total_ventas'], 2) . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    
    <div class="row mt-3">
      
                        
        <div class="col-lg-4">
            <a href="http://localhost/pp2/vendedores/Pantalla_empleados_supervisor.php" class="panel-link">
                <div class="panel">
                    <div class="panel-body-3">
                        <?php
                        $consulta = "SELECT * FROM empleados";
                        $resultado = mysqli_query($enlace, $consulta);

                        if (!$resultado) {
                            echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas.</div>";
                            exit();
                        }

                        echo "<h5 class='titulo-tarjeta'>Vendedores</h5><h3 class='font-weight-bold'>" . mysqli_num_rows($resultado) . "</h3>";
                        ?>
                                           <i class="lni lni-cart" style="font-size: 25px;"></i>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4">
            <a href="http://localhost/pp2/clientes/Pantalla_clientes_supervisor.php" class="panel-link">
                <div class="panel">
                    <div class="panel-body-3">
                        <?php
                        $consulta = "SELECT * FROM clientes";
                        $resultado = mysqli_query($enlace, $consulta);

                        if (!$resultado) {
                            echo "<div class='alert alert-danger' role='alert'>Error: La consulta SQL tiene problemas.</div>";
                            exit();
                        }

                        echo "<h5 class='titulo-tarjeta'>Clientes</h5><h3 class='font-weight-bold'>" . mysqli_num_rows($resultado) . "</h3>";
                        ?>
                        <i class="lni lni-customer" style="font-size: 25px;"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>
</html>
