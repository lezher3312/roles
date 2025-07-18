<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <div class="auth-container">
        <h2>Inicio de Sesión</h2>

        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>

        <form action="/Login/controllers/UsuarioController.php" method="POST">
        <input type="hidden" name="action" value="iniciarSesion">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="contrasena">Contraseña:</label>
            <div class="password-container">
                <input type="password" id="contrasena" name="contrasena" required>
                <input type="checkbox" id="mostrar_contrasena" onclick="togglePassword()"> Mostrar contraseña
            </div>

            <button type="submit" class="auth-button">Iniciar Sesión</button>
        </form>
        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("contrasena");
            const checkbox = document.getElementById("mostrar_contrasena");
            if (checkbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>
