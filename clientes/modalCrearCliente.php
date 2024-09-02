<div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="crearClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearClienteModalLabel">Crear Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crearClienteForm" action="procesarCliente.php" method="post">
                    <input type="hidden" name="action" value="crear">
                    <div class="mb-3">
                        <label for="nombre_nuevo" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_nuevo" name="nombre_nuevo" required>
                    </div>
                    <div class="mb-3">
                        <label for="dni_nuevo" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="dni_nuevo" name="dni_nuevo" required>
                    </div>
                    <div class="mb-3">
                        <label for="mail_nuevo" class="form-label">Email</label>
                        <input type="email" class="form-control" id="mail_nuevo" name="mail_nuevo" required>
                    </div>
                    <div class="mb-3">
                        <label for="empresa_nueva" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="empresa_nueva" name="empresa_nueva" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion_nueva" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="direccion_nueva" name="direccion_nueva" required>
                    </div>
                    <div class="mb-3">
                        <label for="zona_id_nueva" class="form-label">Zona</label>
                        <select class="form-control" id="zona_id_nueva" name="zona_id_nueva" required>
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
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
