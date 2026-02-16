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


-- INSERTAR PELÍCULAS
INSERT INTO peliculas (id, titulo, genero, pais, anyo) VALUES 
(1, 'Inception', 'Ciencia Ficción', 'EEUU', 2010),
(2, 'The Matrix', 'Acción', 'EEUU', 1999),
(3, 'Pulp Fiction', 'Crimen', 'EEUU', 1994),
(4, 'El Laberinto del Fauno', 'Fantasía', 'España', 2006),
(5, 'Parasite', 'Thriller', 'Corea del Sur', 2019),
(6, 'Interstellar', 'Ciencia Ficción', 'EEUU', 2014),
(7, 'The Dark Knight', 'Acción', 'EEUU', 2008),
(8, 'Fight Club', 'Drama', 'EEUU', 1999),
(9, 'Léon: The Professional', 'Acción', 'Francia', 1994),
(10, 'Vicky Cristina Barcelona', 'Romance', 'España', 2008),
(11, 'El Padrino', 'Crimen', 'EEUU', 1972),
(12, 'Joker', 'Drama', 'EEUU', 2019),
(13, 'Oppenheimer', 'Bélico', 'EEUU', 2023),
(14, 'El Secreto de sus Ojos', 'Drama', 'Argentina', 2009),
(15, 'El Caballero Oscuro: La leyenda renace', 'Acción', 'EEUU', 2012),
(16, 'Gladiator', 'Acción', 'EEUU', 2000);

-- INSERTAR ACTORES
INSERT INTO actores (id, nombre, apellidos) VALUES 
(1, 'Leonardo', 'DiCaprio'),
(2, 'Keanu', 'Reeves'),
(3, 'Samuel', 'L. Jackson'),
(4, 'Ivana', 'Baquero'),
(5, 'Song', 'Kang-ho'),
(6, 'Matthew', 'McConaughey'),
(7, 'Anne', 'Hathaway'),
(8, 'Carrie-Anne', 'Moss'),
(9, 'John', 'Travolta'),
(10, 'Christian', 'Bale'),
(11, 'Heath', 'Ledger'),
(12, 'Brad', 'Pitt'),
(13, 'Edward', 'Norton'),
(14, 'Natalie', 'Portman'),
(15, 'Jean', 'Reno'),
(16, 'Penélope', 'Cruz'),
(17, 'Javier', 'Bardem'),
(18, 'Marlon', 'Brando'),
(19, 'Al', 'Pacino'),
(20, 'Robert', 'De Niro'),
(21, 'Joaquin', 'Phoenix'),
(22, 'Cillian', 'Murphy'),
(23, 'Emily', 'Blunt'),
(24, 'Ricardo', 'Darín');

-- VINCULAR ACTORES CON PELÍCULAS (Tabla intermedia)
INSERT INTO actuan (idPelicula, idActor) VALUES 
(1, 1), -- DiCaprio en Inception
(2, 2), -- Keanu en Matrix
(2, 8), -- Carrie-Anne en Matrix
(3, 3), -- Samuel L. Jackson en Pulp Fiction
(3, 9), -- Travolta en Pulp Fiction
(4, 4), -- Ivana Baquero en El Laberinto
(5, 5), -- Song Kang-ho en Parasite
(6, 6), -- McConaughey en Interstellar
(6, 7), -- Anne Hathaway en Interstellar
(1, 7), -- Anne Hathaway también sale en Inception (ejemplo)
(7, 10), (7, 11), 
-- Fight Club
(8, 12), (8, 13), 
-- Léon
(9, 14), (9, 15), 
-- Vicky Cristina Barcelona
(10, 16), (10, 17), 
-- El Padrino
(11, 18), (11, 19), 
-- Joker
(12, 21), 
-- Oppenheimer
(13, 22), (13, 23), (13, 7), 
-- El Secreto de sus Ojos
(14, 24),
-- El Caballero Oscuro: La leyenda renace (Christian Bale repite)
(15, 10), (15, 7), (15, 22),
-- Gladiator
(16, 21), (16, 17); -- Bardem y Joaquin Phoenix (ejemplo de reparto estelar)