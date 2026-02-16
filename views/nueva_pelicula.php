<?php
session_start();
// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

include 'header.php'; 
?>
<link rel="stylesheet" href="../css/admin.css">

<div class="container">
    <div class="admin-header">
        <h2>Añadir Nueva Película</h2>
        <a href="admin_listado.php" class="btn-secondary">Volver al Listado</a>
    </div>

    <form action="../controllers/PeliculaController.php?action=guardar" method="POST" class="admin-form">
        <div class="form-group">
            <label for="titulo">Título de la película:</label>
            <input type="text" id="titulo" name="titulo" required placeholder="Ej: Pulp Fiction">
        </div>

        <div class="form-group">
            <label for="genero">Género:</label>
            <input type="text" id="genero" name="genero" required placeholder="Ej: Acción, Drama...">
        </div>

        <div class="form-group">
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" required placeholder="Ej: España, USA...">
        </div>

        <div class="form-group">
            <label for="anyo">Año de estreno:</label>
            <input type="number" id="anyo" name="anyo" min="1895" max="2030" required>
        </div>

        <div class="form-group">
            <label for="reparto">Actores (opcional):</label>
            <textarea id="reparto" name="reparto" rows="3" placeholder="Nombres de los actores separados por comas..."></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-new">Guardar Película</button>
        </div>
    </form>
</div>
</body>
</html>