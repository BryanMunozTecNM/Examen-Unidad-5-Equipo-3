<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('niños.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $niñoModelo = new Niño($cnn);
        $id_niño = $_POST['id_niño'] ?? '';
        $id_padre = $_GET['id'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $edad = $_POST['edad'] ?? '';
        $peso = $_POST['peso'] ?? '';

        if (!empty($id_niño) && !empty($nombre) && !empty($edad) && !empty($peso) && !empty($id_padre)) {

            $datosActualizacion = [
                'nombre' => $nombre,
                'edad' => $edad,
                'peso' => $peso,
            ];

            if ($niñoModelo->updateById($id_niño, $datosActualizacion)) {
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "niños.php?id=' . $id_padre . '";
                        });
                      </script>';
                exit();
            } else {
                echo 'Error al actualizar datos.';
            }
        } else {
            echo 'Por favor, completa todos los campos del formulario 1.';
        }
    }
} else {
    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $niñoModelo = new Niño($cnn);

        $id = $_GET['id_niño'] ?? '';  // Cambiado de 'id' a 'id_niño'

        if (!empty($id)) {
            $niño = $niñoModelo->getById($id);

            if ($niño) {
                $id_niño = $niño['id'];  // Cambiado de 'id' a 'id_niño'
                $nombre = $niño['nombre'];
                $edad = $niño['edad'];
                $peso = $niño['peso'];
            } else {
                echo 'Niño no encontrado.';
                exit();
            }
        } else {
            echo 'ID de niño no proporcionado.';
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        #contenedorTablaFormulario {
            min-height: 500px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container mt-3" id="contenedorTablaFormulario">
        <?php if (!isset($_POST) || empty($_POST)) { ?>
            <h2>Formulario</h2>
            <form action="" method="post" id="formActualizacion">

                <input type="hidden" name="id_niño" value="<?php echo $id_niño ?? ''; ?>"> <!-- Cambiado de 'id' a 'id_niño' -->

                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?? ''; ?>" required readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad:</label>
                    <input type="text" class="form-control" name="edad" value="<?php echo $edad ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Peso:</label>
                    <input type="text" class="form-control" name="peso" value="<?php echo $peso ?? ''; ?>" required>
                </div>
                <button type="button" class="btn btn-primary" id="btnActualizar">Actualizar</button>
            </form>
    </div>
<?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btnActualizar').click(function() {
            var id_niño = $('input[name="id_niño"]').val(); // Cambiado de 'id' a 'id_niño'
            var nombre = $('input[name="nombre"]').val();
            var edad = $('input[name="edad"]').val();
            var peso = $('input[name="peso"]').val();

            if (id_niño === '' || nombre === '' || edad === '' || peso === '') {
                alert('Por favor, completa todos los campos del formulario 2.');
                return;
            }

            $('#formActualizacion').submit();
        });
    });
</script>

</body>

</html>