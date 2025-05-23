CREATE DATABASE IF NOT EXISTS calificaciones;
USE calificaciones;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('docente', 'estudiante') NOT NULL,
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    eliminado_en DATETIME DEFAULT NULL
);

-- Tabla de lugares educativos
CREATE TABLE lugares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_lugar VARCHAR(100) NOT NULL,
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    eliminado_en DATETIME DEFAULT NULL
);

-- Tabla de asignaturas
CREATE TABLE asignaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_asignatura VARCHAR(100) NOT NULL,
    id_lugar INT,
    FOREIGN KEY (id_lugar) REFERENCES lugares(id),
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    eliminado_en DATETIME DEFAULT NULL
);

-- Relación estudiantes-asignaturas
CREATE TABLE asignacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT,
    id_asignatura INT,
    FOREIGN KEY (id_estudiante) REFERENCES usuarios(id),
    FOREIGN KEY (id_asignatura) REFERENCES asignaturas(id),
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    eliminado_en DATETIME DEFAULT NULL
);

-- Notas de estudiantes
CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_asignacion INT,
    nota_teoria DECIMAL(5,2),
    nota_practica DECIMAL(5,2),
    FOREIGN KEY (id_asignacion) REFERENCES asignacion(id),
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    eliminado_en DATETIME DEFAULT NULL
);
