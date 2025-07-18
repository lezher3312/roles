<?php
include_once __DIR__ . '/../model/PermisoModel.php';

class PermisoController {
    private $permisoModel;

    public function __construct() {
        $this->permisoModel = new PermisoModel();
    }

    public function mostrarPermisos() {
        return $this->permisoModel->obtenerPermisos();
    }

    public function obtenerPermisosPorRol($id_rol) {
        return $this->permisoModel->obtenerPermisosPorRol($id_rol);
    }

    public function actualizarPermisosPorRol($id_rol, $permisos) {
        return $this->permisoModel->actualizarPermisosPorRol($id_rol, $permisos);
    }
}

// Procesar el formulario de actualización de permisos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rol'])) {
    $id_rol = $_POST['id_rol'];
    $permisos = isset($_POST['permiso']) ? $_POST['permiso'] : [];

    $controller = new PermisoController();
    $controller->actualizarPermisosPorRol($id_rol, $permisos);

    header("Location: permisos.php?id_rol=$id_rol&mensaje=permisos_actualizados");
    exit();
}
?>
