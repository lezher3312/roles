<?php
require_once '../../../model/ClienteModel.php';
$model = new ClienteModel();
$clientes = $model->obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/admin.css">

    <style>
        :root {
            --body-color: #c4d3e0;
            --primary-color: #012b7e;
            --primary-color-light: #5dd3e9;
            --text-color: #011149;
        }

        body {
            background-color: var(--body-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
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

        .title-section {
            font-weight: bold;
            color: var(--primary-color);
        }

        .btn-primary, .btn-success, .btn-warning, .btn-danger {
            border: none;
            border-radius: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-color-light);
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .table thead {
            background-color: var(--primary-color);
            color: white;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>

<?php include '../administracion/menu_lateral.php'; ?>

<div class="main-content">
    <h2 class="title-section text-center">Gestión de Clientes</h2>

    <!-- Botón Agregar -->
    <div class="mb-4 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clienteModal" onclick="abrirModalNuevo()">
            <i class="fas fa-user-plus"></i> Agregar Cliente
        </button>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
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

<!-- Modal Cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="../../../controllers/ClienteController.php?accion=guardar">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="clienteModalLabel">Nuevo Cliente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_cliente" id="id_cliente">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-select">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
function abrirModalNuevo() {
    document.getElementById('clienteModalLabel').innerText = 'Nuevo Cliente';
    document.getElementById('id_cliente').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('estado').value = 'activo';
    new bootstrap.Modal(document.getElementById('clienteModal')).show();
}

function abrirModalEditar(cliente) {
    document.getElementById('clienteModalLabel').innerText = 'Editar Cliente';
    document.getElementById('id_cliente').value = cliente.id_cliente;
    document.getElementById('nombre').value = cliente.nombre;
    document.getElementById('direccion').value = cliente.direccion;
    document.getElementById('telefono').value = cliente.telefono;
    document.getElementById('correo').value = cliente.correo;
    document.getElementById('estado').value = cliente.estado;
    new bootstrap.Modal(document.getElementById('clienteModal')).show();
}
</script>

</body>
</html>
