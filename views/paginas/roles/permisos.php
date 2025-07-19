<?php
include_once '../../../controllers/GestionPermisosController.php';

$controller = new GestionPermisosController();
$model = new GestionPermisosModel();

// Obtener roles
$roles = $model->obtenerRoles();
$id_rol = isset($_GET['id_rol']) ? intval($_GET['id_rol']) : $roles[0]['id_rol'];

// Obtener módulos asignados al rol
$modulos = $model->obtenerModulosAsignadosAlRol($id_rol);

// Obtener permisos disponibles
$permisos = $model->obtenerPermisos();

// Obtener permisos asignados al rol por módulo
$permisosAsignados = $model->obtenerPermisosPorRol($id_rol);

// Mapeo de permisos asignados
$asignadosMap = [];
foreach ($permisosAsignados as $asig) {
    $asignadosMap[$asig['id_modulo']][$asig['id_permiso']] = true;
}

// Guardar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_rol = $_POST['id_rol'];
    $permisoData = $_POST['permiso'] ?? [];
    $controller->guardarPermisos($id_rol, $permisoData);
    header("Location: permisos.php?id_rol=$id_rol&msg=ok");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Permisos por Rol</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body { background-color: #e4ebf5; }
        .content-wrapper { margin-left: 250px; padding: 2rem; }
        .thead-dark { background-color: #012b7e; color: white; }
        th, td { vertical-align: middle !important; }
        @media (max-width: 768px) {
            .content-wrapper { margin-left: 0; padding: 1rem; }
        }
    </style>
</head>
<body>
<?php include '../administracion/menu_lateral.php'; ?>

<div class="content-wrapper">
    <div class="container">
        <h2 class="text-center mb-4"><i class="fas fa-user-shield"></i> Gestión de Permisos por Rol</h2>

        <!-- Selector de Rol -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form method="GET" class="form-inline justify-content-center">
                    <label class="me-2 fw-bold">Rol:</label>
                    <select name="id_rol" class="form-select" onchange="this.form.submit()">
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol['id_rol'] ?>" <?= $rol['id_rol'] == $id_rol ? 'selected' : '' ?>>
                                <?= htmlspecialchars($rol['nombre_rol']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <noscript><button type="submit" class="btn btn-primary">Filtrar</button></noscript>
                </form>
            </div>
        </div>

        <?php if (empty($modulos)): ?>
            <div class="alert alert-info text-center">
                Este rol no tiene módulos asignados. Asigna módulos antes de configurar permisos.
            </div>
        <?php else: ?>
            <!-- Tabla de Permisos -->
            <form method="POST">
                <input type="hidden" name="id_rol" value="<?= htmlspecialchars($id_rol) ?>">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover bg-white shadow-sm text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 30%;">Módulo</th>
                                <?php foreach ($permisos as $perm): ?>
                                    <th><?= ucfirst($perm['nombre_permiso']) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modulos as $mod): ?>
                                <tr>
                                    <td class="text-start fw-semibold"><?= htmlspecialchars($mod['nombre']) ?></td>
                                    <?php foreach ($permisos as $perm): ?>
                                        <td>
                                            <input type="checkbox"
                                                name="permiso[<?= $mod['id_modulo'] ?>][]"
                                                value="<?= $perm['id_permiso'] ?>"
                                                <?= isset($asignadosMap[$mod['id_modulo']][$perm['id_permiso']]) ? 'checked' : '' ?>>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Botón Guardar -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
