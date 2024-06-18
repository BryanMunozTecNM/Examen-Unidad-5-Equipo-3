<?php
session_start();

$id = $_SESSION['id'];
$username = $_SESSION['username'];

$host = 'localhost';
$dbname = 'hospital_del_niño';
$user = 'root';
$password = '';

require_once '../ORM/Database.php';
$db = new Database();

try {
    $connection = $db->getConnection();

    // Consulta SQL para verificar las credenciales
    $query = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $connection->prepare($query);
    $stmt->execute(['id' => $id]);

    // Obtener el resultado de la consulta
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/styles.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <!-- jQuery y Popper.js (para Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper@1.16.1/dist/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
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
                                <a class="dropdown-item" href="./modificarUsuario.php">Modificar Usuario</a>
                                <a class="dropdown-item" href="index.html">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="container mt-3" id="contenedorTablaFormulario">
        <form action="../update_user.php" method="POST" id="formActualizacion">
            <h1 class="text-center">Actualizar Datos</h1>
            <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>">

            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" name="nombres" value="<?php echo $userData['nombres'] ?? ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" value="<?php echo $userData['apellidos'] ?? ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="especialidad" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="login" value="<?php echo $userData['login'] ?? ''; ?>" required>
            </div>
            <input type="submit" class="btn btn-primary" id="btnActualizar" value="Actualizar" />
        </form>
    </div>
</body>

</html>