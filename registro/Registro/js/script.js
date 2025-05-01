// Ejecutando funciones al cargar la página
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion); // Agrega un evento de clic para iniciar sesión
document.getElementById("btn__registrarse").addEventListener("click", register); // Agrega un evento de clic para registrarse
window.addEventListener("resize", anchoPage); // Agrega un evento para redimensionar la ventana

// Declarando variables
var formulario_login = document.querySelector(".formulario__login"); // Selecciona el formulario de inicio de sesión
var formulario_register = document.querySelector(".formulario__register"); // Selecciona el formulario de registro
var contenedor_login_register = document.querySelector(".contenedor__login-register"); // Selecciona el contenedor de los formularios
var caja_trasera_login = document.querySelector(".caja__trasera-login"); // Selecciona la caja trasera del formulario de inicio de sesión
var caja_trasera_register = document.querySelector(".caja__trasera-register"); // Selecciona la caja trasera del formulario de registro

// FUNCIONES

// Función para ajustar la apariencia según el ancho de la ventana
function anchoPage() {
    if (window.innerWidth > 850) { // Si el ancho de la ventana es mayor a 850px
        caja_trasera_register.style.display = "block"; // Muestra la caja trasera del registro
        caja_trasera_login.style.display = "block"; // Muestra la caja trasera del inicio de sesión
    } else {
        caja_trasera_register.style.display = "block"; // Siempre muestra la caja del registro
        caja_trasera_register.style.opacity = "1"; // Asegura que la caja del registro sea visible
        caja_trasera_login.style.display = "none"; // Oculta la caja del inicio de sesión
        formulario_login.style.display = "block"; // Muestra el formulario de inicio de sesión
        contenedor_login_register.style.left = "0px"; // Alinea el contenedor a la izquierda
        formulario_register.style.display = "none"; // Oculta el formulario de registro
    }
}

// Llama a la función al cargar la página para establecer el estado inicial
anchoPage();

// Función para iniciar sesión
function iniciarSesion() {
    if (window.innerWidth > 850) { // Si el ancho de la ventana es mayor a 850px
        formulario_login.style.display = "block"; // Muestra el formulario de inicio de sesión
        contenedor_login_register.style.left = "10px"; // Desplaza el contenedor hacia la izquierda
        formulario_register.style.display = "none"; // Oculta el formulario de registro
        caja_trasera_register.style.opacity = "1"; // Asegura que la caja del registro sea visible
        caja_trasera_login.style.opacity = "0"; // Oculta la caja del inicio de sesión
    } else {
        formulario_login.style.display = "block"; // Muestra el formulario de inicio de sesión
        contenedor_login_register.style.left = "0px"; // Alinea el contenedor a la izquierda
        formulario_register.style.display = "none"; // Oculta el formulario de registro
        caja_trasera_register.style.display = "block"; // Muestra la caja trasera del registro
        caja_trasera_login.style.display = "none"; // Oculta la caja trasera del inicio de sesión
    }
}

// Función para registrar un nuevo usuario
function register() {
    if (window.innerWidth > 850) { // Si el ancho de la ventana es mayor a 850px
        formulario_register.style.display = "block"; // Muestra el formulario de registro
        contenedor_login_register.style.left = "410px"; // Desplaza el contenedor hacia la derecha
        formulario_login.style.display = "none"; // Oculta el formulario de inicio de sesión
        caja_trasera_register.style.opacity = "0"; // Oculta la caja del registro
        caja_trasera_login.style.opacity = "1"; // Muestra la caja del inicio de sesión
    } else {
        formulario_register.style.display = "block"; // Muestra el formulario de registro
        contenedor_login_register.style.left = "0px"; // Alinea el contenedor a la izquierda
        formulario_login.style.display = "none"; // Oculta el formulario de inicio de sesión
        caja_trasera_register.style.display = "none"; // Oculta la caja trasera del registro
        caja_trasera_login.style.display = "block"; // Muestra la caja trasera del inicio de sesión
        caja_trasera_login.style.opacity = "1"; // Asegura que la caja del inicio de sesión sea visible
    }
}
