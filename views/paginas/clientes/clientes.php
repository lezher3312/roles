<?php
require_once '../../../model/ClienteModel.php';
$model = new ClienteModel();
$clientes = $model->obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px 40px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }

        .table-wrapper {
            width: 95%;
            margin: 0 auto;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }

        .card .card-body {
            padding: 2rem;
        }

        .table thead {
            background-color: #2c3e50;
            color: white;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .btn {
            border-radius: 20px;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-secondary {
            background-color: #6c757d;
        }

        .title-section {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }
    </style>
</head>
<body>

<?php include '../administracion/menu_lateral.php'; ?>

<div class="main-content">
    <h2 class="title-section text-center">Gestión de Clientes</h2>

    <!-- Botón Agregar -->
    <div class="mb-4 text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#clienteModal" onclick="abrirModalNuevo()">
            <i class="fas fa-user-plus"></i> Agregar Nuevo Cliente
        </button>
    </div>

    <!-- Tabla -->
    <div class="table-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $c): ?>
                                <tr>
                                    <td><?= $c['id_cliente'] ?></td>
                                    <td><?= $c['nombre'] ?></td>
                                    <td><?= $c['correo'] ?></td>
                                    <td><?= $c['telefono'] ?></td>
                                    <td>
                                        <span class="badge badge-<?= $c['estado'] == 'activo' ? 'success' : 'secondary' ?>">
                                            <?= ucfirst($c['estado']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick='abrirModalEditar(<?= json_encode($c) ?>)'>
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <a href="../../../controllers/ClienteController.php?accion=eliminar&id=<?= $c['id_cliente'] ?>"
                                           onclick="return confirm('¿Deseas eliminar este cliente?')"
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="../../../controllers/ClienteController.php?accion=guardar">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="clienteModalLabel">Nuevo Cliente</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_cliente" id="id_cliente">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
function abrirModalNuevo() {
    document.getElementById('clienteModalLabel').innerText = 'Nuevo Cliente';
    document.getElementById('id_cliente').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('estado').value = 'activo';
    $('#clienteModal').modal('show');
}

function abrirModalEditar(cliente) {
    document.getElementById('clienteModalLabel').innerText = 'Editar Cliente';
    document.getElementById('id_cliente').value = cliente.id_cliente;
    document.getElementById('nombre').value = cliente.nombre;
    document.getElementById('direccion').value = cliente.direccion;
    document.getElementById('telefono').value = cliente.telefono;
    document.getElementById('correo').value = cliente.correo;
    document.getElementById('estado').value = cliente.estado;
    $('#clienteModal').modal('show');
}
</script>

</body>
</html>
