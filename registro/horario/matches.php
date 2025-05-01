<?php
// Primero, establece la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor de la base de datos
$username = "root"; // Nombre de usuario para la base de datos
$password = ""; // Contraseña para la base de datos
$dbname = "basketball_manager"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Terminar el script si hay un error en la conexión
}

header('Content-Type: application/json'); // Establece el tipo de contenido a JSON

// Verificar si se solicita eliminar un partido
if (isset($_GET['delete'])) { // Comprobar si hay un parámetro 'delete' en la URL
    $id = intval($_GET['delete']); // Convertir el ID a un entero
    $sql = "DELETE FROM matches WHERE id = $id"; // Consulta SQL para eliminar el partido

    if ($conn->query($sql) === TRUE) { // Ejecutar la consulta
        // Redirigir a la misma página después de eliminar
        header("Location: matches.html"); // Redirigir a la página de partidos
        exit; // Terminar el script
    } else {
        echo json_encode(["error" => "Error al eliminar el partido: " . $conn->error]); // Enviar un mensaje de error en formato JSON
    }
}

// Manejo de la creación de un nuevo partido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) { // Comprobar si el método es POST y si se envió el formulario
    // Obtener los datos del formulario
    $lugar = $_POST['lugar'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $categoria = $_POST['categoria'];
    $genero = $_POST['genero'];
    $equipo_local = $_POST['equipo_local'];
    $equipo_visitante = $_POST['equipo_visitante'];

    // Consulta SQL para insertar un nuevo partido
    $sql = "INSERT INTO matches (lugar, fecha, hora, categoria, genero, equipo_local, equipo_visitante) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Preparar la consulta
    $stmt->bind_param("sssssss", $lugar, $fecha, $hora, $categoria, $genero, $equipo_local, $equipo_visitante); // Vincular parámetros
    $stmt->execute(); // Ejecutar la consulta

    header('Location: matches.html'); // Redirigir a la página de partidos
    exit(); // Terminar el script
}

// Consulta para obtener los partidos
$sql = "SELECT * FROM matches"; // Consulta para seleccionar todos los partidos
$result = $conn->query($sql); // Ejecutar la consulta

$matches = array(); // Array para almacenar los partidos
if ($result->num_rows > 0) { // Verificar si hay resultados
    while($row = $result->fetch_assoc()) { // Iterar sobre los resultados
        $matches[] = $row; // Agregar cada partido al array
    }
}

echo json_encode($matches); // Enviar los partidos en formato JSON

// Cierra la conexión al final (opcional)
$conn->close(); // Cerrar la conexión a la base de datos
?>
