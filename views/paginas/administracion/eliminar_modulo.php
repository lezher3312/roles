<?php
include_once '../../../controllers/ModuloController.php';

// Verificar si se ha enviado el ID del módulo para eliminar
if (isset($_GET['id'])) {
    $id_modulo = $_GET['id'];
    $moduloController = new ModuloController();
    
    // Llamar al método para eliminar el módulo
    $moduloController->eliminarModulo($id_modulo);
}

// Redirigir de nuevo a la lista de módulos
header("Location: modulos.php");
exit;
