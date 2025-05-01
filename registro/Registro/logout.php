<?php
session_start(); // Inicia la sesión para poder acceder a las variables de sesión

// Destruir todas las variables de sesión
$_SESSION = array(); // Limpia todas las variables de sesión almacenadas

// Destruir la sesión
session_destroy(); // Finaliza la sesión y libera todos los recursos asociados a ella

// Redirigir a la página de inicio de sesión
header("Location: http://localhost/Proyecto(HuracanesBasketClub)/PaginaConTodo/index.html"); // Redirige al usuario a la página de inicio de sesión
exit(); // Termina el script para asegurarse de que no se ejecute más código
?>

