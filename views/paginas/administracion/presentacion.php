<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Nuestro Portal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/presentacion.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/admin_panel.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
        }
        .sidebar {
            width: 250px;
            transition: transform 0.3s ease;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            transform: translateX(-100%);
            z-index: 1050;
        }
        .sidebar.show {
            transform: translateX(0);
        }
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            margin: 1rem;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .jumbotron {
            max-width: 800px;
            margin: auto;
            padding: 2rem;
        }
        .card img {
            height: 180px;
            object-fit: cover;
        }
        @media (min-width: 768px) {
            .menu-toggle { display: none; }
            .sidebar {
                transform: translateX(0);
                position: static;
                width: 250px;
            }
            .container {
                margin-left: 250px;
            }
        }
        @media (max-width: 767px) {
            .menu-toggle { display: block; }
            .jumbotron h1 { font-size: 1.8rem; }
            .jumbotron p { font-size: 1rem; }
            .card { margin-bottom: 1rem; }
            .card-title { font-size: 1.2rem; }
            .card-text { font-size: 0.9rem; }
        }
    </style>
</head>
<body class="bg-light">
    <!-- Botón de menú para móviles -->
    <div class="menu-toggle text-primary" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i> Menú
    </div>

    <?php include '../administracion/menu_lateral.php'; ?>

    <div class="container mt-5">
        <!-- Jumbotron de bienvenida -->
        <div class="jumbotron text-center bg-success text-white">
            <h1 class="display-4">Bienvenido al Portal Administrativo</h1>
            <p class="lead">Accede rápidamente a la gestión de créditos, pagos y tu perfil de usuario.</p>
            <hr class="my-4 bg-white">
            <p>Este portal está diseñado para el uso de Administradores, Asesores y Secretarias.</p>
        </div>

        <!-- Tarjetas principales -->
        <div class="row text-center">
            <!-- Gestión de Créditos -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="../../imagenes/credito.jpg" class="card-img-top" alt="Gestión de Créditos">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Créditos</h5>
                        <p class="card-text">Consulta, administra y realiza seguimiento de los créditos otorgados a los clientes.</p>
                        <a href="../../views/paginas/creditos.php" class="btn btn-outline-primary btn-sm">Ir a Créditos</a>
                    </div>
                </div>
            </div>

            <!-- Formas de Pago -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="../../imagenes/pagos.jpg" class="card-img-top" alt="Formas de Pago">
                    <div class="card-body">
                        <h5 class="card-title">Formas de Pago</h5>
                        <p class="card-text">Consulta y administra los métodos de pago disponibles y verifica los pagos registrados.</p>
                        <a href="../../views/paginas/formas_pago.php" class="btn btn-outline-success btn-sm">Ver Métodos</a>
                    </div>
                </div>
            </div>

            <!-- Perfil -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="../../imagenes/user.jpg" class="card-img-top" alt="Perfil de Usuario">
                    <div class="card-body">
                        <h5 class="card-title">Tu Perfil</h5>
                        <p class="card-text">Revisa y actualiza tus datos personales, credenciales y configuraciones básicas de cuenta.</p>
                        <a href="../../views/paginas/perfil.php" class="btn btn-outline-secondary btn-sm">Ver Perfil</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Beneficios -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white text-center">
                        <h4 class="mb-0">Beneficios de Usar este Portal</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Gestión Eficiente:</strong> Centraliza tus procesos de administración interna.</li>
                            <li><strong>Acceso Rápido:</strong> Ingresa fácilmente a las funciones más utilizadas.</li>
                            <li><strong>Interfaz Clara:</strong> Diseñada para tres roles con funciones específicas.</li>
                            <li><strong>Actualización Continua:</strong> Siempre en mejora según las necesidades reales del equipo.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
