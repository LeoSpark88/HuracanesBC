<?php
session_start(); // Inicia la sesión para poder usar variables de sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) { // Si no hay un ID de usuario en la sesión
    header("Location: login.html"); // Redirige a la página de inicio de sesión
    exit(); // Termina el script para evitar que se ejecute código adicional
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece el tipo de carácter a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Gestor de Baloncesto</title> <!-- Título de la página -->
    <link rel="stylesheet" href="stayle2.css"> <!-- Enlace al archivo de estilos CSS -->
</head>
<body>
    <div class="container"> <!-- Contenedor principal -->
        <nav> <!-- Navegación principal -->
            <ul> <!-- Lista de navegación -->
                <li><a href="index.php">Inicio</a></li> <!-- Enlace a la página de inicio -->
                <li><a href="users.php">Mi perfil</a></li> <!-- Enlace al perfil del usuario -->
                <li><a href="training.html">Entrenamientos</a></li> <!-- Enlace a la página de entrenamientos -->
                <li><a href="matches.html">Partidos</a></li> <!-- Enlace a la página de partidos -->
            </ul>
            <ul> <!-- Lista de navegación para cerrar sesión -->
                <li><a href="../Registro/logout.php">Cerrar sesión</a></li> <!-- Enlace para cerrar sesión -->
            </ul>
        </nav>
        <main> <!-- Contenido principal -->
            <header> <!-- Encabezado principal -->
                <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1> <!-- Muestra el nombre del usuario -->
            </header>
            <h2>Has iniciado sesión correctamente en tu cuenta de Huracanes.</h2> <!-- Mensaje de bienvenida -->
            <p>Tu correo electrónico es: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p> <!-- Muestra el correo electrónico del usuario -->
        </main>
    </div>
</body>
</html>


