<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin_panel.css">
</head>
<body class="bg-light">

<?php 
include '../administracion/menu_lateral.php';
include_once '../../../controllers/RolController.php';

$rolController = new RolController();
$mensaje = "";

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_rol = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Llamar al método para crear el rol
    $resultado = $rolController->crearRol($nombre_rol, $descripcion);

    if ($resultado) {
        // Redirigir a la lista de roles con un mensaje de éxito
        header("Location: roles.php?mensaje=rol_creado");
        exit();
    } else {
        // Mostrar mensaje de error si falla la creación
        $mensaje = "Error al agregar el rol. Inténtalo de nuevo.";
    }
}
?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Agregar Nuevo Rol</h2>

        <?php if ($mensaje): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form action="agregar_rol.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Rol</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del rol" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción del Rol</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese una descripción del rol" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">Agregar Rol</button>
        </form>

        <div class="text-center mt-3">
            <a href="roles.php">Volver a la lista de roles</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
