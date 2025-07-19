<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../model/Usuario.php';
include_once __DIR__ . '/../model/RolModel.php';

class UsuarioController {
    // Function to process login
    public function login($email, $contrasena) {
        $usuarioModel = new UsuarioModel();
        $rolModel = new RolModel();
        
        $user = $usuarioModel->verificarCredenciales($email, $contrasena);
    
        if ($user) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_theme'] = $user['theme'] ?? 'light';
            
            // Obtener el rol del usuario y los módulos permitidos
            $_SESSION['user_role'] = $user['id_rol'];
            $_SESSION['modulos_permitidos'] = $rolModel->obtenerModulosPorRol($user['id_rol']);
    
            header("Location: /Login/views/paginas/administracion/presentacion.php");
            exit();
        } else {
            $_SESSION['error'] = "Credenciales incorrectas. Inténtalo de nuevo.";
            header("Location: /Login/views/paginas/sesion/login.php");
            exit();
        }
    }
    

    // Load user profile data
    public function cargarPerfilUsuario() {
        if (isset($_SESSION['user_id'])) {
            $usuarioModel = new UsuarioModel();
            return $usuarioModel->obtenerDatosUsuarioPorId($_SESSION['user_id']);
        }
        return null;
    }

    // Update user profile
    public function actualizarPerfil($id_usuario, $nombre, $email, $contrasena) {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->actualizarPerfilPorId($id_usuario, $nombre, $email, $contrasena);
    }

    // Register a new user
    public function registrarUsuario($nombre, $email, $contrasena, $confirmar_contrasena) {
        if ($contrasena !== $confirmar_contrasena) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            header("Location: ../views/paginas/sesion/registro.php");
            exit();
        }

        $usuarioModel = new UsuarioModel();
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        if ($usuarioModel->registrar($nombre, $email, $hashed_password)) {
            $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
            header("Location: ../views/paginas/sesion/login.php");
            exit();
        } else {
            $_SESSION['error'] = "Error al registrar el usuario. Inténtalo de nuevo.";
            header("Location: ../views/paginas/sesion/registro.php");
            exit();
        }
    }

    public function eliminarUsuario($id_usuario) {
    $usuarioModel = new UsuarioModel();
    return $usuarioModel->eliminarUsuario($id_usuario);
    }

    // Load all users
    public function mostrarUsuarios() {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->obtenerUsuarios();
    }

    public function obtenerUsuarioPorId($id_usuario) {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->obtenerUsuarioPorId($id_usuario);
    }
    
    public function actualizarUsuario($id_usuario, $nombre, $email, $rol) {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->actualizarUsuario($id_usuario, $nombre, $email, $rol);
    }
    public function actualizarContrasena($id_usuario, $contrasena) {
        $usuarioModel = new UsuarioModel(); // Asegúrate de tener el modelo disponible
        return $usuarioModel->actualizarContrasenaPorId($id_usuario, $contrasena);
    }
    
    
    public function obtenerRoles() {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->obtenerRoles();
    }

    public function crearUsuarioAdmin($nombre, $email, $contrasena, $id_rol) {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->crearUsuario($nombre, $email, $contrasena, $id_rol);
    }
    
    // Load user preferences for theme and notifications
    public function cargarPreferencias($id_usuario) {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->obtenerPreferencias($id_usuario);
    }

    // Update user preferences (theme and notifications)
    public function actualizarPreferencias($id_usuario, $theme, $notifications) {
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->actualizarPreferencias($id_usuario, $theme, $notifications);
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $controller = new UsuarioController();

    switch ($action) {
        case 'iniciarSesion':
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $controller->login($email, $contrasena);
            break;

        case 'registrarUsuario':
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $confirmar_contrasena = $_POST['confirmar_contrasena'];
            $controller->registrarUsuario($nombre, $email, $contrasena, $confirmar_contrasena);
            break;

          case 'crearUsuarioAdmin':
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            $id_rol = $_POST['id_rol'];

            $exito = $controller->crearUsuarioAdmin($nombre, $email, $contrasena, $id_rol);

            if ($exito) {
                header("Location: ../views/paginas/usuarios/usuarios.php?mensaje=usuario_creado");
            } else {
                header("Location: ../views/paginas/usuarios/usuarios.php?error=error_creacion");
            }
            exit();

            case 'eliminarUsuario':
            $id = $_POST['id_usuario'];
            $resultado = $controller->eliminarUsuario($id);
            echo $resultado ? "success" : "error";
            exit();
            break;


        case 'actualizarPerfil':
            $id_usuario = $_POST['id_usuario'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $resultado = $controller->actualizarPerfil($id_usuario, $nombre, $email, $contrasena);
            if ($resultado) {
                header("Location: ../views/paginas/perfil/perfil.php?mensaje=perfil_actualizado");
            } else {
                echo "Error al actualizar el perfil. Inténtalo de nuevo.";
            }
            break;
             // Nuevo caso para actualizar usuario
        case 'actualizarUsuario':
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $id_rol = $_POST['rol'];
        $nueva_contrasena = $_POST['nueva_contrasena'];

        $resultado = $controller->actualizarUsuario($id_usuario, $nombre, $email, $id_rol);

        if (!empty($nueva_contrasena)) {
            $controller->actualizarContrasena($id_usuario, $nueva_contrasena);
        }

        if ($resultado) {
            header("Location: ../views/paginas/administracion/usuarios.php?mensaje=usuario_actualizado");
        } else {
            header("Location: ../views/paginas/administracion/editar_usuario.php?id=$id_usuario&error=1");
        }
        exit();
        break;

        case 'actualizarPreferencias':
            $id_usuario = $_SESSION['user_id'];
            $theme = $_POST['tema'];
            $notifications = isset($_POST['notificaciones']) ? 1 : 0;
            $controller->actualizarPreferencias($id_usuario, $theme, $notifications);
            header("Location: ../views/paginas/perfil/preferencias.php?mensaje=preferencias_actualizadas");
            exit();

        default:
            header("Location: ../views/paginas/sesion/login.php");
            break;
    }

    
}
?>
