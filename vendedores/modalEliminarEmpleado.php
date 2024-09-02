<div class="modal fade" id="eliminarEmpleadoModal" tabindex="-1" aria-labelledby="eliminarEmpleadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarEmpleadoModalLabel">Eliminar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar al siguiente empleado?</p>
                <ul>
                    <li>Nombre: <span id="nombre_empleado_eliminar"></span></li>
                    <li>DNI: <span id="dni_empleado_eliminar"></span></li>
                    <li>Email: <span id="mail_empleado_eliminar"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="eliminarEmpleadoForm" action="procesarEmpleado.php" method="post">
                    <input type="hidden" name="action" value="eliminar">
                    <input type="hidden" id="id_empleado_eliminar" name="id_empleado">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
