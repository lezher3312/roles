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
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="crear.php" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i> Añadir Usuario</a>
            <a href="modulos.php" class="btn btn-outline-success"><i class="fas fa-box"></i> Ver Modulos</a>
            <a href="accesos.php" class="btn btn-outline-secondary"><i class="fas fa-chart-line"></i>Asignar Accesos </a>
        </div>

        <!-- Panel de Estadísticas -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios Registrados</h5>
                        <p class="card-text display-4">1,024</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Ventas -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Ventas Mensuales</h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Actividades Recientes -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Actividades Recientes</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Usuario Juan Pérez ha registrado un nuevo pedido.</li>
                <li class="list-group-item">Nuevo usuario registrado: Ana Torres.</li>
                <li class="list-group-item">Actualización de inventario en la categoría electrónica.</li>
            </ul>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Ventas en USD',
                data: [1200, 1900, 3000, 500, 2000, 3000],
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

</body>
</html>
