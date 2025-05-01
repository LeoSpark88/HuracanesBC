<?php
// registro.php

// Conexión a la base de datos
$servername = "localhost"; // Dirección del servidor
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "huracanes_db"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Termina el script si no puede conectarse
}

// Recibir datos del formulario
// Se recomienda usar filter_input para sanitizar datos
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); // Asegúrate de que sea un número
$fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING); // Sanitiza el nombre
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); // Sanitiza el email
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña
$position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING); // Sanitiza la posición
$height = str_replace(',', '.', filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING)); // Cambiar la coma por un punto

// Insertar datos en la base de datos de manera segura
$sql = "INSERT INTO jugadores (id, nombre, email, contraseña, posición, altura) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql); // Preparar la consulta

if ($stmt) {
    // Vincular los parámetros
    $stmt->bind_param("isssss", $id, $fullName, $email, $password, $position, $height);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso"; // Mensaje de éxito
    } else {
        echo "Error al registrar: " . $stmt->error; // Mostrar error
    }
    $stmt->close(); // Cerrar el statement
} else {
    echo "Error en la preparación de la consulta: " . $conn->error; // Mostrar error de preparación
}

// Cerrar conexión
$conn->close(); // Finaliza la conexión a la base de datos
?>
