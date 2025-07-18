<?php
include_once __DIR__ . '/../model/RolModel.php';

class RolController {
    public function mostrarRoles() {
        $rolModel = new RolModel();
        return $rolModel->obtenerRoles();
    }

    public function obtenerRolPorId($id_rol) {
        $rolModel = new RolModel();
        return $rolModel->obtenerRolPorId($id_rol);
    }

    public function crearRol($nombre_rol, $descripcion) {
        $rolModel = new RolModel();
        return $rolModel->crearRol($nombre_rol, $descripcion);
    }

    public function actualizarRol($id_rol, $nombre_rol, $descripcion) {
        $rolModel = new RolModel();
        return $rolModel->actualizarRol($id_rol, $nombre_rol, $descripcion);
    }

    public function eliminarRol($id_rol) {
        $rolModel = new RolModel();
        return $rolModel->eliminarRol($id_rol);
    }

    public function obtenerRoles() {
        $rolModel = new RolModel();
        return $rolModel->obtenerRoles();
    }

    public function obtenerAccesosPorRolModulo() {
        $rolModel = new RolModel();
        return $rolModel->obtenerAccesosPorRolModulo();
    }

    public function asignarModuloARol($id_rol, $id_modulo) {
        $rolModel = new RolModel();
        return $rolModel->asignarModuloARol($id_rol, $id_modulo);
    }
    
    public function removerModuloDeRol($id_rol, $id_modulo) {
        $rolModel = new RolModel();
        return $rolModel->removerModuloDeRol($id_rol, $id_modulo);
    }
    
}
