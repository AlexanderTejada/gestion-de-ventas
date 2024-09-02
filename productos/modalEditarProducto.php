<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarProductoForm" action="procesarProducto.php" method="post">
                    <input type="hidden" name="action" value="editar">
                    <input type="hidden" id="id_producto_editar" name="id_producto">
                    <div class="mb-3">
                        <label for="nombre_editar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_editar" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_editar" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_editar" name="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio_editar" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="precio_editar" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock_editar" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock_editar" name="stock" required>
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
