<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('./ORM/usuarios.php');

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $usuarioModelo = new Usuario($cnn);
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['login'];

        if (!empty($id) && !empty($nombres) && !empty($apellidos) && !empty($usuario)) {

            $datosActualizacion = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'login' => $usuario,
            ];

            if ($usuarioModelo->updateById($id, $datosActualizacion)) {
                echo 'Datos actualizados correctamente.';
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "./Final/inicioPadre.php";
                        });
                      </script>';
                exit();
            } else {
                echo 'Error al actualizar datos.';
            }
        } else {
            echo 'Por favor, completa todos los campos del formulario.';
        }
    }
}
