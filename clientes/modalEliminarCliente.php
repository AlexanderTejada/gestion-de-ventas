<!-- modalEliminarCliente.php -->
<div class="modal fade" id="eliminarClienteModal" tabindex="-1" aria-labelledby="eliminarClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarClienteModalLabel">Eliminar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar al siguiente cliente?</p>
                <ul>
                    <li>Nombre: <span id="nombre_cliente_eliminar"></span></li>
                    <li>DNI: <span id="dni_cliente_eliminar"></span></li>
                    <li>Email: <span id="mail_cliente_eliminar"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="eliminarClienteForm" action="procesarCliente.php" method="post">
                    <input type="hidden" name="action" value="eliminar">
                    <input type="hidden" id="id_cliente_eliminar" name="id_cliente">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>