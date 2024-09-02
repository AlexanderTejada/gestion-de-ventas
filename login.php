<?php
session_start();
if (isset($_SESSION['mensaje'])) {
    echo "<div class='alert alert-info' role='alert'>" . $_SESSION['mensaje'] . "</div>";
    unset($_SESSION['mensaje']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="styleLogin.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" action="register.php">
                <h1>Crear cuenta</h1>
                <span>Ingrese sus datos aquí</span>
                <input type="text" placeholder="Nombre y Apellido" name="nombre_completo" required>
                <input type="text" placeholder="nombre de usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="clave" required>
                <input type="hidden" name="perfil" value="Operador"> <!-- Campo oculto para perfil -->
            </form>
        </div>

        <div class="form-container sign-in">
            <form method="post" action="login_procesa.php">
                <h1>Iniciar sesión</h1>
                <span>Ingrese sus datos aquí</span>
                <input type="text" placeholder="nombre de usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="clave" required>
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¿No tienes cuenta?</h1>
                    <p>Regístrate llenando los campos</p>
                    <button class="hidden" id="Login">Iniciar sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Hola de nuevo!</h1>
                    <p>Introduce tus datos en los campos para iniciar sesión</p>
                </div>
            </div>
        </div>
    </div>
    <script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('Login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
    </script>
</body>
</html>
