<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<?php 
include '../administracion/menu_lateral.php'; 
include_once '../../../controllers/RolController.php';

// Obtener lista de roles
$rolController = new RolController();
$roles = $rolController->mostrarRoles();
?>

<div class="admin-container my-5">
    <h2 class="text-center mb-4">Gestión de Roles</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="agregar_rol.php" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar Nuevo Rol</a>
    </div>

    <table class="table table-bordered table-hover bg-white">
        <thead class="thead-dark">
            <tr>
                <th>Rol</th>
                <th>Descripción</th>
                <th style="width: 200px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?php echo htmlspecialchars($rol['nombre_rol']); ?></td>
                    <td><?php echo htmlspecialchars($rol['descripcion']); ?></td>
                    <td>
                        <a href="editar_rol.php?id=<?php echo urlencode($rol['id_rol']); ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <button class="btn btn-sm btn-danger delete-btn" 
                                data-id="<?php echo $rol['id_rol']; ?>" 
                                data-nombre="<?php echo htmlspecialchars($rol['nombre_rol']); ?>"
                                data-toggle="modal" 
                                data-target="#modalEliminar">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar el rol <strong id="nombreRolModal"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
let idRolEliminar = null;

$(document).on('click', '.delete-btn', function() {
    idRolEliminar = $(this).data('id');
    const nombreRol = $(this).data('nombre');
    $('#nombreRolModal').text(nombreRol);
});

$('#confirmarEliminar').on('click', function() {
    if (idRolEliminar) {
        $.ajax({
            url: 'eliminar_rol_ajax.php',
            method: 'POST',
            data: { id: idRolEliminar },
            success: function(response) {
                if (response.trim() === 'ok') {
                    $('#modalEliminar').modal('hide');
                    setTimeout(() => location.reload(), 500);
                } else {
                    alert('Error al eliminar el rol.');
                }
            },
            error: function() {
                alert('Error en la comunicación con el servidor.');
            }
        });
    }
});
</script>

</body>
</html>
