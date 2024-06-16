<?php
$dsn = 'mysql:host=localhost;dbname=hospital_del_niño';
$user = 'root';
$pass = '';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];

    // Validación en servidor
    if (empty($nombres) || empty($apellidos) || empty($telefono)) {
        echo "Todos los campos son obligatorios.";
        // Aquí podrías redirigir al usuario de vuelta al formulario con un mensaje
        exit;
    }
    // Insertar con PDO
    $sql = "INSERT INTO padres (nombres, apellidos, telefono) 
                VALUES (:nombres, :apellidos, :telefono)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':telefono', $telefono);

    $stmt->execute();
    // Obtener id generado
    $padre_id = $conn->lastInsertId();

    //header("Location: niñodisenio.php");
    header("Location: insertar_niño.php?padre_id=$padre_id");
    //header("Location: niñodisenio.php?padre_id=" . urlencode($padre_id));
    exit;
}
