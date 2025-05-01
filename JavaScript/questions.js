(function(){
    // Selecciona todas las preguntas con la clase 'questions__title' y las convierte en un array
    const titleQuestions = [...document.querySelectorAll('.questions__title')];
    console.log(titleQuestions); // Muestra las preguntas en la consola

    // Itera sobre cada pregunta y añade un evento de clic
    titleQuestions.forEach(question => {
        question.addEventListener('click', () => {
            let height = 0; // Inicializa la altura en 0
            let answer = question.nextElementSibling; // Selecciona el siguiente elemento (la respuesta)
            let addPadding = question.parentElement.parentElement; // Selecciona el contenedor padre

            // Alterna la clase para añadir o quitar padding
            addPadding.classList.toggle('questions__padding--add');
            // Alterna la clase para rotar la flecha (indicador de apertura/cierre)
            question.children[0].classList.toggle('questions__arrow--rotate');

            // Verifica si la respuesta está colapsada (altura 0)
            if (answer.clientHeight === 0) {
                height = answer.scrollHeight; // Si está colapsada, establece la altura a su scrollHeight (altura total)
            }

            // Establece la altura de la respuesta para crear el efecto de expansión
            answer.style.height = `${height}px`;
        });
    });
})();