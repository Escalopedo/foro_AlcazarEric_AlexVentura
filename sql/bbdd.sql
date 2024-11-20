CREATE DATABASE foro;

USE foro;

-- Crear tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL
);

-- Crear tabla de preguntas
CREATE TABLE preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_creacion TIMESTAMP
);

-- Crear tabla de respuestas
CREATE TABLE respuestas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pregunta INT NOT NULL,
    id_usuario INT NOT NULL,
    contenido TEXT NOT NULL,
    fecha_creacion TIMESTAMP
);


-- Agregar claves foráneas
-- Relación entre preguntas y usuarios
ALTER TABLE preguntas
ADD CONSTRAINT fk_preguntas_usuario
FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE;

-- Relación entre respuestas y preguntas
ALTER TABLE respuestas
ADD CONSTRAINT fk_respuestas_pregunta
FOREIGN KEY (id_pregunta) REFERENCES preguntas(id) ON DELETE CASCADE;

-- Relación entre respuestas y usuarios
ALTER TABLE respuestas
ADD CONSTRAINT fk_respuestas_usuario
FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE;

