

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/pp2/estilos/style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<?php include 'menuSupervisor.php'; ?>
<h1 class="font-weight-bold mb-1 bienvenido" style="font-size: 50px;" >Hola!
    <span class="nombre-usuario">
        <?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Nombre de usuario'; ?>
    </span>
</h1>
<div class="container">
    <?php include 'panelesSupervisor.php'; ?>
</div>

<script src="http://localhost/p3/PARCIAL2/script.js"></script>
</body>
</html>
