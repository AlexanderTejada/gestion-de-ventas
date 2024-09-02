<div class="modal fade" id="editarEmpleadoModal" tabindex="-1" aria-labelledby="editarEmpleadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarEmpleadoModalLabel">Editar Vendedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarEmpleadoForm" action="procesarEmpleado.php" method="post">
                    <input type="hidden" name="action" value="editar">
                    <input type="hidden" id="id_empleado_editar" name="id_empleado">
                    <div class="mb-3">
                        <label for="nombre_editar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_editar" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="dni_editar" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="dni_editar" name="dni" required>
                    </div>
                    <div class="mb-3">
                        <label for="mail_editar" class="form-label">Email</label>
                        <input type="email" class="form-control" id="mail_editar" name="mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion_editar" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="direccion_editar" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="zona_id_editar" class="form-label">Zona</label>
                        <select class="form-control" id="zona_id_editar" name="zona_id" required>
                            <?php
                            $consultaZonas = "SELECT id, nombre FROM zonas";
                            $resultadoZonas = mysqli_query($enlace, $consultaZonas);
                            while ($filaZona = mysqli_fetch_assoc($resultadoZonas)) {
                                echo "<option value='" . $filaZona['id'] . "'>" . $filaZona['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
