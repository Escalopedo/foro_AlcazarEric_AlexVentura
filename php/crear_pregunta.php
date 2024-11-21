<?php
// php/crear_pregunta.php
session_start();
include 'conexion.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $id_usuario = $_SESSION['usuario_id']; // Asegúrate de que la sesión esté configurada

    try {
        // Insertar la nueva pregunta
        $sql = "INSERT INTO preguntas (id_usuario, titulo, contenido) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_usuario, $titulo, $contenido]);

        header("Location: ../view/index.php"); // Redirigir a la página principal
    } catch (PDOException $e) {
        echo "Error al crear la pregunta: " . $e->getMessage();
    }
}
?>
