<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/Proyecto final/CSS/styles.css">
    <style>
        .table-striped thead tr th {
            background-color: #444; 
            color: #fff; 
        }
    </style>
</head>
<body>
    <header width="100%">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="#" class="navbar-brand">
                <img width="40px" height="40px" src="img/doc-logo.png" alt="mi img">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" id="login-link" class="nav-link text-white">Bienvenida Admin, Bryan</a>
                    </li>
                    <li class="nav-item">
                        <a href="Final/inicio.html" class="nav-link text-white">Inicio</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </header>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <h1 class="h1 text-center text-white">DOCTORES</h1>
        </div>
    </nav>
    
    <?php
    require_once('ORM/Database.php');
    require_once('ORM/orm.php');
    require_once('ORM/doctores.php');
    
    $db = new Database();
    $encontrado = $db->verificarDriver();
    ?>
    
    <div class="text-left">
        <a href="insert_doctor.php" class="btn btn-success" data-title="Insertar" data-toggle="tooltip" title="Insert">
            <span class="glyphicon glyphicon-plus"></span> Añadir Doctor
        </a>
    </div>
    
    <?php
    if ($encontrado) {
        $cnn = $db->getConnection();
        $doctorModelo = new Doctor($cnn);
        $doctores = $doctorModelo->getAll();
    }
    ?>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="col-sm-1">ID</th>
                    <th class="col-sm-2">Nombres</th>
                    <th class="col-sm-4">Apellidos</th>
                    <th class="col-sm-2">Especialidad</th>
                    <th class="col-sm-1">Editar</th>
                    <th class="col-sm-1">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doctores as $doctor): ?>
                    <tr>
                        <td><?= $doctor['id']; ?></td>
                        <td><?= $doctor['nombre']; ?></td>
                        <td><?= $doctor['apellidos']; ?></td>
                        <td><?= $doctor['especialidad']; ?></td>
                        <td class="Editar">
                            <a href="update_doctor.php?id=<?= $doctor['id']; ?>" class="btn btn-warning btn-xs" data-title="Edit" data-toggle="modal">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </td>
                        <td class="Eliminar">
                            <p data-placement="top" data-toggle="tooltip" title="Delete">
                                <a href="javascript:void(0);" onclick="confirmarEliminar(<?= $doctor['id']; ?>)" class="btn btn-danger btn-xs">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Estás seguro que deseas eliminar este doctor?')) {
                window.location.href = 'delete_doctor.php?id=' + id;
            }
        }
    </script>
</body>
</html>
