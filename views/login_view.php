<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Acceso al Videoclub Online</h1>

    <form method="POST" action="index.php">
        <input type="text" name="username" placeholder="Nombre de usuario" required><br><br>
        <input type="password" name="password" placeholder="Clave" required><br><br>
        <button type="submit" name="login">Entrar</button>
    </form>

    <p>¿No tienes cuenta? <a href="views/registro.php">Regístrate aquí</a></p>
</body>
</html>