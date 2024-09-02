<div class="modal fade" id="editarVentaModal" tabindex="-1" aria-labelledby="editarVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarVentaModalLabel">Editar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarVentaForm" action="procesarVenta.php" method="post">
                    <input type="hidden" name="action" value="editar">
                    <input type="hidden" id="id_venta_editar" name="id_venta">
                    <div class="mb-3">
                        <label for="fecha_editar" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha_editar" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora_editar" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="hora_editar" name="hora" required>
                    </div>
                    <div class="mb-3">
                        <label for="vendedor_id_editar" class="form-label">Vendedor</label>
                        <select class="form-control" id="vendedor_id_editar" name="vendedor_id" required>
                            <?php
                            $consulta_vendedores = "SELECT id, nombre, zona_id FROM empleados";
                            $resultado_vendedores = mysqli_query($enlace, $consulta_vendedores);
                            while ($vendedor = mysqli_fetch_assoc($resultado_vendedores)) {
                                echo "<option value='" . $vendedor['id'] . "' data-zona='" . $vendedor['zona_id'] . "'>" . $vendedor['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cliente_id_editar" class="form-label">Cliente</label>
                        <select class="form-control" id="cliente_id_editar" name="cliente_id" required>
                            <?php
                            $consulta_clientes = "SELECT id, nombre, zona_id FROM clientes";
                            $resultado_clientes = mysqli_query($enlace, $consulta_clientes);
                            while ($cliente = mysqli_fetch_assoc($resultado_clientes)) {
                                echo "<option value='" . $cliente['id'] . "' data-zona='" . $cliente['zona_id'] . "'>" . $cliente['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="producto_id_editar" class="form-label">Producto</label>
                        <select class="form-control" id="producto_id_editar" name="producto_id" required>
                            <?php
                            $consulta_productos = "SELECT id, nombre FROM productos";
                            $resultado_productos = mysqli_query($enlace, $consulta_productos);
                            while ($producto = mysqli_fetch_assoc($resultado_productos)) {
                                echo "<option value='" . $producto['id'] . "'>" . $producto['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad_editar" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad_editar" name="cantidad" required>
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
<script>document.addEventListener('DOMContentLoaded', function() {
    var vendedorSelect = document.getElementById('vendedor_id');
    var clienteSelect = document.getElementById('cliente_id');
    var vendedorSelectEditar = document.getElementById('vendedor_id_editar');
    var clienteSelectEditar = document.getElementById('cliente_id_editar');
    var clienteOptions = Array.from(clienteSelect.options);
    var clienteOptionsEditar = Array.from(clienteSelectEditar.options);

    function filtrarClientes(select, clienteSelect, clienteOptions) {
        var vendedorZona = select.options[select.selectedIndex].getAttribute('data-zona');
        
        // Filtrar las opciones de clientes por la zona del vendedor
        clienteSelect.innerHTML = '';
        clienteOptions.forEach(function(option) {
            if (option.getAttribute('data-zona') === vendedorZona) {
                clienteSelect.appendChild(option);
            }
        });
    }

    vendedorSelect.addEventListener('change', function() {
        filtrarClientes(vendedorSelect, clienteSelect, clienteOptions);
    });

    vendedorSelectEditar.addEventListener('change', function() {
        filtrarClientes(vendedorSelectEditar, clienteSelectEditar, clienteOptionsEditar);
    });

    var crearVentaModal = document.getElementById('crearVentaModal');
    crearVentaModal.addEventListener('show.bs.modal', function(event) {
        var now = new Date();
        var formattedDate = now.toISOString().slice(0, 10);
        var formattedTime = now.toTimeString().slice(0, 5);

        crearVentaModal.querySelector('#fecha').value = formattedDate;
        crearVentaModal.querySelector('#hora').value = formattedTime;
    });

    var editarVentaModal = document.getElementById('editarVentaModal');
    editarVentaModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var fecha = button.getAttribute('data-fecha');
        var hora = button.getAttribute('data-hora');
        var cliente_id = button.getAttribute('data-cliente_id');
        var vendedor_id = button.getAttribute('data-vendedor_id');
        var producto_id = button.getAttribute('data-producto_id');
        var cantidad = button.getAttribute('data-cantidad');

        editarVentaModal.querySelector('#id_venta_editar').value = id;
        editarVentaModal.querySelector('#fecha_editar').value = fecha;
        editarVentaModal.querySelector('#hora_editar').value = hora;
        editarVentaModal.querySelector('#cliente_id_editar').value = cliente_id;
        editarVentaModal.querySelector('#vendedor_id_editar').value = vendedor_id;
        editarVentaModal.querySelector('#producto_id_editar').value = producto_id;
        editarVentaModal.querySelector('#cantidad_editar').value = cantidad;

        filtrarClientes(vendedorSelectEditar, clienteSelectEditar, clienteOptionsEditar);
    });
});
</script>