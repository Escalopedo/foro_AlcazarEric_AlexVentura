function validateName() {
    const nameField = document.getElementById("nombre");
    const nameError = document.getElementById("nameError");

    if (nameField.value.trim() === "") {
        nameError.textContent = "El nombre no puede estar vacío";
        nameField.classList.add("error");
        return false;
    }

    nameError.textContent = "";
    nameField.classList.remove("error");
    return true;
}

function validateUser() {
    const userField = document.getElementById("usuario");
    const userError = document.getElementById("userError");

    if (userField.value.trim() === "") {
        userError.textContent = "El nombre de usuario no puede estar vacío";
        userField.classList.add("error");
        return false;
    }

    userError.textContent = "";
    userField.classList.remove("error");
    return true;
}

function validateEmail() {
    const emailField = document.getElementById("email");
    const emailError = document.getElementById("emailError");

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailField.value.trim() === "") {
        emailError.textContent = "El correo electrónico no puede estar vacío";
        emailField.classList.add("error");
        return false;
    } else if (!emailRegex.test(emailField.value)) {
        emailError.textContent = "El correo electrónico no es válido";
        emailField.classList.add("error");
        return false;
    }

    emailError.textContent = "";
    emailField.classList.remove("error");
    return true;
}

function validatePassword() {
    const passwordField = document.getElementById("contrasena");
    const passwordError = document.getElementById("passwordError");

    if (passwordField.value.trim() === "") {
        passwordError.textContent = "La contraseña no puede estar vacía";
        passwordField.classList.add("error");
        return false;
    } else if (passwordField.value.length < 6) {
        passwordError.textContent = "La contraseña debe tener al menos 6 caracteres";
        passwordField.classList.add("error");
        return false;
    }

    passwordError.textContent = "";
    passwordField.classList.remove("error");
    return true;
}

function validateConfirmPassword() {
    const passwordField = document.getElementById("contrasena");
    const confirmPasswordField = document.getElementById("confirmar_contrasena");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    if (confirmPasswordField.value.trim() === "") {
        confirmPasswordError.textContent = "Debe confirmar su contraseña";
        confirmPasswordField.classList.add("error");
        return false;
    } else if (confirmPasswordField.value !== passwordField.value) {
        confirmPasswordError.textContent = "Las contraseñas no coinciden";
        confirmPasswordField.classList.add("error");
        return false;
    }

    confirmPasswordError.textContent = "";
    confirmPasswordField.classList.remove("error");
    return true;
}

function validateRegistration(event) {
    event.preventDefault(); // Evita el envío automático del formulario

    const isNameValid = validateName();
    const isUserValid = validateUser();
    const isEmailValid = validateEmail();
    const isPasswordValid = validatePassword();
    const isConfirmPasswordValid = validateConfirmPassword();

    if (isNameValid && isUserValid && isEmailValid && isPasswordValid && isConfirmPasswordValid) {
        document.forms["registration_form"].submit(); // Envía el formulario si todo es válido
    }
}
