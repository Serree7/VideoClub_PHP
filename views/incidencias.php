<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) { header("Location: ../index.php"); exit(); }

require_once '../config/Database.php';
// Aquí necesitarías un controlador o modelo de incidencias en el futuro
include 'header.php'; 
?>
<link rel="stylesheet" href="../css/admin.css">

<div class="container">
    <h2>Mensajes de Incidencias</h2>
    <p>Aquí aparecerán los problemas técnicos reportados por los usuarios.</p>
    
    <table class="admin-table">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Mensaje de Error</th>
            <th>Fecha de Envío</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <tr class="status-pendiente">
            <td><span class="user-badge">Juan Pérez</span></td>
            <td>
                <span class="mensaje-texto">"La película 'Batman' no carga el cartel correctamente."</span>
            </td>
            <td>15/02/2026</td>
            <td>
                <a href="resolver_incidencia.php?id=1" class="btn-resolver">Marcar como Resuelta</a>
            </td>
        </tr>
    </tbody>
</table>
</div>
</body>
</html>