<?php
include_once '../../../controllers/ModuloController.php';

$moduloController = new ModuloController();

// Verificar si se ha enviado el ID del módulo
if (!isset($_GET['id'])) {
    header("Location: modulos.php");
    exit;
}

$id_modulo = $_GET['id'];
$modulo = $moduloController->mostrarModuloPorId($id_modulo); // Método en ModuloController para obtener el módulo específico

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $ruta = $_POST['ruta'];

    // Actualizar el módulo
    $moduloController->editarModulo($id_modulo, $nombre, $ruta);
    header("Location: modulos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Módulo</title>
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
        <h2 class="text-center mb-4">Editar Módulo</h2>
        <form action="editar_modulo.php?id=<?php echo urlencode($id_modulo); ?>" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Módulo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($modulo['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ruta">Ruta del Módulo:</label>
                <input type="text" class="form-control" id="ruta" name="ruta" value="<?php echo htmlspecialchars($modulo['ruta']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
