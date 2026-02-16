<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensaje = $_POST['mensaje'] ?? '';

    if (!empty(trim($mensaje))) {
        header("Location: panel_usuario.php?res=sent");
        exit();
    }
}
header("Location: panel_usuario.php");
exit();