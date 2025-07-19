<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Roles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Íconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="../../css/admin.css">

    <style>
        body {
            background-color: #c4d3e0;
            color: #011149;
        }

        .btn-accion {
            background-color: #012b7e;
            color: white;
            font-weight: bold;
            border: none;
        }

        .btn-accion:hover {
            background-color: #011149;
        }

        .btn-cancelar {
            background-color: #9e9e9e;
            color: white;
        }

        .btn-cancelar:hover {
            background-color: #757575;
        }

        .btn-eliminar {
            background-color: #c62828;
            color: white;
        }

        .btn-eliminar:hover {
            background-color: #8e0000;
        }
    </style>
</head>
<body>

<?php 
include '../administracion/menu_lateral.php'; 
include_once '../../../controllers/RolController.php';

$rolController = new RolController();
$roles = $rolController->mostrarRoles();
?>

<div class="admin-container my-5 px-4">
    <h2 class="text-center mb-4">Gestión de Roles</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="agregar_rol.php" class="btn btn-accion">
            <i class="fas fa-plus"></i> Agregar Nuevo Rol
        </a>
    </div>

    <table class="table table-bordered table-hover bg-white">
        <thead class="table-light">
            <tr>
                <th>Rol</th>
                <th>Descripción</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?php echo htmlspecialchars($rol['nombre_rol']); ?></td>
                    <td><?php echo htmlspecialchars($rol['descripcion']); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="editar_rol.php?id=<?php echo urlencode($rol['id_rol']); ?>" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-outline-danger btn-sm delete-btn" 
                                    data-id="<?php echo $rol['id_rol']; ?>" 
                                    data-nombre="<?php echo htmlspecialchars($rol['nombre_rol']); ?>"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEliminar">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        ¿Estás seguro de que deseas eliminar el rol <strong id="nombreRolModal"></strong>?
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-eliminar" id="confirmarEliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
