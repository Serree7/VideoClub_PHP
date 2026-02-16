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
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <h1>Crear <span>Cuenta</span></h1>
        
        <div class="mensaje">
            <?php echo $mensaje; ?>
        </div>

        <form method="POST">
            <input type="text" name="username" placeholder="Nuevo usuario" required>
            <input type="password" name="password" placeholder="Contraseña segura" required>
            <button type="submit" name="btnRegistrar">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="../index.php">Inicia sesión</a></p>
    </div>
</body>
</html>