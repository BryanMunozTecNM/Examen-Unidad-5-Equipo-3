<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/doctores.php');

$db = new Database();
$encontrado = $db->verificarDriver();

if ($encontrado) {
    $cnn = $db->getConnection();
    $doctoresModelo = new Doctor($cnn);

    $idDoctor = isset($_GET['id']) ? $_GET['id'] : null;

    if ($idDoctor) {
        if ($doctoresModelo->deleteById($idDoctor)) {
            header('Location: doctores.php');
            exit();
        } else {
            echo 'No existe ese doctor para eliminar con ese ID';
        }
    } else {
        echo 'ID de doctor no proporcionado';
    }
}
?>
