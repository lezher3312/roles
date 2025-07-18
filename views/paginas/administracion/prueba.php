<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica que los módulos permitidos existan en la sesión
$modulosPermitidos = $_SESSION['modulos_permitidos'] ?? [];

if (empty($modulosPermitidos)) {
    echo "<p>No tienes acceso a ningún módulo.</p>";
    exit;
}

include_once '../../../controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$id_usuario = $_SESSION['user_id'];
$userPreferences = $usuarioController->cargarPreferencias($id_usuario);
$currentTheme = $userPreferences['theme'] ?? 'light';

function verificarAccesoModulo($ruta) {
    global $modulosPermitidos;
    foreach ($modulosPermitidos as $modulo) {
        if ($modulo['ruta'] == $ruta) {
            return true;
        }
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <!-- Agregar enlaces CSS -->
    <link rel="stylesheet" href="../../css/admin_panel.css"> <!-- CSS para el panel administrativo -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Iconos de Font Awesome -->
</head>

<body class="<?php echo htmlspecialchars($currentTheme) . '-theme'; ?>">
<script>
    console.log("Applied Theme Class:", document.body.className);
</script>

<!-- Sidebar Menu -->
<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- Menú Lateral -->
<nav class="sidebar <?php echo htmlspecialchars($currentTheme) . '-theme'; ?>">
    <h1>Panel Principal</h1>
    <ul class="menu">
        <?php if (verificarAccesoModulo('/Login/views/paginas/administracion/presentacion.php')): ?>
            <li class="menu-item"><a href="/Login/views/paginas/administracion/presentacion.php"><i class="fas fa-home"></i> Presentación</a></li>
        <?php endif; ?>
        <?php if (verificarAccesoModulo('/Login/views/paginas/administracion/admin_panel.php')): ?>
            <li class="menu-item"><a href="/Login/views/paginas/administracion/admin_panel.php"><i class="fas fa-tachometer-alt"></i> Principal</a></li>
        <?php endif; ?>
        <?php if (verificarAccesoModulo('/Login/views/paginas/usuarios/usuarios.php')): ?>
            <li class="menu-item"><a href="/Login/views/paginas/usuarios/usuarios.php"><i class="fas fa-user"></i> Administración de Usuarios</a></li>
        <?php endif; ?>
        <!-- Agrega los demás enlaces de módulos aquí -->
        <div class="logout-container">
            <a href="../sesion/login.php" class="logout-link"><i class="fas fa-sign-out-alt logout-icon"></i> Cerrar Sesión</a>
        </div>
    </ul>
</nav>
<script>
    // Toggle sidebar menu
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.getElementById("menuToggle");
        const sidebar = document.getElementById("sidebar");

        menuToggle.addEventListener("click", function() {
            sidebar.classList.toggle("show");
        });
    });
</script>
</body>
</html>
