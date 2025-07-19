<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <!-- Bootstrap y estilos base -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            margin-left: 250px;
            padding: 25px;
        }
        .jumbotron {
            padding: 2rem 1.5rem;
            background-color: #012b7e;
            color: white;
            border-radius: 8px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .card img {
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #012b7e;
        }
        .btn-sm-custom {
            padding: 5px 15px;
            font-size: 0.85rem;
            border-radius: 20px;
        }
        .card-body p {
            font-size: 0.9rem;
        }
        @media (max-width: 767px) {
            .container {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<?php include '../administracion/menu_lateral.php'; ?>

<div class="container mt-4">

    <div class="jumbotron text-center">
        <h2 class="mb-3">Panel Administrativo</h2>
        <p class="lead mb-0">Gestión interna para roles: Administrador, Asesor y Secretaria.</p>
    </div>

    <div class="row text-center">
        <!-- Créditos -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="../../imagenes/credito.jpg" class="card-img-top" alt="Créditos">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Créditos</h5>
                    <p>Administra los créditos otorgados a clientes.</p>
                    <a href="../../views/paginas/creditos.php" class="btn btn-primary btn-sm-custom">
                        <i class="fas fa-file-invoice-dollar"></i> Créditos
                    </a>
                </div>
            </div>
        </div>

        <!-- Formas de Pago -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="../../imagenes/formas de pago.png" class="card-img-top" alt="Pagos">
                <div class="card-body">
                    <h5 class="card-title">Formas de Pago</h5>
                    <p>Consulta y gestiona los pagos realizados.</p>
                    <a href="../../views/paginas/formas_pago.php" class="btn btn-success btn-sm-custom">
                        <i class="fas fa-credit-card"></i> Pagos
                    </a>
                </div>
            </div>
        </div>

        <!-- Perfil -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="../../imagenes/user.jpg" class="card-img-top" alt="Perfil">
                <div class="card-body">
                    <h5 class="card-title">Perfil de Usuario</h5>
                    <p>Consulta y edita tu perfil y credenciales.</p>
                    <a href="../../views/paginas/perfil.php" class="btn btn-dark btn-sm-custom">
                        <i class="fas fa-user-cog"></i> Perfil
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
