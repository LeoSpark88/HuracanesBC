<?php
// Primero, establece la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "basketball_manager"; // Nombre de la base de datos

// Crea una nueva conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) { // Si hay un error en la conexión
    die("Connection failed: " . $conn->connect_error); // Termina el script y muestra el error
}

// Establece el tipo de contenido de la respuesta como JSON
header('Content-Type: application/json');

// Verifica si se recibió una solicitud POST y si se ha indicado la creación de una sesión de entrenamiento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Obtiene los datos del formulario
    $lugar = $_POST['lugar']; // Lugar del entrenamiento
    $fecha = $_POST['fecha']; // Fecha del entrenamiento
    $hora = $_POST['hora']; // Hora del entrenamiento
    $categoria = $_POST['categoria']; // Categoría del entrenamiento

    // Prepara la consulta SQL para insertar los datos en la tabla de sesiones de entrenamiento
    $sql = "INSERT INTO training_sessions (lugar, fecha, hora, categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Prepara la declaración SQL
    $stmt->bind_param("ssss", $lugar, $fecha, $hora, $categoria); // Vincula los parámetros
    $stmt->execute(); // Ejecuta la consulta

    // Redirige a la página de entrenamientos después de la inserción
    header('Location: training.html');
    exit(); // Termina el script
}

// Consulta para seleccionar todas las sesiones de entrenamiento
$sql = "SELECT * FROM training_sessions"; 
$result = $conn->query($sql); // Ejecuta la consulta

$trainings = array(); // Inicializa un array para almacenar las sesiones de entrenamiento
if ($result->num_rows > 0) { // Verifica si hay resultados
    while($row = $result->fetch_assoc()) { // Itera a través de los resultados
        $trainings[] = $row; // Añade cada fila al array de entrenamientos
    }
}

// Devuelve los datos en formato JSON
echo json_encode($trainings);

// Cierra la conexión al final (opcional)
$conn->close();
?>


