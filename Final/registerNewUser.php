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
    $nombres = $_POST['rName'];
    $apellidos = $_POST['rLastName'];
    $login = $_POST['rUsername'];
    $pwd = $_POST['rPassword'];
    $rol = $_POST['rol'];

    // Validación en servidor
    if (empty($nombres) || empty($apellidos) || empty($login) || empty($pwd) || empty($rol)) {
        echo "Todos los campos son obligatorios.";
        // Aquí podrías redirigir al usuario de vuelta al formulario con un mensaje
        exit;
    }

    $pwdHash = password_hash($pwd, PASSWORD_BCRYPT);

    // Insertar con PDO
    $sql = "INSERT INTO usuarios (nombres, apellidos, login, pwd, rol) 
                VALUES (:nombres, :apellidos, :login, :pwd, :rol)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':pwd', $pwdHash);
    $stmt->bindParam(':rol', $rol);

    $stmt->execute();
    // Obtener id generado


    header("Location: index.html");
    exit;
}
