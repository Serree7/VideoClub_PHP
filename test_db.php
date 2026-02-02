<?php
    require_once "config/Database.php";

    $database = new Database();
    $db = $database->getConnection();

    if($db){
        echo "Conexión establecida con éxito";

        $query = "SHOW TABLES";
        $stmt = $db->prepare($query); // 1. Preparamos la sentencia
        $stmt->execute();             // 2. Ejecutamos el MÉTODO del objeto $stmt

        echo "Tablas encontradas en la base de datos";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "- ". $row['Tables_in_videoclubonline'];
        }
    }else{
        echo "Error: no se pudo conectar a la base de datos";
    }
?>