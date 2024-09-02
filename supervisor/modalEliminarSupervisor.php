<div class="modal fade" id="eliminarSupervisorModal" tabindex="-1" aria-labelledby="eliminarSupervisorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarSupervisorModalLabel">Eliminar Supervisor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar al siguiente supervisor?</p>
                <ul>
                    <li>Nombre: <span id="nombre_supervisor_eliminar"></span></li>
                    <li>DNI: <span id="dni_supervisor_eliminar"></span></li>
                    <li>Email: <span id="mail_supervisor_eliminar"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="eliminarSupervisorForm" action="procesarSupervisor.php" method="post">
                    <input type="hidden" name="action" value="eliminar">
                    <input type="hidden" id="id_supervisor_eliminar" name="id_supervisor">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
