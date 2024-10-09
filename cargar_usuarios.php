<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "directorio"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el departamento fue enviado vía POST
if (isset($_POST['departamento'])) {
    $departamento = $_POST['departamento'];

    // Definir la consulta SQL dependiendo del departamento seleccionado
    if ($departamento == 'tecnologia') {
        $sql = "SELECT id, cargo, nombre, extension, correo FROM tecnologia";
    } elseif ($departamento == 'financiera') {
        $sql = "SELECT id, cargo, nombre, extension, correo FROM financiera";
    } elseif ($departamento == 'fundacion') {
        $sql = "SELECT id, cargo, nombre, extension, correo FROM fundacion";
    } elseif ($departamento == 'universidad') {
        $sql = "SELECT id, cargo, nombre, extension, correo FROM universidad";
    } elseif ($departamento == 'optimizacion') {
        $sql = "SELECT id, cargo, nombre, extension, correo FROM optimizacion";
    } elseif ($departamento == 'presidencia') {
        $sql = "SELECT id, cargo, nombre, extension, correo FROM presidencia";
    } else {
        echo json_encode(['error' => 'Departamento no válido']);
        exit();
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = [
                'id' => $row['id'],
                'cargo' => $row['cargo'],
                'nombre' => $row['nombre'],
                'extension' => $row['extension'],
                'correo' => $row['correo']
            ];
        }
        echo json_encode($usuarios);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(['error' => 'No se proporcionó departamento']);
}

$conn->close();
?>
