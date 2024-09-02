<div class="modal fade" id="eliminarVentaModal" tabindex="-1" aria-labelledby="eliminarVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarVentaModalLabel">Eliminar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar la siguiente venta?</p>
                <ul>
                    <li>Fecha: <span id="fecha_venta_eliminar"></span></li>
                    <li>Hora: <span id="hora_venta_eliminar"></span></li>
                    <li>Cliente: <span id="cliente_venta_eliminar"></span></li>
                    <li>Vendedor: <span id="vendedor_venta_eliminar"></span></li>
                    <li>Producto: <span id="producto_venta_eliminar"></span></li>
                    <li>Cantidad: <span id="cantidad_venta_eliminar"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="eliminarVentaForm" action="procesarVenta.php" method="post">
                    <input type="hidden" name="action" value="eliminar">
                    <input type="hidden" id="id_venta_eliminar" name="id_venta">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var eliminarVentaModal = document.getElementById('eliminarVentaModal');
    eliminarVentaModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var fecha = button.getAttribute('data-fecha');
        var hora = button.getAttribute('data-hora');
        var cliente = button.getAttribute('data-cliente_nombre');
        var vendedor = button.getAttribute('data-vendedor_nombre');
        var producto = button.getAttribute('data-producto_nombre');
        var cantidad = button.getAttribute('data-cantidad');

        eliminarVentaModal.querySelector('#id_venta_eliminar').value = id;
        eliminarVentaModal.querySelector('#fecha_venta_eliminar').textContent = fecha;
        eliminarVentaModal.querySelector('#hora_venta_eliminar').textContent = hora;
        eliminarVentaModal.querySelector('#cliente_venta_eliminar').textContent = cliente;
        eliminarVentaModal.querySelector('#vendedor_venta_eliminar').textContent = vendedor;
        eliminarVentaModal.querySelector('#producto_venta_eliminar').textContent = producto;
        eliminarVentaModal.querySelector('#cantidad_venta_eliminar').textContent = cantidad;
    });
});
</script>
