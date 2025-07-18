<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body class="bg-light">

<?php 
include '../administracion/menu_lateral.php';
include_once '../../../controllers/RolController.php';

$rolController = new RolController();

// Verificar que se haya enviado el formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_rol = $_POST['id_rol'];
    $nombre_rol = $_POST['nombre_rol'];
    $descripcion = $_POST['descripcion'];

    // Llamar al método para actualizar los datos del rol
    $resultado = $rolController->actualizarRol($id_rol, $nombre_rol, $descripcion);
    
    if ($resultado) {
        // Redirigir a la página de gestión de roles con un mensaje de éxito
        header("Location: roles.php?mensaje=rol_actualizado");
        exit();
    } else {
        $mensaje = "Error al actualizar el rol. Inténtalo de nuevo.";
    }
}

// Verificar que el ID del rol esté en la URL para cargar los datos iniciales
if (isset($_GET['id'])) {
    $id_rol = $_GET['id'];
    
    // Obtener los datos del rol a editar
    $rol = $rolController->obtenerRolPorId($id_rol);
} else {
    // Redirigir si no hay ID de rol
    header("Location: roles.php");
    exit();
}
?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Editar Rol</h2>

        <?php if (isset($mensaje)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <?php if ($rol): ?>
            <form action="editar_rol.php" method="POST">
                <input type="hidden" name="id_rol" value="<?php echo htmlspecialchars($id_rol); ?>">
                
                <div class="form-group">
                    <label for="nombre_rol">Nombre del Rol</label>
                    <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" 
                           value="<?php echo htmlspecialchars($rol['nombre_rol']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($rol['descripcion']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Guardar Cambios</button>
            </form>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No se encontró el rol solicitado.
            </div>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="roles.php">Volver a la lista de roles</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
