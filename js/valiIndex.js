// Validación para la creación de preguntas
function validatePregunta() {
    const titulo = document.getElementById("titulo");
    const contenido = document.getElementById("contenido");
    const errorTitulo = document.getElementById("errorTitulo");
    const errorContenido = document.getElementById("errorContenido");

    let valid = true;

    // Validación para el título
    if (titulo.value.trim() === "") {
        errorTitulo.textContent = "El título no puede estar vacío";
        titulo.classList.add("error");
        valid = false;
    } else {
        errorTitulo.textContent = "";
        titulo.classList.remove("error");
    }

    // Validación para el contenido
    if (contenido.value.trim() === "") {
        errorContenido.textContent = "El contenido no puede estar vacío";
        contenido.classList.add("error");
        valid = false;
    } else {
        errorContenido.textContent = "";
        contenido.classList.remove("error");
    }

    return valid;
}

// Validación para las respuestas
function validateRespuesta(preguntaId) {
    const respuesta = document.getElementById("contenido_respuesta_" + preguntaId);
    const errorRespuesta = document.getElementById("errorRespuesta_" + preguntaId);

    if (respuesta.value.trim() === "") {
        errorRespuesta.textContent = "La respuesta no puede estar vacía";
        respuesta.classList.add("error");
        return false;
    }

    errorRespuesta.textContent = "";
    respuesta.classList.remove("error");
    return true;
}
