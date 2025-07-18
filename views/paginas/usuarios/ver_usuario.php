<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/usuarios.css">
    <style>
        /* Estilo para el botón de mostrar/ocultar contraseña */
        .toggle-password {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-left: 8px;
            color: #007bff;
        }
        .toggle-password:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<?php 
include '../administracion/menu_lateral.php'; 
include_once '../../../controllers/UsuarioController.php';

// Verificar que el ID del usuario esté en la URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    
    // Crear una instancia del controlador y obtener los datos del usuario
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->obtenerUsuarioPorId($id_usuario);
} else {
    // Redirigir si no hay ID de usuario
    header("Location: usuarios.php");
    exit();
}
?>

<div class="admin-container">
    <h2>Perfil de Usuario</h2>
    <?php if ($usuario): ?>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($usuario['nombre_rol']); ?></p>
        <p>
            <strong>Contraseña:</strong>
            <input 
                type="password" 
                id="user-password" 
                value="<?php echo htmlspecialchars($usuario['contrasena'], ENT_QUOTES, 'UTF-8'); ?>" 
                readonly
                style="border: none; background: transparent; font-size: 16px;" 
            >
            <button 
                class="toggle-password" 
                type="button" 
                onclick="togglePassword()" 
                style="margin-left: 10px; cursor: pointer; background: none; border: none; font-size: 16px; color: #007bff;"
            >
                👁️
            </button>
        </p>
        <a href="editar_usuario.php?id=<?php echo urlencode($id_usuario); ?>" class="action-button">Editar Usuario</a>
    <?php else: ?>
        <p>No se encontró la información del usuario.</p>
    <?php endif; ?>
</div>

<script>
function togglePassword() {
    const passwordField = document.getElementById('user-password');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}
</script>


</body>
</html>
