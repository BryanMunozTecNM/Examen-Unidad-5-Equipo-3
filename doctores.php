<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctores</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5797ea773f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .navbar {
            background-color: #000;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            height: 50px;
        }

        .navbar-brand {
            font-size: 1em;
            font-weight: bold;
        }

        .navbar-nav li a {
            color: #fff;
            padding: 5px 20px;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 30px;
        }

        .navbar-nav li a.active {
            background-color: #fff;
            color: #000;
        }

        body {
            background-color: lightblue;
        }

        .h1 {
            font-size: 3em;
            color: black;
            background-color: whitesmoke;
            padding: 10px 20px;
            border-radius: 10px;
            text-transform: uppercase;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            margin-top: 60px;
        }

        .table {
            margin-top: 10px;
            border-color: black;
        }

        .table th {
            background-color: lightskyblue;
            color: white;
        }

        .btn-primary {
            background-color: green;
            border-color: black;
        }

        body {
            background-size: cover;
            background-image: url("img/Fondos de pantalla niños - FondosMil.jpg");
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/fondo-dibujos-animados-3d-ninos.jpg" alt="Logo">
                Programación web
            </a>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Bienvenido Admin. Bryan</a>
                </li>
            </ul>
        </div>
    </nav>

    <h1 class="h1 text-center">Doctores</h1>

    <!-- Contenedor div para el formulario y establece su estilo como "display: none;" para ocultarlo inicialmente: -->
    <div id="formularioDoctor" style="display: none;">
        <!-- Formulario para insertar un nuevo doctor -->
        <form action="insertar_doctor.php" method="POST" onsubmit="return validarFormulario()">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="doctores.php" class="btn btn-secondary">Regresar</a>
        </form>
    </div>

    <script>
        // Validaciones con jQuery
        $(document).ready(function() {
            $('#formularioDoctor').submit(function(e) {
                if ($('#nombre').val() == '') {
                    alert('Debe ingresar el nombre');
                    e.preventDefault();
                    return false;
                }
                if ($('#apellidos').val() == '') {
                    alert('Debe ingresar los apellidos');
                    e.preventDefault();
                    return false;
                }
                if ($('#especialidad').val() == '') {
                    alert('Debe ingresar la especialidad');
                    e.preventDefault();
                    return false;
                }
                // Otras validaciones aquí si es necesario
                return true;
            });
        });

        // Mostrar el formulario al hacer clic en el botón "+ Agregar doctor"
        function mostrarFormulario() {
            var formulario = document.getElementById("formularioDoctor");
            formulario.style.display = "block";

            var botonAgregarDoctor = document.querySelector('.btn.btn-primary.btn-lg.btn-block');
            botonAgregarDoctor.style.display = "none";
        }
    </script>

    <!-- Botón "Agregar doctor" -->
    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="mostrarFormulario()">+ Agregar Doctor</button>

    <!-- Tabla de Doctores -->
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Detalles</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dsn = 'mysql:host=localhost;dbname=hospital_del_niño';
            $user = 'root';
            $pass = '';

            try {
                $conn = new PDO($dsn, $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }

            function generarTablaDoctores($conn)
            {
                $output = ""; // Inicio de la tabla

                $sql = "SELECT ID, Nombre, Apellidos, Especialidad FROM doctores";
                $resultado = $conn->query($sql);

                // Iterar resultados y construir la tabla
                while ($row = $resultado->fetch()) {
                    $output .= "<tr>";
                    $output .= "<th scope='row'>" . $row['ID'] . "</th>";
                    $output .= "<td>" . $row['Nombre'] . "</td>";
                    $output .= "<td>" . $row['Apellidos'] . "</td>";
                    $output .= "<td>" . $row['Especialidad'] . "</td>";
                    $output .= "<td><a href='detalle_doctor.php?id=" . $row['ID'] . "' class='btn btn-outline-info'><i class='fas fa-eye'></i> Detalles</a></td>";
                    $output .= "<td><a href='editar_doctor.php?id=" . $row['ID'] . "' class='btn btn-outline-warning'><i class='fas fa-edit'></i> Editar</a></td>";
                    $output .= "<td><a href='eliminar_doctor.php?id=" . $row['ID'] . "' class='btn btn-outline-danger'><i class='fas fa-trash-alt'></i> Eliminar</a></td>";
                    $output .= "</tr>";
                }

                return $output;
            }

            echo generarTablaDoctores($conn);
            ?>
        </tbody>
    </table>

</body>

</html>
