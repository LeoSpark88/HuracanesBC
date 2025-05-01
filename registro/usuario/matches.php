<?php
// Primero, establece la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "basketball_manager"; // Nombre de la base de datos

// Crear conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    // Si hay un error en la conexión, se muestra un mensaje y se detiene la ejecución
    die("Connection failed: " . $conn->connect_error);
}

// Establece el tipo de contenido a JSON
header('Content-Type: application/json');

// Comprueba si se ha enviado una solicitud POST para crear un nuevo partido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Recibe los datos del formulario
    $lugar = $_POST['lugar']; // Lugar del partido
    $fecha = $_POST['fecha']; // Fecha del partido
    $hora = $_POST['hora']; // Hora del partido
    $categoria = $_POST['categoria']; // Categoría del partido
    $genero = $_POST['genero']; // Género del partido
    $equipo_local = $_POST['equipo_local']; // Nombre del equipo local
    $equipo_visitante = $_POST['equipo_visitante']; // Nombre del equipo visitante

    // Prepara la consulta SQL para insertar un nuevo partido
    $sql = "INSERT INTO matches (lugar, fecha, hora, categoria, genero, equipo_local, equipo_visitante) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Prepara la consulta
    // Vinca los parámetros a la consulta
    $stmt->bind_param("sssssss", $lugar, $fecha, $hora, $categoria, $genero, $equipo_local, $equipo_visitante);
    $stmt->execute(); // Ejecuta la consulta

    // Redirige a la página de partidos
    header('Location: matches.html');
    exit(); // Termina la ejecución del script
}

// Consulta para obtener todos los partidos de la base de datos
$sql = "SELECT * FROM matches";
$result = $conn->query($sql); // Ejecuta la consulta

$matches = array(); // Array para almacenar los partidos
if ($result->num_rows > 0) {
    // Si hay resultados, recorre cada fila y la añade al array
    while($row = $result->fetch_assoc()) {
        $matches[] = $row; // Añade la fila al array de partidos
    }
}

// Devuelve los partidos en formato JSON
echo json_encode($matches);

// Cierra la conexión al final (opcional)
$conn->close();
?>
