<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>

<?php 
// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: /Login/views/paginas/sesion/login.php");
    exit();
}

include '../administracion/menu_lateral.php';
include_once '../../../controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$mensaje_exito = "";
$mensaje_error = "";

// Obtener datos del usuario y roles
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    $usuario = $usuarioController->obtenerUsuarioPorId($id_usuario);
    $roles = $usuarioController->obtenerRoles();
} else {
    header("Location: usuarios.php");
    exit();
}

// Procesar formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $id_rol = $_POST['rol'];
    $nueva_contrasena = $_POST['nueva_contrasena'];

    // Actualizar usuario
    $resultado = $usuarioController->actualizarUsuario($id_usuario, $nombre, $email, $id_rol);

    // Actualizar contraseña si se proporciona
    if (!empty($nueva_contrasena)) {
        $cambio_contrasena = $usuarioController->actualizarContrasena($id_usuario, $nueva_contrasena);
        if (!$cambio_contrasena) {
            $mensaje_error = "Error al cambiar la contraseña.";
        }
    }

    // Verificar éxito
    if ($resultado) {
        $mensaje_exito = "Usuario actualizado correctamente.";
        header("Location: usuarios.php?mensaje=usuario_actualizado");
        exit();
    } else {
        $mensaje_error = "Error al actualizar el usuario.";
    }
}
?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Editar Usuario</h2>

        <!-- Mensajes de éxito o error -->
        <?php if (!empty($mensaje_exito)): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo htmlspecialchars($mensaje_exito); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($mensaje_error)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo htmlspecialchars($mensaje_error); ?>
            </div>
        <?php endif; ?>

        <?php if ($usuario): ?>
            <form action="editar_usuario.php?id=<?php echo htmlspecialchars($id_usuario); ?>" method="POST">
                <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">

                <!-- Nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                </div>

                <!-- Rol -->
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol" name="rol">
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?php echo htmlspecialchars($rol['id_rol']); ?>" 
                                <?php echo (isset($usuario['id_rol']) && $usuario['id_rol'] == $rol['id_rol']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($rol['nombre_rol']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Nueva Contraseña -->
                <div class="form-group">
                    <label for="nueva_contrasena">Nueva Contraseña (opcional)</label>
                    <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena" placeholder="Deja vacío si no deseas cambiar la contraseña">
                </div>

                <!-- Botón Guardar -->
                <button type="submit" class="btn btn-primary btn-block mt-4">Guardar Cambios</button>
            </form>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No se encontró la información del usuario.
            </div>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="usuarios.php">Volver a la lista de usuarios</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
