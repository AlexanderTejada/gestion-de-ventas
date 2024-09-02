<div class="modal fade" id="eliminarUsuarioModal" tabindex="-1" aria-labelledby="eliminarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarUsuarioModalLabel">Eliminar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar al siguiente usuario?</p>
                <ul>
                    <li>Nombre Completo: <span id="nombre_completo_usuario_eliminar"></span></li>
                    <li>Usuario: <span id="usuario_usuario_eliminar"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="eliminarUsuarioForm" action="procesarUsuario.php" method="post">
                    <input type="hidden" name="action" value="eliminar">
                    <input type="hidden" id="id_usuario_eliminar" name="id_usuario">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
