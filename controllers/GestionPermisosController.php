<?php
require_once '../../../model/GestionPermisosModel.php';

class GestionPermisosController {
    private $model;

    public function __construct() {
        $this->model = new GestionPermisosModel();
    }

    public function mostrarFormulario($id_rol) {
        $roles = $this->model->obtenerRoles();
        $modulos = $this->model->obtenerModulos();
        $permisos = $this->model->obtenerPermisos();
        $asignados = $this->model->obtenerPermisosAsignados($id_rol);

        include '../roles/gestion_permisos.php';
    }

    public function guardar() {
        $id_rol = $_POST['id_rol'];
        $permisos = $_POST['permiso'] ?? [];
        $this->model->guardarPermisos($id_rol, $permisos);
        header("Location: gestion_permisos.php?id_rol=$id_rol&msg=ok");
        exit;
    }
}
