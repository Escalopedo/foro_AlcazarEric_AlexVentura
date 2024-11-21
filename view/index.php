<?php
include '../php/conexion.php'; // Incluir la conexión a la base de datos

// Iniciar sesión para manejar las preguntas y respuestas
session_start();

// Consultar todas las preguntas con sus respuestas
try {
    // Consultar preguntas
    $sql_preguntas = "
        SELECT 
            p.id AS pregunta_id, 
            p.titulo AS pregunta_titulo, 
            p.contenido AS pregunta_contenido, 
            p.fecha_creacion AS pregunta_fecha, 
            u.nombre_usuario AS autor_pregunta
        FROM preguntas p
        JOIN usuarios u ON p.id_usuario = u.id
        ORDER BY p.fecha_creacion DESC
    ";
    $stmt_preguntas = $pdo->query($sql_preguntas);
    $preguntas = $stmt_preguntas->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener respuestas relacionadas con las preguntas
    $sql_respuestas = "
        SELECT 
            r.id AS respuesta_id, 
            r.id_pregunta, 
            r.contenido AS respuesta_contenido, 
            r.fecha_creacion AS respuesta_fecha, 
            u.nombre_usuario AS autor_respuesta
        FROM respuestas r
        JOIN usuarios u ON r.id_usuario = u.id
        ORDER BY r.fecha_creacion ASC
    ";
    $stmt_respuestas = $pdo->query($sql_respuestas);
    $respuestas = $stmt_respuestas->fetchAll(PDO::FETCH_ASSOC);

    // Organizar las respuestas por pregunta usando un arreglo asociativo
    $respuestas_por_pregunta = [];
    foreach ($respuestas as $respuesta) {
        $respuestas_por_pregunta[$respuesta['id_pregunta']][] = $respuesta;
    }

    // Procesar nuevo formulario de pregunta
    if (isset($_POST['submit_pregunta'])) {
        // Verificar que el usuario está logueado
        if (isset($_SESSION['id_usuario'])) {
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $id_usuario = $_SESSION['id_usuario'];

            $stmt = $pdo->prepare("INSERT INTO preguntas (id_usuario, titulo, contenido, fecha_creacion) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$id_usuario, $titulo, $contenido]);

            // Redirigir a la misma página para ver la nueva pregunta
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Debes iniciar sesión para hacer una pregunta.";
        }
    }

    // Procesar respuestas a las preguntas
    if (isset($_POST['submit_respuesta'])) {
        // Verificar que el usuario está logueado
        if (isset($_SESSION['id_usuario'])) {
            $id_pregunta = $_POST['id_pregunta'];
            $contenido_respuesta = $_POST['contenido_respuesta'];
            $id_usuario = $_SESSION['id_usuario'];

            $stmt = $pdo->prepare("INSERT INTO respuestas (id_pregunta, id_usuario, contenido, fecha_creacion) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$id_pregunta, $id_usuario, $contenido_respuesta]);

            // Redirigir a la misma página para ver la nueva respuesta
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Debes iniciar sesión para responder a una pregunta.";
        }
    }
} catch (PDOException $e) {
    die('Error al cargar preguntas y respuestas: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORO</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
    <header>
        <div class="container">
            <h1>FORO</h1>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['id_usuario'])): ?>
                        <li><a href="../php/logout.php">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Iniciar Sesión</a></li>
                        <li><a href="registrarse.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2>Preguntas y Respuestas</h2>

        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <p><?php echo htmlspecialchars($error_message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (count($preguntas) > 0): ?>
            <div class="preguntas">
                <?php foreach ($preguntas as $pregunta): ?>
                    <div class="pregunta">
                        <h3><?php echo htmlspecialchars($pregunta['pregunta_titulo']); ?></h3>
                        <p><strong>Por:</strong> <?php echo htmlspecialchars($pregunta['autor_pregunta']); ?></p>
                        <p><?php echo htmlspecialchars($pregunta['pregunta_contenido']); ?></p>
                        <p><small><strong>Fecha:</strong> <?php echo htmlspecialchars($pregunta['pregunta_fecha']); ?></small></p>

                        <!-- Respuestas -->
                        <?php if (!empty($respuestas_por_pregunta[$pregunta['pregunta_id']])): ?>
                            <div class="respuestas">
                                <h4>Respuestas:</h4>
                                <ul>
                                    <?php foreach ($respuestas_por_pregunta[$pregunta['pregunta_id']] as $respuesta): ?>
                                        <li>
                                            <p><?php echo htmlspecialchars($respuesta['respuesta_contenido']); ?></p>
                                            <p><small><strong>Por:</strong> <?php echo htmlspecialchars($respuesta['autor_respuesta']); ?> | <strong>Fecha:</strong> <?php echo htmlspecialchars($respuesta['respuesta_fecha']); ?></small></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p>Aún no hay respuestas para esta pregunta.</p>
                        <?php endif; ?>

                        <!-- Formulario para responder -->
                        <?php if (isset($_SESSION['id_usuario'])): ?>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="id_pregunta" value="<?php echo $pregunta['pregunta_id']; ?>">
                                <textarea name="contenido_respuesta" required placeholder="Escribe tu respuesta aquí..."></textarea>
                                <button type="submit" name="submit_respuesta">Responder</button>
                            </form>
                        <?php else: ?>
                            <p><a href="login.php">Inicia sesión</a> para responder a esta pregunta.</p>
                        <?php endif; ?>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay preguntas publicadas aún.</p>
        <?php endif; ?>

        <!-- Formulario para hacer una nueva pregunta -->
        <?php if (isset($_SESSION['id_usuario'])): ?>
            <h3>Hacer una nueva pregunta</h3>
            <form action="index.php" method="POST">
                <input type="text" name="titulo" required placeholder="Título de la pregunta">
                <textarea name="contenido" required placeholder="Escribe tu pregunta aquí..."></textarea>
                <button type="submit" name="submit_pregunta">Publicar Pregunta</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Inicia sesión</a> para hacer una nueva pregunta.</p>
        <?php endif; ?>

    </main>
</body>
</html>
