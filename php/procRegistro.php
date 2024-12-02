<?php
// Iniciar sesión para manejar mensajes de error
session_start();

// Incluir la conexión a la base de datos utilizando require
require('conexion.php');

// Inicializar las variables para los mensajes de error
$error_message = "";

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_real = $_POST['nombre']; // Nombre real del usuario
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Validación de contraseñas
    if ($contrasena !== $confirmar_contrasena) {
        $_SESSION['error_message'] = "Las contraseñas no coinciden.";
        header("Location: ../view/registrarse.php");  // Redirigir a la página de registro
        exit();  // Asegúrate de que el script termine aquí
    }

    // Validar la longitud de la contraseña
    if (strlen($contrasena) < 6) {
        $_SESSION['error_message'] = "La contraseña debe tener al menos 6 caracteres.";
        header("Location: ../view/registrarse.php");
        exit();
    }

    try {
        // Comprobar si el nombre de usuario ya está en uso
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$usuario]);
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_message'] = "El nombre de usuario ya está en uso.";
            header("Location: ../view/registrarse.php");
            exit();
        }

        // Comprobar si el correo electrónico ya está en uso
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_message'] = "El correo electrónico ya está registrado.";
            header("Location: ../view/registrarse.php");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "El correo electrónico no es válido.";
            header("Location: ../view/registrarse.php");
            exit();
        }        

        // Hashear la contraseña
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, nombre_real_usuario, correo, contraseña) VALUES (?, ?, ?, ?)");
        $stmt->execute([$usuario, $nombre_real, $email, $hashed_password]);

        // Redirigir a la página de inicio de sesión
        $_SESSION['success_message'] = "Registro exitoso. Puedes iniciar sesión ahora.";
        header("Location: ../view/login.php");
        exit();
        
    } catch (PDOException $e) {
        // Capturar cualquier error durante la ejecución de la consulta
        $_SESSION['error_message'] = "Error al registrar el usuario: " . $e->getMessage();
        header("Location: ../view/registrarse.php");
        exit();
    }
}
?>
