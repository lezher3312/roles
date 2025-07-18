<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../../../controllers/RolController.php';
include_once '../../../controllers/ModuloController.php';

// Create instances of controllers
$rolController = new RolController();
$moduloController = new ModuloController();

// Fetch all roles and modules
$roles = $rolController->obtenerRoles();
$modulos = $moduloController->obtenerTodosLosModulos();

// Fetch existing module access for roles
$roleModuleAccess = $rolController->obtenerAccesosPorRolModulo(); // This should return an array of arrays with 'id_rol' and 'id_modulo'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Accesos a Roles</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos para centrar en PC y asegurar adaptabilidad en móvil */
        .container {
            max-width: 600px; /* Limitar ancho en pantallas grandes */
        }
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 15px;
            }
        }
        .btn-block {
            width: 100%;
        }
    </style>
</head>
<body>
<?php include 'menu_lateral.php'; ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Asignar Accesos a Roles</h2>
    
    <form action="procesar_accesos.php" method="POST">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Módulo</th>
                    <?php foreach ($roles as $rol): ?>
                        <th><?php echo htmlspecialchars($rol['nombre_rol']); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modulos as $modulo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($modulo['nombre']); ?></td>
                        <?php foreach ($roles as $rol): ?>
                            <td class="text-center">
                                <input type="checkbox" 
                                       name="access[<?php echo $rol['id_rol']; ?>][<?php echo $modulo['id_modulo']; ?>]" 
                                       <?php echo in_array(['id_rol' => $rol['id_rol'], 'id_modulo' => $modulo['id_modulo']], $roleModuleAccess) ? 'checked' : ''; ?>
                                >
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary btn-block">Guardar Accesos</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
