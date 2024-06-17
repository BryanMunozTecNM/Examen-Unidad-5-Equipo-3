<?php
// Incluir configuración de la base de datos y modelos necesarios
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/doctores.php'); // Asegúrate de tener el archivo ORM para doctores

// Verificar si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Variables recibidas del formulario
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $especialidad = $_POST['especialidad'] ?? '';

    // Verificar que los datos requeridos no estén vacíos
    if (!empty($id) && !empty($nombre) && !empty($apellidos) && !empty($especialidad)) {
        // Crear una instancia de la base de datos y del modelo de doctor
        $db = new Database();
        $encontrado = $db->verificarDriver();

        if ($encontrado) {
            $cnn = $db->getConnection();
            $doctorModelo = new Doctor($cnn);

            // Datos para actualizar
            $datosActualizacion = [
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'especialidad' => $especialidad,
            ];

            // Intentar actualizar en la base de datos
            if ($doctorModelo->updateById($id, $datosActualizacion)) {
                // Preparar respuesta JSON de éxito
                $response = [
                    'status' => 'success',
                    'message' => 'Doctor actualizado correctamente.'
                ];
            } else {
                // Preparar respuesta JSON de error
                $response = [
                    'status' => 'error',
                    'message' => 'Error al actualizar doctor.'
                ];
            }

            // Enviar respuesta JSON
            echo json_encode($response);
        }
    } else {
        // Preparar respuesta JSON si faltan datos
        $response = [
            'status' => 'error',
            'message' => 'Por favor, completa todos los campos.'
        ];
        echo json_encode($response);
    }
}
?>
