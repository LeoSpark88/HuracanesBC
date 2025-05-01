(function() {
    // Selecciona todos los elementos con la clase 'testimony__body' y los convierte en un array
    const sliders = [...document.querySelectorAll('.testimony__body')];
    
    // Selecciona los botones de navegación
    const buttonNext = document.querySelector('#next');
    const buttonBefore = document.querySelector('#before');
    let value;

    // Añade un evento para el botón de "Siguiente"
    buttonNext.addEventListener('click', () => {
        changePosition(1); // Llama a changePosition con un incremento positivo
    });

    // Añade un evento para el botón de "Anterior"
    buttonBefore.addEventListener('click', () => {
        changePosition(-1); // Llama a changePosition con un incremento negativo
    });

    // Función para cambiar la posición del testimonio visible
    const changePosition = (add) => {
        // Obtiene el ID del testimonio actualmente visible
        const currentTestimony = document.querySelector('.testimony__body--show').dataset.id;
        
        // Convierte el ID actual en un número para realizar operaciones
        value = Number(currentTestimony);
        value += add;

        // Oculta el testimonio actual
        sliders[Number(currentTestimony) - 1].classList.remove('testimony__body--show');

        // Si el índice es mayor al total o menor que 1, se ajusta para hacer un bucle
        if (value === sliders.length + 1 || value === 0) {
            value = value === 0 ? sliders.length : 1;
        }

        // Muestra el nuevo testimonio
        sliders[value - 1].classList.add('testimony__body--show');
    }
})();