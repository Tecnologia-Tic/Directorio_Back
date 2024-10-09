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

// Verificar si los datos fueron enviados vía POST
if (isset($_POST['departamento']) && isset($_POST['usuario'])) {
    $departamento = $_POST['departamento'];
    $usuario_id = $_POST['usuario'];

    // Definir la tabla según el departamento
    $tabla = "";
    if ($departamento == 'tecnologia') {
        $tabla = "tecnologia";
    } elseif ($departamento == 'financiera') {
        $tabla = "financiera";
    } elseif ($departamento == 'fundacion') {
        $tabla = "fundacion";
    } elseif ($departamento == 'universidad') {
        $tabla = "universidad";
    } elseif ($departamento == 'optimizacion') {
        $tabla = "optimizacion";
    } elseif ($departamento == 'presidencia') {
        $tabla = "presidencia";
    }

    // Preparar la consulta de eliminación
    $sql = "DELETE FROM $tabla WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);

    if ($stmt->execute()) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No se proporcionaron los datos necesarios.";
}

$conn->close();
?>
