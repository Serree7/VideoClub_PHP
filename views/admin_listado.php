<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/Database.php';
require_once '../controllers/PeliculaController.php';
include 'header.php'; 
?>
<link rel="stylesheet" href="../css/admin.css">

<div class="container">
    <div class="admin-header">
        <h2>Panel de Gestión de Películas</h2>
        <div class="admin-actions">
            <a href="nueva_pelicula.php" class="btn-new">+ Añadir Película</a>
            </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Género</th>
                <th>País</th>
                <th>Año</th>
                <th>Reparto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $db = (new Database())->getConnection();
            $pController = new PeliculaController($db);
            $peliculas = $pController->obtenerCatalogo();

            while ($row = $peliculas->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($row['titulo']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['genero']); ?></td>
                    <td><?php echo htmlspecialchars($row['pais']); ?></td>
                    <td><?php echo htmlspecialchars($row['anyo']); ?></td>
                    <td><small><?php echo $row['reparto'] ? htmlspecialchars($row['reparto']) : "<em>Sin reparto</em>"; ?></small></td>
                    <td class="action-links">
                        <a href="editar_pelicula.php?id=<?php echo $row['id']; ?>" class="edit">Modificar</a>
                        <a href="../controllers/PeliculaController.php?action=eliminar&id=<?php echo $row['id']; ?>" 
                           class="delete" 
                           onclick="return confirm('¿Seguro que quieres eliminar esta película?')">Borrar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>