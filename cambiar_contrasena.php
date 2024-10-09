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

$correo_electronico = $_POST['correo_electronico'];
$contrasena_nueva = $_POST['contrasena_nueva']; // Sin encriptar

$query = $conn->prepare("UPDATE registros SET contrasena = ? WHERE correo_electronico = ?");
$query->bind_param("ss", $contrasena_nueva, $correo_electronico);

if ($query->execute()) {
    echo "Contraseña actualizada.";
} else {
    echo "Error al actualizar la contraseña.";
}
?>
