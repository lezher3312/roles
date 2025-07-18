<?php
// Habilitar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../../../controllers/ModuloController.php';

// Instancia del controlador de módulos
$moduloController = new ModuloController();
$modulos = $moduloController->obtenerTodosLosModulos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Módulos</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Ajuste del contenedor para centrado */
        .container {
            max-width: 900px;
        }
        /* Ajuste para centrar la tabla en pantalla grande */
        .table-container {
            max-width: 700px;
            margin: 0 auto;
        }
        /* Ajustes para mejorar la visualización en dispositivos pequeños */
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 15px;
            }
            .table th, .table td {
                font-size: 12px;
            }
            .btn-sm {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
<?php include 'menu_lateral.php'; ?>
<div class="container my-5">
    <h2 class="text-center mb-4">Gestión de Módulos</h2>
    
    <!-- Botón para agregar nuevo módulo -->
    <div class="d-flex justify-content-end mb-3">
        <a href="agregar_modulo.php" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar Nuevo Módulo</a>
    </div>
    
    <!-- Tabla de módulos centrada en PC -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre del Módulo</th>
                        <th>Ruta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modulos as $modulo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($modulo['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($modulo['ruta']); ?></td>
                            <td>
                                <a href="editar_modulo.php?id=<?php echo urlencode($modulo['id_modulo']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminar_modulo.php?id=<?php echo urlencode($modulo['id_modulo']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
