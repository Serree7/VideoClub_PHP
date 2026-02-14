<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/Database.php';
require_once '../controllers/PeliculaController.php';

$database = new Database();
$db = $database->getConnection();

$pController = new PeliculaController($db);
$peliculas = $pController->obtenerCatalogo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Panel de Administración</h1>
    <p>Bienvenido, <strong><?php echo $_SESSION['usuario']; ?></strong> | <a href="../index.php">Cerrar Sesión</a></p>
    
    <hr>
    
    <nav>
        <a href="form_nueva_pelicula.php">Añadir Nueva Película</a> | 
        <a href="gestion_actores.php">Gestionar Actores</a>
    </nav>

    <h2>Gestión de Catálogo</h2>

    <table>
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
            <?php while ($row = $peliculas->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['genero']; ?></td>
                    <td><?php echo $row['pais']; ?></td>
                    <td><?php echo $row['anyo']; ?></td>
                    <td><?php echo $row['reparto'] ? $row['reparto'] : "<em>Sin reparto</em>"; ?></td>
                    <td>
                        <a href="editar_pelicula.php?id=<?php echo $row['id']; ?>" class="btn-edit">Modificar</a> | 
                        <a href="eliminar_pelicula.php?id=<?php echo $row['id']; ?>" 
                           class="btn-borrar" 
                           onclick="return confirm('¿Estás seguro de que quieres borrar esta película?')">Borrar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>