<?php
include_once '../../../controllers/UsuarioController.php';

// Verificar que se haya enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $id_rol = $_POST['rol']; // Cambiamos a id_rol directamente
    $nueva_contrasena = $_POST['nueva_contrasena']; // Obtener la nueva contraseña (opcional)

    // Crear una instancia del controlador
    $usuarioController = new UsuarioController();
    
    // Llamar al método para actualizar los datos del usuario
    $resultado = $usuarioController->actualizarUsuario($id_usuario, $nombre, $email, $id_rol);

    // Si se proporcionó una nueva contraseña, actualizarla
    if (!empty($nueva_contrasena)) {
        $cambio_contrasena = $usuarioController->actualizarContrasena($id_usuario, $nueva_contrasena);

        if (!$cambio_contrasena) {
            // Redirigir con un mensaje de error si la contraseña no se actualizó
            header("Location: editar_usuario.php?id=$id_usuario&error=cambio_contrasena");
            exit();
        }
    }

    if ($resultado) {
        // Redirigir a la página de administración de usuarios con un mensaje de éxito
        header("Location: usuarios.php?mensaje=actualizado");
    } else {
        // Redirigir a la página de edición con un mensaje de error
        header("Location: editar_usuario.php?id=$id_usuario&error=1");
    }
}
?>
