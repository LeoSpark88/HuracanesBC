<?php
// users.php
$servername = "localhost"; // Nombre del servidor, por defecto es localhost
$username = "root"; // Por defecto, el usuario es 'root'
$password = ""; // Por defecto, la contraseña está vacía
$dbname = "huracanes_db"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Termina el script si hay un error de conexión
}

// Verificar si se solicita eliminar un usuario
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Convierte el ID a un entero para mayor seguridad
    $sql = "DELETE FROM jugadores WHERE id = $id"; // Consulta para eliminar el usuario

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Usuario eliminado con éxito."]); // Mensaje de éxito
    } else {
        echo json_encode(["error" => "Error al eliminar el usuario: " . $conn->error]); // Mensaje de error
    }
    $conn->close(); // Cerrar la conexión a la base de datos
    exit; // Terminar el script aquí
}

// Consulta para obtener los usuarios
$sql = "SELECT id, nombre AS nombre_completo, email AS correo_electronico, posición AS posicion, altura FROM jugadores"; // Consulta SQL para seleccionar los usuarios
$result = $conn->query($sql); // Ejecutar la consulta

$users = array(); // Array para almacenar los usuarios

if ($result->num_rows > 0) {
    // Salida de cada fila
    while($row = $result->fetch_assoc()) {
        $users[] = $row; // Agregar cada usuario al array
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json'); // Establecer el encabezado para el tipo de contenido JSON
echo json_encode($users); // Convertir el array de usuarios a JSON y devolverlo

// Cerrar conexión
$conn->close(); // Cerrar la conexión a la base de datos
?>
