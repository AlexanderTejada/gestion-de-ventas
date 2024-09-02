<?php
session_start();
if (isset($_SESSION['mensaje'])) {
    echo "<div class='alert alert-info' role='alert'>" . $_SESSION['mensaje'] . "</div>";
    unset($_SESSION['mensaje']);
}
?>
<div id="cursor-circle"></div>
<div id="cursor-circle2"></div>

<div class="wrapper d-flex">
    <aside id="sidebar" style="border-top-right-radius: 50px;">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-angle-double-right"></i>
            </button>
            <div class="sidebar-logo">
                <a href="http://localhost/pp2/indexSupervisor.php">Gestion de ventas</a>
            </div>
        </div>
       
            <li class="sidebar-item">
                <a href="http://localhost/pp2/vendedores/Pantalla_empleados_supervisor.php" class="sidebar-link">
                    <i class="lni lni-cart"></i>
                    <span>Vendedores</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="http://localhost/pp2/clientes/Pantalla_clientes_supervisor.php" class="sidebar-link">
                    <i class="lni lni-users"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="http://localhost/pp2/productos/Pantalla_productos_supervisor.php" class="sidebar-link">
                    <i class="lni lni-package"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="http://localhost/pp2/ventas/Pantalla_ventas_supervisor.php" class="sidebar-link">
                    <i class="lni lni-money-location"></i>
                    <span>Ventas</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="http://localhost/pp2/premios/Pantalla_premios_supervisor.php" class="sidebar-link">
                    <i class="lni lni-certificate"></i>
                    <span>Premios</span>
                </a>
            </li>
   

        </ul>
        <div class="sidebar-footer">
            <a href="http://localhost/pp2/login.php" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Salir</span>
            </a>
        </div>
    </aside>


    
    <div class="main p-4 ms-0">
        
        <div class="container-fluid">
            <h1><a href="http://localhost/pp2/indexSupervisor.php" class="nombre-usuario">Panel supervisor</a></h1>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#003857" class="bi bi-emoji-sunglasses-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M2.31 5.243A1 1 0 0 1 3.28 4H6a1 1 0 0 1 1 1v.116A4.2 4.2 0 0 1 8 5c.35 0 .69.04 1 .116V5a1 1 0 0 1 1-1h2.72a1 1 0 0 1 .97 1.243l-.311 1.242A2 2 0 0 1 11.439 8H11a2 2 0 0 1-1.994-1.839A3 3 0 0 0 8 6c-.393 0-.74.064-1.006.161A2 2 0 0 1 5 8h-.438a2 2 0 0 1-1.94-1.515zM4.969 9.75A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .866-.5z"/>
                                    </svg>           
                                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Nombre de usuario'; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="http://localhost/p3/PARCIAL2/login/login.php">Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script>
const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
</script>