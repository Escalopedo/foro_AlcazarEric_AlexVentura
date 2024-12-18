// Función de validación para los formularios de edición en el perfil
function validateEditForm(event) {
    const fields = event.target.querySelectorAll("input[name='titulo'], textarea[name='contenido']");
    let isValid = true;

    fields.forEach(field => {
        // Si el campo está vacío
        if (field.value.trim() === "") {
            field.classList.add("error");
            isValid = false;
        } else {
            field.classList.remove("error");
        }
    });

    // Si algún campo no es válido, evitar el envío del formulario
    if (!isValid) {
        alert("Por favor, completa todos los campos antes de guardar.");
    }

    return isValid; // Si es válido, permite enviar el formulario
}