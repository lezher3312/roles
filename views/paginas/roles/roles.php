<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body class="bg-light">

<?php 
include '../administracion/menu_lateral.php'; 
include_once '../../../controllers/RolController.php';

// Crear una instancia del controlador para obtener los roles
$rolController = new RolController();
$roles = $rolController->mostrarRoles();
?>

<div class="admin-container my-5">
    <h2 class="text-center mb-4">Gestión de Roles</h2>
    
    <div class="d-flex justify-content-end mb-3">
        <a href="agregar_rol.php" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar Nuevo Rol</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Rol</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?php echo htmlspecialchars($rol['nombre_rol']); ?></td>
                    <td><?php echo htmlspecialchars($rol['descripcion']); ?></td>
                    <td>
                    <a href="editar_rol.php?id=<?php echo urlencode($rol['id_rol']); ?>" class="action-button edit">Editar</a>

                        <a href="eliminar_rol.php?id=<?php echo urlencode($rol['id_rol']); ?>" class="action-button delete">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
