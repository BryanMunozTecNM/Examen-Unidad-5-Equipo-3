<?php
$dsn = 'mysql:host=localhost;dbname=hospital_del_niño';
$user = 'root';
$pass = '';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Error de conexión: ' . $e->getMessage()));
    exit();
}

$sql = "SELECT ID, Nombre, Apellidos, Especialidad FROM doctores";
$resultado = $conn->query($sql);

$doctores = array();
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $doctores[] = $row;
}

echo json_encode($doctores);
?>

