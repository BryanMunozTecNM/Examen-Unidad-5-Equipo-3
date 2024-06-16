<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/padres.php');

$db = new Database();
$encontrado = $db->verificarDriver();

if ($encontrado) {
    $cnn = $db->getConnection();
    $padresModelo = new Padre($cnn);

    $idPadre = isset($_GET['id']) ? $_GET['id'] : null;

    if ($idPadre) {
        if ($padresModelo->deleteById($idPadre)) {
            header('Location: padres.php');
            exit();
        } else {
            echo 'No existe padre con dicho ID';
        }
    } else {
        echo 'El ID del padre no fue proporcionado';
    }
}
?>
