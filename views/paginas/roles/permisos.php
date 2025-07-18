<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Permisos</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<?php 
include '../administracion/menu_lateral.php'; 
include_once '../../../controllers/PermisoController.php';
include_once '../../../controllers/RolController.php';

// Inicializar controladores
$permisoController = new PermisoController();
$rolController = new RolController();

// Obtener roles y permisos
$roles = $rolController->mostrarRoles();
$id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : $roles[0]['id_rol']; // Rol seleccionado o primer rol
$permisos = $permisoController->mostrarPermisos();
$permisosAsignados = $permisoController->obtenerPermisosPorRol($id_rol);
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Gestión de Permisos</h2>
    
    <!-- Filtro para seleccionar el rol -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="permisos.php" method="GET" class="form-inline">
                <label for="rol" class="mr-2">Selecciona un Rol:</label>
                <select id="rol" name="id_rol" class="form-control mr-2" onchange="this.form.submit()">
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['id_rol']; ?>" <?php echo $id_rol == $rol['id_rol'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($rol['nombre_rol']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <noscript><button type="submit" class="btn btn-primary ml-2">Filtrar</button></noscript>
            </form>
        </div>
    </div>

    <!-- Formulario de permisos -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="permisos.php" method="POST" class="bg-white p-4 rounded shadow-sm">
                <input type="hidden" name="id_rol" value="<?php echo htmlspecialchars($id_rol); ?>">
                
                <div class="form-group">
                    <?php foreach ($permisos as $permiso): ?>
                        <div class="form-check mb-3 d-flex align-items-center">
                            <input 
                                type="checkbox" 
                                class="form-check-input mr-3" 
                                name="permiso[]" 
                                value="<?php echo htmlspecialchars($permiso['id_permiso']); ?>"
                                <?php echo in_array($permiso['id_permiso'], $permisosAsignados) ? 'checked' : ''; ?>
                            >
                            <label class="form-check-label flex-grow-1 font-weight-bold">
                                <?php echo htmlspecialchars($permiso['nombre_permiso']); ?>
                            </label>
                            <!-- Icono para ver detalles -->
                            <a href="#" data-toggle="tooltip" title="<?php echo htmlspecialchars($permiso['descripcion']); ?>" class="text-info ml-3">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Guardar Permisos</button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts de JavaScript para Bootstrap y tooltip -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
</html>
