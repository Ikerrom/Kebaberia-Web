CREATE DATABASE IF NOT EXISTS kebaberia;

USE kebaberia;

CREATE TABLE cursos (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL UNIQUE,
  email VARCHAR(30) NOT NULL UNIQUE,
  is_admin TINYINT(1) DEFAULT 0,
  contrasena VARCHAR(150) NOT NULL, 
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Remove the comma at the end of this line
);

CREATE TABLE alumnos (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  apellido VARCHAR(30) NOT NULL,
  edad INT(3),
  email VARCHAR(30) NOT NULL UNIQUE,
  curso_id INT(11) UNSIGNED,
  usuario_id INT(11) UNSIGNED,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (curso_id) REFERENCES cursos(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

INSERT INTO cursos (nombre)
VALUES
  ('Técnico en Gestión Administrativa'),
  ('Desarrollo de aplicaciones web'),
  ('Técnico Superior en Administración y Finanzas'),
  ('Administración de empresas');

INSERT INTO usuarios (nombre, email, contrasena, is_admin)
VALUES('Admin', 'Admin@admin.com', 'LFj3jr4EZucNSBKS+MS85w==', 1);