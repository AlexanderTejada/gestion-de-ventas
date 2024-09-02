<div class="modal fade" id="eliminarProductoModal" tabindex="-1" aria-labelledby="eliminarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarProductoModalLabel">Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el siguiente producto?</p>
                <ul>
                    <li>Nombre: <span id="nombre_producto_eliminar"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="eliminarProductoForm" action="procesarProducto.php" method="post">
                    <input type="hidden" name="action" value="eliminar">
                    <input type="hidden" id="id_producto_eliminar" name="id_producto">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
