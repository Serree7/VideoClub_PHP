<?php
require_once '../config/Database.php';
require_once '../models/Usuario.php';

$mensaje = "";

if (isset($_POST['btnRegistrar'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        $userModel = new Usuario($db); 

        $nuevoUser = $_POST['username'];
        $nuevaPass = $_POST['password'];

        if ($userModel->registrar($nuevoUser, $nuevaPass)) {
            $mensaje = "<p style='color:green;'>Registro con éxito. <a href='../index.php'>Inicia sesión aquí</a></p>";
        }
    } catch (Exception $e) {
        $mensaje = "<p style='color:red;'>Error al registrar: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Videoclub</title>
</head>
<body>
    <h1>Crear Nueva Cuenta</h1>
    <?php echo $mensaje; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Nombre de usuario" required><br><br>
        <input type="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="submit" name="btnRegistrar">Registrarse</button>
    </form>
</body>
</html>