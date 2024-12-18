function validateUser() {
    const userField = document.getElementById("usuario"); // Cambiado a "usuario" para coincidir con el id del campo
    const userError = document.getElementById("userError");

    if (userField.value.trim() === "") {
        userError.textContent = "El usuario no puede estar vacío";
        userField.classList.add("error");
        return false;
    }

    userError.textContent = "";
    userField.classList.remove("error");
    return true;
}

function validatePassword() {
    const passwordField = document.getElementById("contrasena"); // Ya coincide con tu id "contrasena"
    const passwordError = document.getElementById("passwordError");

    if (passwordField.value.trim() === "") {
        passwordError.textContent = "La contraseña no puede estar vacía";
        passwordField.classList.add("error");
        return false;
    }

    passwordError.textContent = "";
    passwordField.classList.remove("error");
    return true;
}

function validateLogin(event) {
    event.preventDefault(); // Evita que el formulario se envíe directamente

    // Llama a las funciones de validación
    const isUserValid = validateUser();
    const isPasswordValid = validatePassword();

    // Verifica si ambas validaciones son correctas
    if (isUserValid && isPasswordValid) {
        // Si las validaciones son correctas, envía el formulario
        document.forms["login_form"].submit();
    }
}