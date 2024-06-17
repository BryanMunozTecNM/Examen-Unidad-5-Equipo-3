<?php
include 'includes/header.php';
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/niños.php');
require_once('ORM/padres.php');
$padreID = isset($_GET['id']) ? $_GET['id'] : null;
$db = new Database();
$encontrado = $db->verificarDriver();

?>


<div class="text-left">

    <div class="mb-3">
        <label for="nombrePadre">Nombres del Padre:</label>
        <input type="text" class="form-control" id="nombrePadre" readonly value="">
    </div>

    <div class="mb-3">
        <label for="telefonoPadre">Teléfono:</label>
        <input type="text" class="form-control" id="telefonoPadre" readonly value="">
    </div>
    <div class="text-left">
        <a href="insert_niño.php?id=<?= $padreID ?>" class="btn btn-success" data-title="Insertar" data-toggle="tooltip" title="Insert">
            <span class="glyphicon glyphicon-plus"></span> Añadir Niño
        </a>
    </div>
</div>
<?php
if ($encontrado) {
    $cnn = $db->getConnection();
    $padreModelo = new Padre($cnn);
    $padre = $padreModelo->getById($padreID);
    echo '
                <script>
                    document.getElementById(\'nombrePadre\').value = \'' . $padre['nombres'] . ' ' . $padre['apellidos'] . '\';
                    document.getElementById(\'telefonoPadre\').value = \'' . $padre['telefono'] . '\';
                </script>
            ';
}
?>
<script>
    $(document).ready(function() {
        $('#btnInsertar').click(function() {
            var nombre = $('input[name="nombre"]').val();
            var edad = $('input[name="edad"]').val();
            var peso = $('input[name="peso"]').val();
            var id_padre = $('input[name="id_padre"]').val();

            if (nombre === '' || edad === '' || peso === '') {
                alert('Por favor, completa todos los campos del formulario.');
                return;
            }

            var formData = new FormData();
            formData.append('nombre', nombre);
            formData.append('edad', edad);
            formData.append('peso', peso);
            formData.append('id_padre', id_padre);

            $.ajax({
                type: 'POST',
                url: 'inserta_niño.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    updateNiñosTable(id_padre);
                },
                error: function(xhr, status, error) {
                    console.error('Error al insertar niño:', error);
                }
            });
        });
    });
</script>

<?php
if ($encontrado) {
    $cnn = $db->getConnection();
    $niñoModelo = new Niño($cnn);

    if ($padreID !== null) {
        $niños = $niñoModelo->getByPadreId($padreID);
    }
    $padreModelo = new Padre($cnn);
    $padre = $padreModelo->getById($padreID);
}
?>

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="niñosTableBody">
        <thead>
            <tr>
                <th class="col-sm-1">ID</th>
                <th class="col-sm-2">Nombre</th>
                <th class="col-sm-4">Edad</th>
                <th class="col-sm-2">Peso</th>
                <th class="col-sm-1">Editar</th>
                <th class="col-sm-1">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($niños as $niño) : ?>
                <tr>
                    <td><?= $niño['id']; ?></td>
                    <td><?= $niño['nombre'] ?></td>
                    <td><?= $niño['edad']; ?></td>
                    <td><?= $niño['peso']; ?></td>
                    <td class="Editar">
                        <a href="update_niño.php?id=<?= $padre['id'] ?>&id_niño=<?= $niño['id'] ?>" class="btn btn-warning btn-xs" data-title="Edit" data-toggle="modal">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                    </td>
                    <td class="Eliminar">
                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                            <a href="delete_niño.php?id=<?= $niño['id']; ?>&id_padre=<?= $padreID ?>" class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </p>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>

</html>