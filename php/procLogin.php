<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos utilizando require
require('conexion.php');

// Inicializar la variable para los mensajes de error
$error_message = "";

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    try {
        // Preparar la consulta para verificar el usuario en la base de datos
        $stmt = $pdo->prepare("SELECT id, nombre_usuario, contraseña FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$usuario]); // Ejecutar la consulta con el nombre de usuario

        // Verificar si se encontró el usuario
        if ($stmt->rowCount() > 0) {
            // Si el usuario existe, obtenemos la información
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $user['contraseña'];  // Contraseña hasheada almacenada en la base de datos

            // Verificar si la contraseña es correcta
            if (password_verify($contrasena, $hashed_password)) {
                // Iniciar sesión y redirigir al usuario
                $_SESSION['id_usuario'] = $user['id'];
                $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
                header("Location: ../view/foro.php"); // Redirigir a la página principal del foro
                exit();
            } else {
                // Contraseña incorrecta
                $_SESSION['error_message'] = "Credenciales incorrectas.";
            }
        } else {
            // Usuario no encontrado
            $_SESSION['error_message'] = "Credenciales incorrectas.";
        }
    } catch (PDOException $e) {
        // Capturar cualquier error durante la ejecución de la consulta
        $_SESSION['error_message'] = "Error al procesar la solicitud: " . $e->getMessage();
    }

    // Redirigir de nuevo al login con el mensaje de error guardado en la sesión
    header("Location: ../view/login.php");
    exit();
}
?>
