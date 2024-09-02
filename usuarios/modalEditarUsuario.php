<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarUsuarioForm" action="procesarUsuario.php" method="post">
                    <input type="hidden" name="action" value="editar">
                    <input type="hidden" id="id_usuario_editar" name="id_usuario">
                    <div class="mb-3">
                        <label for="nombre_completo_editar" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre_completo_editar" name="nombre_completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario_editar" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario_editar" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="perfil_editar" class="form-label">Perfil</label>
                        <select class="form-control" id="perfil_editar" name="perfil" required>
                            <option value="Administrador">Administrador</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Vendedor">Vendedor</option>
                        </select>
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
