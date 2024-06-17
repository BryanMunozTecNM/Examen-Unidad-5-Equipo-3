<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/niños.php');

$db = new Database();
$encontrado = $db->verificarDriver();

if ($encontrado) {
    $cnn = $db->getConnection();
    $niñoModelo = new Niño($cnn);
    $id_padre = $_GET['id_padre'] ?? '';
    $idNiño = isset($_GET['id']) ? $_GET['id'] : null;

    if ($idNiño) {
        if ($niñoModelo->deleteById($idNiño)) {
            header('Location: niños.php?id=' . $id_padre);
            exit();
        } else {
            echo 'No existe ese Niño para eliminar con ese ID';
        }
    } else {
        echo 'ID de niño no proporcionado';
    }
}
?>
