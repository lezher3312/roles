<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
</head>
<body>

<!-- Incluir el menú lateral -->
<?php include 'menu_lateral.php'; ?>

<div class="admin-panel-container">
    <!-- Contenido Principal -->
    <main class="content">
        <h2>Bienvenido al Panel de Administración</h2>
        <p>Selecciona una opción en el menú para comenzar.</p>

        <!-- Barra de Búsqueda -->
        <div class="input-group mb-4">
            <input type="text" class="form-control" placeholder="Buscar en el sistema..." aria-label="Buscar">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <!-- Accesos Rápidos -->
   <!-- Accesos Rápidos (estilo tarjetas) -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <a href="../usuarios/usuarios.php" class="btn btn-outline-primary w-100 text-left shadow-sm p-3">
            <i class="fas fa-user-cog fa-lg mr-2"></i> Administración de Usuarios
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="../roles/roles.php" class="btn btn-outline-success w-100 text-left shadow-sm p-3">
            <i class="fas fa-user-shield fa-lg mr-2"></i> Gestión de Roles
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="../roles/permisos.php" class="btn btn-outline-warning w-100 text-left shadow-sm p-3">
            <i class="fas fa-key fa-lg mr-2"></i> Gestión de Permisos
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="modulos.php" class="btn btn-outline-info w-100 text-left shadow-sm p-3">
            <i class="fas fa-box fa-lg mr-2"></i> Ver Módulos
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="accesos.php" class="btn btn-outline-secondary w-100 text-left shadow-sm p-3">
            <i class="fas fa-chart-line fa-lg mr-2"></i> Asignar Accesos
        </a>
    </div>
</div>


</body>
</html>
