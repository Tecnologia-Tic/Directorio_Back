<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "directorio";  // Nombre de la base de datos

// Verificar que los datos fueron enviados vía POST
if (isset($_POST['departamento'], $_POST['cargo'], $_POST['nombre'], $_POST['extension'], $_POST['correo'])) {
    $tabla = $_POST['departamento'];  // Tabla seleccionada

    // Valores para la actualización
    $cargo = $_POST['cargo'];
    $nombre = $_POST['nombre'];  // Se usará este para identificar el registro
    $extension = $_POST['extension'];
    $correo = $_POST['correo'];

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para actualizar
    $sql = "UPDATE $tabla SET cargo=?, extension=?, correo=? WHERE nombre=?";
    
    // Preparar la sentencia
    if ($query = $conn->prepare($sql)) {
        // Vincular los parámetros
        $query->bind_param("ssss", $cargo, $extension, $correo, $nombre);

        // Ejecutar la consulta
        if ($query->execute()) {
            echo json_encode(['mensaje' => 'Usuario actualizado correctamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar los datos del usuario']);
        }

        // Cerrar la consulta
        $query->close();
    } else {
        echo json_encode(['error' => 'Error al preparar la consulta']);
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Imprimir los datos que faltan para la depuración
    echo json_encode([
        'error' => 'Faltan datos para la actualización',
        'faltantes' => [
            'departamento' => isset($_POST['departamento']) ? 'ok' : 'falta',
            'cargo' => isset($_POST['cargo']) ? 'ok' : 'falta',
            'nombre' => isset($_POST['nombre']) ? 'ok' : 'falta',
            'extension' => isset($_POST['extension']) ? 'ok' : 'falta',
            'correo' => isset($_POST['correo']) ? 'ok' : 'falta',
        ]
    ]);
}
?>
