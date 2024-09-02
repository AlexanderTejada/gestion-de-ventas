<?php
// Conexión a la base de datos
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_nombre = "gestion_de_ventas";
$enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

if (!$enlace) {
    die("Error: No se pudo conectar a la base de datos.");
}
?>

<!-- Modal Crear Venta -->
<div class="modal fade" id="crearVentaModal" tabindex="-1" aria-labelledby="crearVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearVentaModalLabel">Registrar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crearVentaForm" action="procesarVenta.php" method="post">
                    <input type="hidden" name="action" value="crear">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                    </div>
                    <div class="mb-3">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select class="form-control" id="cliente_id" name="cliente_id" required>
                            <?php
                            $consulta_clientes = "SELECT id, nombre FROM clientes";
                            $resultado_clientes = mysqli_query($enlace, $consulta_clientes);
                            while ($cliente = mysqli_fetch_assoc($resultado_clientes)) {
                                echo "<option value='{$cliente['id']}'>{$cliente['nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vendedor_id" class="form-label">Vendedor</label>
                        <select class="form-control" id="vendedor_id" name="vendedor_id" required>
                            <?php
                            $consulta_vendedores = "SELECT id, nombre FROM empleados";
                            $resultado_vendedores = mysqli_query($enlace, $consulta_vendedores);
                            while ($vendedor = mysqli_fetch_assoc($resultado_vendedores)) {
                                echo "<option value='{$vendedor['id']}'>{$vendedor['nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="producto_id" class="form-label">Producto</label>
                        <select class="form-control" id="producto_id" name="producto_id" required>
                            <?php
                            $consulta_productos = "SELECT id, nombre, precio FROM productos";
                            $resultado_productos = mysqli_query($enlace, $consulta_productos);
                            while ($producto = mysqli_fetch_assoc($resultado_productos)) {
                                echo "<option value='{$producto['id']}' data-precio='{$producto['precio']}'>{$producto['nombre']} - $ {$producto['precio']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto Total</label>
                        <input type="number" class="form-control" id="monto" name="monto" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var productoSelect = document.getElementById('producto_id');
    var cantidadInput = document.getElementById('cantidad');
    var montoInput = document.getElementById('monto');

    // Función para actualizar el monto total
    function actualizarMonto() {
        var productoId = productoSelect.value;
        var precioUnitario = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio');
        var cantidad = cantidadInput.value;
        var montoTotal = cantidad * precioUnitario;
        montoInput.value = montoTotal.toFixed(2); // Formatear a dos decimales
    }

    // Actualizar el monto total al cambiar el producto
    productoSelect.addEventListener('change', function() {
        actualizarMonto();
    });

    // Actualizar el monto total al cambiar la cantidad
    cantidadInput.addEventListener('input', actualizarMonto);
});
</script>
