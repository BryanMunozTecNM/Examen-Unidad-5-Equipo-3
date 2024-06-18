<?php
session_start();

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
        .header-image {
            width: 100%;
            height: auto;
            max-height: 300px;
            /* Ajusta esta altura según tu preferencia */
            object-fit: cover;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
        }

        .dropdown-menu {
            text-align: center;
        }

        .welcome-avatar {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <header>
        <img src="/img/padre.jpg" alt="Fondo" class="header-image">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <a href="#" class="navbar-brand">
                    <img src="img/ico.ico" alt="Icono">
                    Progra Web
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle text-white" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/img/avatarP.png" alt="Avatar" class="rounded-circle welcome-avatar"> Bienvenido Padre <?php echo htmlspecialchars($username) ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./modificarUsuario.php">Áreas de Interés</a>
                                <a class="dropdown-item" href="index.html">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="container admin-container d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card admin-card text-center">
                <img src="../img/niño-admin.png" class="card-img-top" alt="Niños">
                <div class="card-body">
                    <h5 class="card-title">Niños</h5>
                    <p class="card-text">Administra la información de los niños.</p>
                    <a href="../niños.php?id=1" class="btn btn-success">Gestionar Niños</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>