-- Tabla de Usuarios (para el Login) [cite: 13-17]
CREATE TABLE usuarios (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol TINYINT(4) NOT NULL -- 0: Usuario, 1: Admin [cite: 32, 33]
);

-- Tabla de Películas [cite: 21-27]
CREATE TABLE peliculas (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    genero VARCHAR(50),
    pais VARCHAR(50),
    anyo INT(11),
    cartel VARCHAR(255)
);

-- Tabla de Actores [cite: 8-12]
CREATE TABLE actores (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100),
    fotografia VARCHAR(255)
);

-- Tabla intermedia: Relación muchos a muchos [cite: 18-20]
CREATE TABLE actuan (
    idPelicula INT(11),
    idActor INT(11),
    PRIMARY KEY (idPelicula, idActor),
    FOREIGN KEY (idPelicula) REFERENCES peliculas(id) ON DELETE CASCADE,
    FOREIGN KEY (idActor) REFERENCES actores(id) ON DELETE CASCADE
);