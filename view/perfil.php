<?php
include '../php/conexion.php'; // Conexión a la base de datos

// Iniciar sesión para verificar el acceso
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario']; // ID del usuario logueado

try {
    // Consultar las preguntas del usuario logueado
    $sql_preguntas = "
        SELECT id, titulo, contenido, fecha_creacion
        FROM preguntas
        WHERE id_usuario = :id_usuario
        ORDER BY fecha_creacion DESC
    ";
    $stmt_preguntas = $pdo->prepare($sql_preguntas);
    $stmt_preguntas->execute([':id_usuario' => $id_usuario]);
    $preguntas = $stmt_preguntas->fetchAll(PDO::FETCH_ASSOC);

    // Procesar eliminación de pregunta
    if (isset($_POST['delete_pregunta'])) {
        $id_pregunta = $_POST['id_pregunta'];
        $stmt_delete = $pdo->prepare("DELETE FROM preguntas WHERE id = :id_pregunta AND id_usuario = :id_usuario");
        $stmt_delete->execute([':id_pregunta' => $id_pregunta, ':id_usuario' => $id_usuario]);
        header("Location: perfil.php"); // Recargar para reflejar cambios
        exit();
    }

    // Procesar edición de pregunta
    if (isset($_POST['edit_pregunta'])) {
        $id_pregunta = $_POST['id_pregunta'];
        $nuevo_titulo = $_POST['titulo'];
        $nuevo_contenido = $_POST['contenido'];
        $stmt_update = $pdo->prepare("
            UPDATE preguntas
            SET titulo = :titulo, contenido = :contenido
            WHERE id = :id_pregunta AND id_usuario = :id_usuario
        ");
        $stmt_update->execute([
            ':titulo' => $nuevo_titulo,
            ':contenido' => $nuevo_contenido,
            ':id_pregunta' => $id_pregunta,
            ':id_usuario' => $id_usuario,
        ]);
        header("Location: perfil.php"); // Recargar para reflejar cambios
        exit();
    }
} catch (PDOException $e) {
    die('Error al cargar las preguntas: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logo.webp" type="image/webp">
    <script src="../js/valiPerfil.js" defer></script>

</head>
<body>
    <header>
        <div class="container">
            <a href="index.php">
                <img src="../img/logo.webp" alt="Logo">
            </a>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="../php/logout.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2>Bienvenido a tu perfil</h2>
        <p>Aquí puedes gestionar las preguntas que has publicado.</p>

        <?php if (count($preguntas) > 0): ?>
            <div class="preguntas">
                <?php foreach ($preguntas as $pregunta): ?>
                    <div class="pregunta">
                        <h3><?php echo htmlspecialchars($pregunta['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($pregunta['contenido']); ?></p>
                        <p><small><strong>Fecha:</strong> <?php echo htmlspecialchars($pregunta['fecha_creacion']); ?></small></p>

                        <!-- Formulario para editar la pregunta -->
                        <form action="perfil.php" method="POST" class="edit-form" onsubmit="return validateEditForm(event)">
                            <input type="hidden" name="id_pregunta" value="<?php echo $pregunta['id']; ?>">
                            <input type="text" name="titulo" value="<?php echo htmlspecialchars($pregunta['titulo']); ?>">
                            <textarea name="contenido"><?php echo htmlspecialchars($pregunta['contenido']); ?></textarea>
                            <button type="submit" name="edit_pregunta">Guardar Cambios</button>
                        </form>

                        <!-- Formulario para borrar la pregunta -->
                        <form action="perfil.php" method="POST" class="delete-form">
                            <input type="hidden" name="id_pregunta" value="<?php echo $pregunta['id']; ?>">
                            <button type="submit" name="delete_pregunta" onclick="return confirm('¿Estás seguro de que deseas eliminar esta pregunta?')">Eliminar</button>
                        </form>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No has publicado ninguna pregunta.</p>
        <?php endif; ?>
    </main>
</body>
</html>
