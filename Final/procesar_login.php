<?php
// Establecer las credenciales de la base de datos
$host = 'localhost';
$dbname = 'hospital_del_niño';
$user = 'root';
$password = '';

// Conectar a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Obtener los datos del formulario
$login = $_POST['username'];
$pwd = $_POST['password'];

// Consultar la base de datos para verificar las credenciales
$query = $pdo->prepare("SELECT * FROM usuarios WHERE login = ? AND pwd = ?");
$query->execute([$login, $pwd]);
$userData = $query->fetch(PDO::FETCH_ASSOC);

// Verificar si las credenciales son válidas
if ($userData) {
    // Las credenciales son válidas, redirigir a la página HTML
    header("Location: inicio.html");
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    // Las credenciales son inválidas, mostrar mensaje de error
    echo "Usuario o contraseña incorrectos.";
}
?>

