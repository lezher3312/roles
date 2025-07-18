<?php
require_once __DIR__ . '/../model/ClienteModel.php';


$model = new ClienteModel();

$accion = $_GET['accion'] ?? '';

if ($accion == 'guardar') {
    $data = $_POST;
    if (!empty($_POST['id_cliente'])) {
        $model->actualizarCliente($_POST['id_cliente'], $data);
    } else {
        $model->guardarCliente($data);
    }
    header("Location: ../views/paginas/clientes/clientes.php");
    exit();
}

if ($accion == 'eliminar' && isset($_GET['id'])) {
    $model->eliminarCliente($_GET['id']);
    header("Location: ../views/paginas/clientes/clientes.php");
    exit();
}
?>
