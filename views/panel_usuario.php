<?php
require_once '../config/Database.php';
require_once '../models/Pelicula.php'; 

include 'header.php'; 
?>
<link rel="stylesheet" href="../css/user.css">

<div class="container">
    <?php if (isset($_GET['res']) && $_GET['res'] == 'sent'): ?>
        <div class="alert-success">
            <strong>¡Enviado!</strong> Gracias por tu mensaje, lo revisaremos pronto.
        </div>  
    <?php endif; ?>

    <section class="incidencia-section">
        <h3>¿Necesitas ayuda?</h3>
        <p>Informa de cualquier error en la plataforma:</p>
        <form action="incidencia.php" method="POST" class="user-form">
            <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea><br>
            <button type="submit" style="background:#3498db; color:white; border:none; padding:10px; border-radius:4px; cursor:pointer;">Enviar Incidencia</button>
        </form>
    </section>

    <hr>

    <section class="catalog-section">
        <h2>Catálogo de Películas</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Género</th>
                    <th>Año</th>
                    <th>Reparto</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $db = (new Database())->getConnection();
                $peliculaModel = new Pelicula($db);
                $peliculas = $peliculaModel->obtenerTodasConActores();
                
                while ($row = $peliculas->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><strong><?php echo $row['titulo']; ?></strong></td>
                        <td><?php echo $row['genero']; ?></td>
                        <td><?php echo $row['anyo']; ?></td>
                        <td><?php echo $row['reparto']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</div>
</body>
</html>