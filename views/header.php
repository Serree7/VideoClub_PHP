<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario'])) { header("Location: ../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>

<header class="main-header">
    <div class="header-container">
        <div class="logo">VideoClub <span>PHP</span></div>
        <nav class="nav-links">
            <?php if ($_SESSION['rol'] == 1): ?>
                <a href="admin_listado.php">Gestión Películas</a>
                <a href="incidencias.php" style="background: #f39c12; color: white; padding: 5px 10px; border-radius: 4px;">Ver Incidencias</a>
            <?php else: ?>
                <a href="panel_usuario.php">Ver Catálogo</a>
            <?php endif; ?>
            
            <a href="../logout.php" class="logout-link">Cerrar Sesión</a>
        </nav>
        <div class="user-info">
            Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>
        </div>
    </div>
</header>