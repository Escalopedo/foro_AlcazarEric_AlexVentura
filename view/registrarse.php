<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - FORO</title>
    <script src="../js/valiRegistro.js"></script>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>FORO</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Registrarse</h2>
            <form name="registration_form" action="procesar_registro.php" method="POST" onsubmit="validateRegistration(event)">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre">
                <div id="nameError" class="error-message"></div>

                <label for="usuario">Nombre de Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Elija un nombre de usuario">
                <div id="userError" class="error-message"></div>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico">
                <div id="emailError" class="error-message"></div>

                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña">
                <div id="passwordError" class="error-message"></div>

                <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Repita su contraseña">
                <div id="confirmPasswordError" class="error-message"></div>

                <button type="submit">Registrarse</button>
            </form>
        </div>
    </main>
</body>
</html>
