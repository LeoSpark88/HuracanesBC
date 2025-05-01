(function() {
    // Selecciona el botón que abre el menú, el menú en sí y el botón que cierra el menú
    const openButton = document.querySelector('.nav__menu');
    const menu = document.querySelector('.nav__link');
    const closeMenu = document.querySelector('.nav__close');

    // Añade un evento de clic al botón de abrir menú
    openButton.addEventListener('click', () => {
        menu.classList.add('nav__link--show'); // Agrega la clase que muestra el menú
    });

    // Añade un evento de clic al botón de cerrar menú
    closeMenu.addEventListener('click', () => {
        menu.classList.remove('nav__link--show'); // Remueve la clase que oculta el menú
    });
})();