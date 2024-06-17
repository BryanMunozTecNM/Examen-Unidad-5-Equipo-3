<?php

// Establecer las credenciales de la base de datos
$host = 'localhost';
$dbname = 'hospital_del_niño';
$user = 'root';
$password = '';

session_start();


// Incluir la clase Database (ajusta la ruta según la estructura de tu proyecto)
require_once '../ORM/Database.php';

// Obtener los datos del formulario
$login = $_POST['username'];
$pwd = $_POST['password'];

// Crear instancia de la clase Database
$db = new Database();

try {
    // Establecer la conexión a la base de datos
    $connection = $db->getConnection();

    // Consulta SQL para verificar las credenciales
    $query = "SELECT * FROM usuarios WHERE login = :login AND pwd = :pwd";
    $stmt = $connection->prepare($query);
    $stmt->execute([
        'login' => $login,
        'pwd' => $pwd,
    ]);

    // Obtener el resultado de la consulta
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si las credenciales son válidas
    if ($userData) {
        // Las credenciales son válidas, guardar información en la sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $userData['login'];

        // Determinar el rol del usuario
        $rol = $userData['rol'];

        // Redirigir según el rol
        switch ($rol) {
            case 'ADMIN':
                header("Location: inicioAdmin.html");
                break;
            case 'PADRE':
                header("Location: inicioPadre.html");
                break;
            case 'DOC':
                header("Location: inicioDoc.html");
                break;
            default:
                // Por defecto, redirigir a algún lugar
                header("Location: index.html");
                break;
        }
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        // Las credenciales son inválidas, redirigir de nuevo al formulario con un mensaje de error
        header("Location: index.html?error=1");
        exit(); // Asegura que el script se detenga después de la redirección
    }
} catch (PDOException $e) {
    // Capturar cualquier error de conexión o consulta
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>

