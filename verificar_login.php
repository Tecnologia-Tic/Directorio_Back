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
$contrasena = $_POST['contrasena'];  // Sin encriptar

$query = $conn->prepare("SELECT * FROM registros WHERE nombre_usuario = ?");
$query->bind_param("s", $nombre_usuario);
$query->execute();
$resultado = $query->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    if ($contrasena == $usuario['contrasena']) {
        header("Location: ../front/formulario.html");  // Redirige al formulario
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "No existe el usuario.";
}
?>
