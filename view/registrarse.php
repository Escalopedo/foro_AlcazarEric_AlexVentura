<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - FORO</title>
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
            <form action="procesar_registro.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ingrese su nombre">
                
                <label for="usuario">Nombre de Usuario:</label>
                <input type="text" id="usuario" name="usuario" required placeholder="Elija un nombre de usuario">
                
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required placeholder="Ingrese su correo electrónico">
                
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required placeholder="Ingrese su contraseña">
                
                <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required placeholder="Repita su contraseña">
                
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </main>
</body>
</html>
