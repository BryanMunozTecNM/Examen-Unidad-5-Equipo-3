<?php
$dsn = 'mysql:host=localhost;dbname=hospital_del_niño';
$user = 'root';
$pass = '';

// Establecer la conexión PDO
try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Error de conexión: ' . $e->getMessage()));
    exit;
}

// Verificar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $especialidad = $_POST['especialidad'];

    // Validar los campos requeridos
    if (empty($nombre) || empty($apellidos) || empty($especialidad)) {
        echo json_encode(array('status' => 'error', 'message' => 'Todos los campos son obligatorios.'));
        exit;
    }

    // Preparar la consulta SQL para insertar el doctor
    $sql = "INSERT INTO doctores (nombre, apellidos, especialidad) 
            VALUES (:nombre, :apellidos, :especialidad)";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':especialidad', $especialidad);

    // Ejecutar la consulta
    try {
        $stmt->execute();
        echo json_encode(array('status' => 'success', 'message' => 'Doctor agregado correctamente.'));
    } catch (PDOException $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Error al agregar el doctor: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Método de solicitud incorrecto.'));
}
?>




