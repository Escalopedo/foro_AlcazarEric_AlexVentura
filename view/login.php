<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="../js/valiLogin.js"></script>
    <link rel="stylesheet" href="../css/styles.css"> 
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
                    <li><a href="registrarse.php">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Iniciar Sesión</h2>
            <form name="login_form" action="../php/procLogin.php" method="POST" onsubmit="validateLogin(event)">
                <?php 
                    // Iniciar sesión para obtener el mensaje de error
                    session_start(); 
                    if (isset($_SESSION['error_message'])): 
                ?>
                    <div class="error-message">
                        <?php
                            // Mostrar el mensaje de error y luego eliminarlo de la sesión
                            echo htmlspecialchars($_SESSION['error_message']);
                            unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario">
                <span id="userError" class="error-message"></span>
                <br>
                <br>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña">
                <span id="passwordError" class="error-message"></span>
                <br>
                <br>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </main>
</body>
</html>
