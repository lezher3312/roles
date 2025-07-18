<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<?php 
include '../administracion/menu_lateral.php'; 
include_once '../../../controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuario = $usuarioController->cargarPerfilUsuario();
?>

<div class="container my-5">
    <div class="card mx-auto shadow-lg" style="max-width: 600px;">
        <div class="card-header text-center">
            <h2>Editar Perfil</h2>
        </div>
        <div class="card-body">
            <?php if ($usuario): ?>
                <form action="../../../controllers/UsuarioController.php" method="POST">
                    <input type="hidden" name="action" value="actualizarPerfil">
                    <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>">

                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                    </div>

                    <!-- Contraseña -->
                    <div class="form-group">
                        <label for="contrasena">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo htmlspecialchars($usuario['contrasena']); ?>" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Rol (Read-only) -->
                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <input type="text" class="form-control" id="rol" value="<?php echo htmlspecialchars($usuario['nombre_rol']); ?>" readonly>
                    </div>

                    <!-- Fecha de Registro (Read-only) -->
                    <div class="form-group">
                        <label for="fecha_registro">Fecha de Registro:</label>
                        <input type="text" class="form-control" id="fecha_registro" value="<?php echo htmlspecialchars($usuario['fecha_registro']); ?>" readonly>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-block mt-3">Guardar Cambios</button>
                </form>
            <?php else: ?>
                <div class="alert alert-danger text-center" role="alert">
                    No se encontró la información del usuario.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById("contrasena");
        const toggleIcon = document.getElementById("togglePasswordIcon");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>
