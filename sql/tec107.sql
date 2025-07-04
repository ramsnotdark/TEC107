-- Active: 1723660731256@@127.0.0.1@3306@tec107
-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tec107;
USE tec107;

-- Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar un usuario de prueba (la contraseña es '12345', encriptada con password_hash)
INSERT INTO usuarios (usuario, email, password) VALUES
('admin', 'admin@correo.com', '$2y$10$uCQe6gZSYDZwVNNScD7sFuIfZ7CQQUQ9A0b9pZ7VKzOCEc4cLFr3y'); --la contraseña es 12345

DELETE FROM usuarios WHERE usuario = 'admin';

INSERT INTO usuarios (usuario, email, password)
VALUES ('admin', 'admin@correo.com', '$2y$10$hViuSujcG/igEVV9H6WUm.y9p9BJ/cb4PHCjkX5X7xoAb0d/.l.X2');

ALTER TABLE usuarios
ADD COLUMN nombre VARCHAR(100) NOT NULL AFTER id,
ADD COLUMN apellidos VARCHAR(100) NOT NULL AFTER nombre;

USE tec107;

ALTER TABLE usuarios ADD activo TINYINT(1) NOT NULL DEFAULT 1;

USE tec107;

CREATE TABLE alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    grado VARCHAR(20) NOT NULL,
    grupo VARCHAR(10) NOT NULL,
    materia VARCHAR(100) NOT NULL
);

ALTER TABLE alumnos
ADD COLUMN trimestre1 DECIMAL(4,2) DEFAULT 0,
ADD COLUMN trimestre2 DECIMAL(4,2) DEFAULT 0,
ADD COLUMN trimestre3 DECIMAL(4,2) DEFAULT 0,
ADD COLUMN estado TINYINT(1) DEFAULT 1;

