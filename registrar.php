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

$nombre_usuario = $_POST['nombre_usuario'];
$correo_electronico = $_POST['correo_electronico'];
$contrasena = $_POST['contrasena'];  // No se encripta

$query = $conn->prepare("INSERT INTO registros (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)");
$query->bind_param("sss", $nombre_usuario, $correo_electronico, $contrasena);

if ($query->execute()) {
    echo "Registro exitoso.";
} else {
    echo "Error al registrar.";
}
?>
