<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    
    <link rel="stylesheet" href="../../css/usuarios.css">
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>

<!-- Incluir el menú lateral desde un archivo independiente -->
<?php include '../administracion/menu_lateral.php'; ?>

<div class="admin-container">

    <div class="card-header text-center">
            <h2>Administración de Usuarios</h2>
        </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../../../controllers/UsuarioController.php';
                $controller = new UsuarioController();
                $usuarios = $controller->mostrarUsuarios();

                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td data-label='Nombre'>" . htmlspecialchars($usuario['nombre']) . "</td>";
                    echo "<td data-label='Email'>" . htmlspecialchars($usuario['email']) . "</td>";
                    echo "<td data-label='Rol'>" . htmlspecialchars($usuario['rol']) . "</td>";
                    echo "<td data-label='Acciones'>
                            <a href='ver_usuario.php?id=" . urlencode($usuario['id_usuario']) . "' class='action-button view'>Ver</a>
                            <a href='editar_usuario.php?id=" . urlencode($usuario['id_usuario']) . "' class='action-button edit'>Editar</a>
                            <a href='eliminar_usuario.php?id=" . urlencode($usuario['id_usuario']) . "' class='action-button delete'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
