<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include_once '../../../controllers/UsuarioController.php';
$usuarioController = new UsuarioController();
$id_usuario = $_SESSION['user_id'];
$userPreferences = $usuarioController->cargarPreferencias($id_usuario);
$currentTheme = $userPreferences['theme'] ?? 'light';
$currentNotifications = $userPreferences['notifications'] ?? 0;

// Debugging line to verify the theme
echo "<script>console.log('Current Theme in Preferences: " . $currentTheme . "');</script>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin_panel.css">
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body class="bg-light <?php echo htmlspecialchars($currentTheme) . '-theme'; ?>">
<body class="<?php echo htmlspecialchars($currentTheme) . '-theme'; ?>">


<!-- Include Sidebar Menu -->
<?php include '../administracion/menu_lateral.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Preferencias</h2>
                </div>
                <div class="card-body">
                    <form action="../../../controllers/UsuarioController.php" method="POST">
                        <input type="hidden" name="action" value="actualizarPreferencias">

                        <div class="form-group">
                            <label for="tema">Tema de Color:</label>
                            <select id="tema" name="tema" class="form-control">
                                <option value="light" <?php echo $currentTheme === 'light' ? 'selected' : ''; ?>>Claro</option>
                                <option value="dark" <?php echo $currentTheme === 'dark' ? 'selected' : ''; ?>>Oscuro</option>
                                <option value="blue" <?php echo $currentTheme === 'blue' ? 'selected' : ''; ?>>Azul</option>
                                <option value="green" <?php echo $currentTheme === 'green' ? 'selected' : ''; ?>>Verde</option>
                            </select>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="notificaciones" name="notificaciones" <?php echo $currentNotifications ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="notificaciones">Recibir notificaciones por correo electrónico</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Guardar Preferencias</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
