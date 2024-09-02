<div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioModalLabel">Crear Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crearUsuarioForm" action="procesarUsuario.php" method="post">
                    <input type="hidden" name="action" value="crear">
                    <div class="mb-3">
                        <label for="nombre_completo_nuevo" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre_completo_nuevo" name="nombre_completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario_nuevo" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario_nuevo" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="clave_nueva" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="clave_nueva" name="clave" required>
                    </div>
                    <div class="mb-3">
                        <label for="perfil_nuevo" class="form-label">Perfil</label>
                        <select class="form-control" id="perfil_nuevo" name="perfil" required>
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
