<?php
include_once __DIR__ . '/../model/Modulo.php';

class ModuloController {
    public function obtenerTodosLosModulos() {
        $moduloModel = new Modulo();
        return $moduloModel->obtenerTodosLosModulos();
    }
    
    public function mostrarModuloPorId($id_modulo) {
        $moduloModel = new Modulo();
        return $moduloModel->obtenerModuloPorId($id_modulo);
    }

    public function agregarModulo($nombre, $ruta) {
        $moduloModel = new Modulo();
        return $moduloModel->crearModulo($nombre, $ruta);
    }

    public function editarModulo($id_modulo, $nombre, $ruta) {
        $moduloModel = new Modulo();
        return $moduloModel->actualizarModulo($id_modulo, $nombre, $ruta);
    }

    public function eliminarModulo($id_modulo) {
        $moduloModel = new Modulo();
        return $moduloModel->borrarModulo($id_modulo);
    }
}
