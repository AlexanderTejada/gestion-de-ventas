const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('Login'); // Cambiado a 'Login' para coincidir con el HTML

registerBtn.addEventListener('click', () => {
    container.classList.add("active"); // Asume que 'active' muestra el formulario de registro
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active"); // Asume que quitar 'active' muestra el formulario de inicio de sesión
});
