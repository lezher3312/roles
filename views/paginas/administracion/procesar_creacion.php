<?php
include_once '../../../controllers/UsuarioController.php';

// Verificar que se haya enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['rol'];

    // Crear una instancia del controlador
    $usuarioController = new UsuarioController();
    
    // Llamar al método para crear el nuevo usuario en el panel de administración sin hasheado
    $resultado = $usuarioController->crearUsuarioAdmin($nombre, $email, $contrasena, $id_rol);

    if ($resultado) {
        // Redirigir a la página de administración de usuarios con un mensaje de éxito
        header("Location: admin_panel.php?mensaje=usuario_creado");
    } else {
        // Redirigir de regreso a la página de creación con un mensaje de error
        header("Location: crear.php?error=1");
    }
}
