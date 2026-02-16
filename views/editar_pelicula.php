<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) { header("Location: ../index.php"); exit(); }

require_once '../config/Database.php';
require_once '../models/Pelicula.php';
include 'header.php';

$db = (new Database())->getConnection();
$peliModel = new Pelicula($db);

// Obtenemos la ID de la URL y validamos que exista
if (!isset($_GET['id'])) { header("Location: admin_listado.php"); exit(); }

$id = $_GET['id'];
$peli = $peliModel->obtenerPorId($id); 

if (!$peli) { echo "Película no encontrada."; exit(); }
?>

<link rel="stylesheet" href="../css/admin.css">

<div class="container">
    <h2>Modificar Película</h2>
    
    <form action="../controllers/PeliculaController.php?action=actualizar" method="POST" class="admin-form">
        <input type="hidden" name="id" value="<?php echo $peli['id']; ?>">

        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($peli['titulo']); ?>" required>
        </div>

        <div class="form-group">
            <label>Género:</label>
            <input type="text" name="genero" value="<?php echo htmlspecialchars($peli['genero']); ?>" required>
        </div>

        <div class="form-group">
            <label>País:</label>
            <input type="text" name="pais" value="<?php echo htmlspecialchars($peli['pais']); ?>" required>
        </div>

        <div class="form-group">
            <label>Año:</label>
            <input type="number" name="anyo" value="<?php echo $peli['anyo']; ?>" required>
        </div>

        <div class="form-group">
            <label>Reparto (separado por comas):</label>
            <textarea name="reparto" rows="4" placeholder="Ej: Keanu Reeves, Carrie-Anne Moss" class="form-control"><?php echo htmlspecialchars($peli['reparto'] ?? ''); ?></textarea>
            <small style="color: #666;">Si borras un nombre de aquí, se eliminará el vínculo al guardar.</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-new">Actualizar Cambios</button>
            <a href="admin_listado.php" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>