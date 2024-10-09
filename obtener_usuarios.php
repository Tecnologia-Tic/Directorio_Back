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

// Verificar si se envió un departamento
if (isset($_POST['departamento'])) {
    $departamento = $_POST['departamento'];

    // Si se envió un ID de usuario, obtener los datos de ese usuario
    if (isset($_POST['id'])) {
        $usuarioId = $_POST['id'];
        $sql = "SELECT id, cargo, nombre, extension, correo FROM $departamento WHERE id = $usuarioId";
    } else {
        // De lo contrario, obtener todos los usuarios de ese departamento
        $sql = "SELECT id, cargo, nombre FROM $departamento";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = [
                'id' => $row['id'],
                'cargo' => $row['cargo'],
                'nombre' => $row['nombre'],
                'extension' => isset($row['extension']) ? $row['extension'] : '',
                'correo' => isset($row['correo']) ? $row['correo'] : ''
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
