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
        /* Estilos generales */
        body {
            display: flex;
            flex-direction: column;
        }

        /* Estilos para el menú lateral en dispositivos móviles */
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

        /* Ajustes de centrado y márgenes */
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

        /* Media queries */
        @media (min-width: 768px) {
            /* Ajustes para pantallas grandes */
            .menu-toggle {
                display: none;
            }
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
            /* Ajustes para dispositivos móviles */
            .menu-toggle {
                display: block;
            }
            .jumbotron h1 {
                font-size: 1.8rem;
            }
            .jumbotron p {
                font-size: 1rem;
            }
            .card {
                margin-bottom: 1rem;
            }
            .card-title {
                font-size: 1.2rem;
            }
            .card-text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body class="bg-light">
    <!-- Botón de menú para dispositivos móviles -->
    <div class="menu-toggle text-primary" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i> Menú
    </div>

    <?php include '../administracion/menu_lateral.php'; ?>

  <div class="row text-center">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="../../imagenes/user.jpg" class="card-img-top" alt="Perfil">
            <div class="card-body">
                <h5 class="card-title">Tu Perfil</h5>
                <p class="card-text">Administra tu información personal y ajusta tu perfil para mejorar tu experiencia en nuestra plataforma.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="../../imagenes/credito.jpg" class="card-img-top" alt="Créditos">
            <div class="card-body">
                <h5 class="card-title">Gestión de Créditos</h5>
                <p class="card-text">Consulta tus créditos disponibles, historial y plazos de pago fácilmente desde esta sección.</p>
                <a href="../../views/paginas/creditos.php" class="btn btn-outline-primary btn-sm">Ver Créditos</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="../../imagenes/pagos.jpg" class="card-img-top" alt="Formas de Pago">
            <div class="card-body">
                <h5 class="card-title">Formas de Pago</h5>
                <p class="card-text">Explora los métodos de pago disponibles y gestiona tus transacciones de manera segura.</p>
                <a href="../../views/paginas/formas_pago.php" class="btn btn-outline-success btn-sm">Ver Opciones</a>
            </div>
        </div>
    </div>
</div>


        <!-- Sección de Beneficios del Sistema -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white text-center">
                        <h4 class="mb-0">Beneficios de Usar Nuestro Portal</h4>
                    </div>
                    <div class="card-body">
                        <p>Disfruta de una experiencia mejorada con nuestro portal de clientes, que incluye:</p>
                        <ul>
                            <li><strong>Acceso Personalizado:</strong> Mantén y actualiza tu información fácilmente desde un solo lugar.</li>
                            <li><strong>Control Total:</strong> Configura tu perfil y preferencias para una experiencia adaptada a ti.</li>
                            <li><strong>Soporte Rápido:</strong> Resuelve tus dudas rápidamente a través de nuestra sección de ayuda.</li>
                            <li><strong>Seguridad y Privacidad:</strong> Tus datos están protegidos y accesibles solo para ti.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y funcionalidad de menú lateral -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para mostrar/ocultar el menú lateral en dispositivos móviles
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
