<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="../../css/usuarios.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #c4d3e0; color: #011149;">

<?php include '../administracion/menu_lateral.php'; ?>

<div class="admin-container p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Administración de Usuarios</h2>
        <button class="btn btn-accion" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
            + Agregar Usuario
        </button>
    </div>

    <div class="table-container">
        <table class="table table-hover bg-white">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../../../controllers/UsuarioController.php';
                $controller = new UsuarioController();
                $usuarios = $controller->mostrarUsuarios();

                foreach ($usuarios as $usuario) {
                    echo "<tr id='fila_{$usuario['id_usuario']}'>";
                    echo "<td>" . htmlspecialchars($usuario['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['rol']) . "</td>";
                    echo "<td>
                            <a href='ver_usuario.php?id=" . urlencode($usuario['id_usuario']) . "' class='btn btn-outline-primary btn-sm me-1'>Ver</a>
                            <a href='editar_usuario.php?id=" . urlencode($usuario['id_usuario']) . "' class='btn btn-outline-secondary btn-sm me-1'>Editar</a>
                            <button class='btn btn-outline-danger btn-sm' onclick='confirmarEliminacion({$usuario['id_usuario']})'>Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-confirmar" onclick="eliminarUsuarioConfirmado()">Sí, eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Usuario -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content p-3" method="POST" action="../../../controllers/UsuarioController.php">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="action" value="crearUsuarioAdmin">
                <div class="mb-3">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Contraseña:</label>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Rol:</label>
                    <select name="id_rol" class="form-select" required>
                        <?php
                        include_once '../../../models/RolModel.php';
                        $rolModel = new RolModel();
                        $roles = $rolModel->obtenerRoles();
                        foreach ($roles as $rol) {
                            echo "<option value='{$rol['id_rol']}'>" . htmlspecialchars($rol['nombre_rol']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancelar me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-accion">Guardar Usuario</button>
            </div>
        </form>
    </div>
</div>

<script>
    let usuarioAEliminar = null;

    function confirmarEliminacion(id) {
        usuarioAEliminar = id;
        const modal = new bootstrap.Modal(document.getElementById('modalConfirmacion'));
        modal.show();
    }

    function eliminarUsuarioConfirmado() {
        if (!usuarioAEliminar) return;

        $.ajax({
            url: '../../../controllers/UsuarioController.php',
            type: 'POST',
            data: {
                action: 'eliminarUsuario',
                id_usuario: usuarioAEliminar
            },
            success: function(response) {
                if (response.trim() === 'success') {
                    $('#fila_' + usuarioAEliminar).fadeOut();
                } else {
                    alert("Error al eliminar el usuario.");
                }
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalConfirmacion'));
                modal.hide();
            },
            error: function() {
                alert("Error de conexión.");
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalConfirmacion'));
                modal.hide();
            }
        });
    }
</script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
.btn-accion {
    background-color: #012b7e;
    color: white;
    font-weight: bold;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
}
.btn-accion:hover {
    background-color: #011149;
}
.btn-cancelar {
    background-color: #9e9e9e;
    color: white;
    border: none;
}
.btn-cancelar:hover {
    background-color: #757575;
}
.btn-confirmar {
    background-color: #c62828;
    color: white;
    border: none;
}
.btn-confirmar:hover {
    background-color: #8e0000;
}
</style>

</body>
</html>
