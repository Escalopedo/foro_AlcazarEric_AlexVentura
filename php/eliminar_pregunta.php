<?php
include '../php/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pregunta_id'])) {
    $pregunta_id = $_POST['pregunta_id'];
    $usuario_id = $_SESSION['id_usuario'] ?? null;

    if (!$usuario_id) {
        $_SESSION['mensaje'] = "Debes iniciar sesión para realizar esta acción.";
        header("Location: ../view/index.php");
        exit();
    }

    try {
        // Verificar que la pregunta pertenece al usuario
        $stmt = $pdo->prepare("SELECT id FROM preguntas WHERE id = ? AND id_usuario = ?");
        $stmt->execute([$pregunta_id, $usuario_id]);

        if ($stmt->rowCount() > 0) {
            // Eliminar la pregunta
            $stmt_delete = $pdo->prepare("DELETE FROM preguntas WHERE id = ?");
            $stmt_delete->execute([$pregunta_id]);

            $_SESSION['mensaje'] = "Pregunta eliminada exitosamente.";
        } else {
            $_SESSION['mensaje'] = "No tienes permiso para eliminar esta pregunta.";
        }
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error al eliminar la pregunta: " . $e->getMessage();
    }

    // Redirigir a la misma página para mostrar el mensaje
    header("Location: ../view/index.php");
    exit();
} else {
    $_SESSION['mensaje'] = "Solicitud inválida.";
    header("Location: ../view/index.php");
    exit();
}
