<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "directorio";  // Nombre de tu base de datos



// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar qué departamento se solicitó
$departamento = isset($_GET['departamento']) ? $_GET['departamento'] : '';

if ($departamento == '1') {
    $sql = "SELECT id, cargo, nombre, extension, correo FROM tecnologia";
} elseif ($departamento == '2') {
    $sql = "SELECT id, cargo, nombre, extension, correo FROM financiera";
} elseif ($departamento == '3') {
    $sql = "SELECT id, cargo, nombre, extension, correo FROM fundacion";
} elseif ($departamento == '4') {
    $sql = "SELECT id, cargo, nombre, extension, correo FROM universidad";  // Corregido
} elseif ($departamento == '5') {
    $sql = "SELECT id, cargo, nombre, extension, correo FROM optimizacion";
} elseif ($departamento == '6') {
    $sql = "SELECT id, cargo, nombre, extension, correo FROM presidencia";
} else {
    echo "<tr><td colspan='5'>Departamento no válido</td></tr>";
    exit();
}

$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);  // Manejo de errores
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['cargo'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['extension'] . "</td>";
        echo "<td>" . $row['correo'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay datos en la tabla</td></tr>";
}

$conn->close();



?>

