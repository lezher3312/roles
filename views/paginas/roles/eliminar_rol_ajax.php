<?php
include_once '../../../controllers/RolController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_rol = intval($_POST['id']);
    $rolController = new RolController();
    $resultado = $rolController->eliminarRol($id_rol);
    echo $resultado ? 'ok' : 'error';
} else {
    echo 'error';
}
