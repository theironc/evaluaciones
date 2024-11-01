<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del registro
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Eliminar el registro si el ID es válido
if ($id) {
    $sql = "DELETE FROM evaluaciones WHERE `evaluacion_id` = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirigir a la lista después de eliminar
        exit();
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
}

$conn->close();
?>
