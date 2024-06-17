<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/niños.php');

// Obtener el ID del padre seleccionado
$selectedPadreId = isset($_GET['padreId']) ? $_GET['padreId'] : null;

// Inicializar la conexión a la base de datos
$db = new Database();
$encontrado = $db->verificarDriver();

// Verificar si se ha seleccionado un padre
if ($encontrado && $selectedPadreId !== null) {
    $cnn = $db->getConnection();
    $niñoModelo = new Niño($cnn);

    // Obtener solo lss niños asociadas al padre seleccionado
    $niños = $niñoModelo->getByPadreId($selectedPadreId);

    // Generar el HTML de la tabla de niños
    echo '<thead>';
    echo '<tr>';
    echo '<th class="col-sm-1">ID</th>';
    echo '<th class="col-sm-2">Nombre</th>';
    echo '<th class="col-sm-4">Edad</th>';
    echo '<th class="col-sm-2">Peso</th>';
    echo '<th class="col-sm-1">Editar</th>';
    echo '<th class="col-sm-1">Eliminar</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($niños as $niño) {
        echo '<tr>';
        echo '<td>' . $niño['id'] . '</td>';
        echo '<td>' . $niño['nombre'] . '</td>';
        echo '<td>' . $niño['edad'] . '</td>';
        echo '<td>' . $niño['peso'] . '</td>';
        echo '<td class="Editar">';
        echo '<a href="update_niño.php?id=' . $niño['id'] . '" class="btn btn-warning btn-xs" data-title="Edit" data-toggle="modal">';
        echo '<span class="glyphicon glyphicon-edit"></span>';
        echo '</a>';
        echo '</td>';
        echo '<td class="Eliminar">';
        echo '<p data-placement="top" data-toggle="tooltip" title="Delete">';
        echo '<a href="delete_niño.php?id=' . $niño['id'] . '" class="btn btn-danger btn-xs">';
        echo '<span class="glyphicon glyphicon-trash"></span>';
        echo '</a>';
        echo '</p>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
} else {
    // Manejar el caso cuando no se ha seleccionado un padre o hay un problema con la conexión
    echo '<tr><td colspan="6">No se pudieron cargar los niños.</td></tr>';
}
?>
