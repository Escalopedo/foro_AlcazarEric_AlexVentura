document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formNuevaPregunta");
    const tituloInput = document.getElementById("titulo_nueva_pregunta");
    const contenidoTextarea = document.getElementById("contenido_nueva_pregunta");
    const errorTitulo = document.getElementById("errorTituloPregunta");
    const errorContenido = document.getElementById("errorContenidoPregunta");

    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Limpiar mensajes de error
        errorTitulo.textContent = "";
        errorContenido.textContent = "";

        // Validar campo de título
        if (tituloInput.value.trim() === "") {
            isValid = false;
            errorTitulo.textContent = "El título no puede estar vacío.";
        }

        // Validar campo de contenido
        if (contenidoTextarea.value.trim() === "") {
            isValid = false;
            errorContenido.textContent = "El contenido no puede estar vacío.";
        }

        // Detener el envío del formulario si hay errores
        if (!isValid) {
            event.preventDefault();
        }
    });
});
