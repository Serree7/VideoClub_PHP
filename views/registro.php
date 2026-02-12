<?php
require_once '../config/Database.php';
require_once '../models/Usuario.php';

$mensaje = "";

if(isset($_POST['btnRegistrar'])) {
    $db = (new Database())->getConnection();
    $userModel = new Usuario($db);

    try{
        if($usserModel->registrar($_POST['username'], $_POST['password'])) {
            $mensaje = "Usuario registrado con éxito <a href='../index.php'>Ir al Login</a>";
        }
    }catch (Exception $e){
        $msg = "Error: " . $e->getMessage();
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
    <br>
    <a href="../index.php">Volver al Login</a>
</body>
</html>