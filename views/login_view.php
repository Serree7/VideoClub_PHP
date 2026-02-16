<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub - Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="login-container">
        <h1>VideoClub <span>PHP</span></h1>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Clave" required>
            <button type="submit" name="login">Entrar</button>
        </form>
        <p>¿No tienes cuenta? <a href="views/registro.php">Regístrate aquí</a></p>
    </div>
</body>
</html>