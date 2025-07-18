<?php

include_once '../../../controllers/ModuloController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $ruta = $_POST['ruta'];

    $moduloController = new ModuloController();
    $moduloController->agregarModulo($nombre, $ruta);
    header("Location: modulos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Módulo</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos para centrar en PC y asegurar adaptabilidad en móvil */
        .container {
            max-width: 600px; /* Limitar ancho en pantallas grandes */
        }
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 15px;
            }
        }
        .btn-block {
            width: 100%;
        }
    </style>
</head>
<body>
<?php include 'menu_lateral.php'; ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Agregar Nuevo Módulo</h2>
        <form action="agregar_modulo.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Módulo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="ruta">Ruta del Módulo:</label>
                <input type="text" class="form-control" id="ruta" name="ruta" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Agregar Módulo</button>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
