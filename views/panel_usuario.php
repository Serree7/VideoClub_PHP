

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario - Videoclub</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
    <a href="../index.php">Cerrar Sesión</a>

    <hr>

    <h2>Enviar incidencia al Administrador</h2>
    <form action="enviar_incidencia.php" method="POST">
        <label>Describe tu problema:</label><br>
        <textarea name="mensaje" rows="4" cols="50" required></textarea><br>
        <button type="submit">Enviar Email</button>
    </form>

    <hr>

    <h2>Catálogo de Películas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Género</th>
                <th>Año</th>
                <th>Reparto</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $peliculas->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['genero']; ?></td>
                    <td><?php echo $row['anyo']; ?></td>
                    <td><?php echo $row['reparto']; ?></td> </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>