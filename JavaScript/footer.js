// Obtiene el formulario y el campo de entrada de la contraseña
const form = document.getElementById('adminForm');
const passwordInput = document.getElementById('passwordInput');

// Agrega un evento "submit" al formulario para interceptar el envío
form.addEventListener('submit', function(event) {
    // Evita que el formulario se envíe de manera predeterminada
    event.preventDefault();
    
    // Verifica si el valor del campo de contraseña es igual a "Huracan2"
    if (passwordInput.value === 'Huracan2') {
        // Si la contraseña es correcta, redirige a la página indicada
        window.location.href = 'http://localhost/Proyecto(HuracanesBasketClub)/registro/horario/';
    } else {
        // Si la contraseña es incorrecta, muestra un mensaje de alerta
        alert('Contraseña incorrecta. Inténtalo de nuevo.');
    }
});
