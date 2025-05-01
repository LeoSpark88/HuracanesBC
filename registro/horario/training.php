<?php
// Primero, establece la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "basketball_manager"; // Nombre de la base de datos

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) { // Si hay un error de conexión
    die("Connection failed: " . $conn->connect_error); // Termina el script e imprime el error
}

// Establece el tipo de contenido de la respuesta a JSON
header('Content-Type: application/json');

// Verifica si la solicitud es un POST y si se ha enviado el formulario de creación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Obtiene los datos del formulario
    $lugar = $_POST['lugar']; // Lugar del entrenamiento
    $fecha = $_POST['fecha']; // Fecha del entrenamiento
    $hora = $_POST['hora']; // Hora del entrenamiento
    $categoria = $_POST['categoria']; // Categoría del entrenamiento

    // Preparar la consulta SQL para insertar un nuevo entrenamiento
    $sql = "INSERT INTO training_sessions (lugar, fecha, hora, categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Prepara la consulta
    $stmt->bind_param("ssss", $lugar, $fecha, $hora, $categoria); // Vincula los parámetros
    $stmt->execute(); // Ejecuta la consulta

    // Redirige a la página de entrenamientos después de la inserción
    header('Location: training.html');
    exit(); // Finaliza el script
}

// Consulta para seleccionar todos los entrenamientos
$sql = "SELECT * FROM training_sessions";
$result = $conn->query($sql); // Ejecuta la consulta

$trainings = array(); // Inicializa un array para almacenar los entrenamientos
if ($result->num_rows > 0) { // Si hay resultados
    while($row = $result->fetch_assoc()) { // Recorre cada fila del resultado
        $trainings[] = $row; // Añade la fila al array de entrenamientos
    }
}

// Devuelve los entrenamientos en formato JSON
echo json_encode($trainings);

// Cierra la conexión al final (opcional)
$conn->close(); // Cierra la conexión a la base de datos
?>



