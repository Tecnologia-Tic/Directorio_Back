<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "directorio";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el método de la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cargo = $_POST['cargo'];
    $nombre = $_POST['nombre'];
    $extension = $_POST['extension'];
    $correo = $_POST['correo'];
    $tabla = $_POST['tabla']; // Recoger la tabla seleccionada del formulario

    // Verificar que se ha seleccionado una tabla válida
    if ($tabla === 'tecnologia' || $tabla === 'financiera' || $tabla === 'fundacion' || $tabla === 'universidad' || $tabla === 'optimizacion' || $tabla === 'presidencia') {
        // Insertar datos en la tabla seleccionada
        $sql = "INSERT INTO $tabla (cargo, nombre, extension, correo) 
                VALUES ('$cargo', '$nombre', '$extension', '$correo')";

        if ($conn->query($sql) === TRUE) {
            echo "Nuevo registro creado exitosamente en la tabla $tabla";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Tabla no válida seleccionada.";
    }

    // Redirigir de vuelta al directorio
    header("Location: ../directorio.html");
    exit();
} else {
    echo "Método no permitido.";
}

// Cerrar conexión
$conn->close();
?>
