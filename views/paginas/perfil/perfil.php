<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body >

<?php 
include '../administracion/menu_lateral.php'; 
include_once '../../../controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuario = $usuarioController->cargarPerfilUsuario();
?>

<div class="container my-5">
    <div class="card mx-auto shadow-lg" style="max-width: 600px;">
        <div class="card-header text-center">
            <h2>Perfil de Usuario</h2>
        </div>
        <div class="card-body">
            <?php if ($usuario): ?>
                <div class="profile-info">
                    <p><strong>Nombre:</strong> <span><?php echo htmlspecialchars($usuario['nombre']); ?></span></p>
                    <p><strong>Email:</strong> <span><?php echo htmlspecialchars($usuario['email']); ?></span></p>
                    <p><strong>Rol:</strong> <span><?php echo htmlspecialchars($usuario['nombre_rol']); ?></span></p>
                    <p><strong>Contraseña:</strong> <span><?php echo htmlspecialchars($usuario['contrasena']); ?></span></p> <!-- Mostrar la contraseña -->
                    <p><strong>Fecha de Registro:</strong> <span><?php echo htmlspecialchars($usuario['fecha_registro']); ?></span></p>
                </div>
            <?php else: ?>
                <div class="alert alert-danger text-center" role="alert">
                    No se encontró la información del usuario.
                </div>
            <?php endif; ?>
        </div>
        <div class="card-footer text-center">
            <a href="editar_perfil.php" class="btn btn-primary">Editar Perfil</a>
            <a href="../sesion/login.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
