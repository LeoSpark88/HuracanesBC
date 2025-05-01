<?php
session_start(); // Inicia una nueva sesión o reanuda la sesión existente

// Datos de conexión a la base de datos
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "huracanes_db"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Termina el script si hay un error de conexión
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar datos del formulario
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); // Filtra el email
    $password = $_POST['password']; // Obtiene la contraseña (se asume que no necesita filtrado)

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Formato de email inválido"; // Mensaje de error si el email no es válido
    } else {
        // Preparar y ejecutar la consulta SQL para buscar el usuario por email
        $stmt = $conn->prepare("SELECT id, nombre, email, contraseña FROM jugadores WHERE email = ?");
        $stmt->bind_param("s", $email); // Vincula el parámetro
        $stmt->execute(); // Ejecuta la consulta
        $result = $stmt->get_result(); // Obtiene el resultado

        if ($result->num_rows === 1) { // Verifica si se encontró un usuario
            $user = $result->fetch_assoc(); // Obtiene los datos del usuario
            
            // Verificar la contraseña encriptada
            if (password_verify($password, $user['contraseña'])) { // Compara la contraseña ingresada con la almacenada
                // Inicio de sesión exitoso
                $_SESSION['user_id'] = $user['id']; // Almacena el ID del usuario en la sesión
                $_SESSION['user_name'] = $user['nombre']; // Almacena el nombre del usuario en la sesión
                $_SESSION['user_email'] = $user['email']; // Almacena el email del usuario en la sesión
                
                // Redirigir a la página de bienvenida
                header("Location: ../usuario/index.php"); // Cambia la ubicación a la página de usuario
                exit(); // Termina el script
            } else {
                $error = "Contraseña incorrecta"; // Mensaje de error si la contraseña es incorrecta
            }
        } else {
            $error = "Usuario no encontrado"; // Mensaje de error si no se encuentra el usuario
        }

        $stmt->close(); // Cierra la declaración preparada
    }
}

// Redirigir a la página de inicio de sesión con mensaje de error
if (isset($error)) {
    header("Location: login.html?error=" . urlencode($error)); // Redirige con un mensaje de error
    exit(); // Termina el script
}

$conn->close(); // Cierra la conexión a la base de datos
?>
