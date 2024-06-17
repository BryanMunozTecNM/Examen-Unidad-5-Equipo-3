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

function generarTablaDoctores($conn)
{
    $output = ""; // Inicio de la tabla

    $sql = "SELECT ID, Nombre, Apellidos, Especialidad FROM doctores";
    $resultado = $conn->query($sql);

    // Iterar resultados y construir la tabla
    while ($row = $resultado->fetch()) {
        $output .= "<tr>";
        $output .= "<th scope='row'>" . $row['ID'] . "</th>";
        $output .= "<td>" . $row['Nombre'] . "</td>";
        $output .= "<td>" . $row['Apellidos'] . "</td>";
        $output .= "<td>" . $row['Especialidad'] . "</td>";
        $output .= "<td><a href='detalle_doctor.php?id=" . $row['ID'] . "' class='btn btn-outline-info'><i class='fas fa-eye'></i> Detalles</a></td>";
        $output .= "<td><a href='editar_doctor.php?id=" . $row['ID'] . "' class='btn btn-outline-warning'><i class='fas fa-edit'></i> Editar</a></td>";
        $output .= "<td><a href='eliminar_doctor.php?id=" . $row['ID'] . "' class='btn btn-outline-danger'><i class='fas fa-trash-alt'></i> Eliminar</a></td>";
        $output .= "</tr>";
    }

    return $output;
}

echo generarTablaDoctores($conn);
?>
