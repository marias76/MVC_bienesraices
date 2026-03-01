CREATE DATABASE IF NOT EXISTS bienesraices
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE bienesraices;

CREATE TABLE IF NOT EXISTS vendedores (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL,
  apellidos VARCHAR(80) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  INDEX idx_vendedores_nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS propiedades (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(120) NOT NULL,
  precio DECIMAL(12,2) NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  habitaciones INT UNSIGNED NOT NULL,
  wc INT UNSIGNED NOT NULL,
  estacionamiento INT UNSIGNED NOT NULL DEFAULT 0,
  creado DATETIME NOT NULL,
  vendedor_id INT UNSIGNED NOT NULL,
  INDEX idx_propiedades_vendedor (vendedor_id),
  INDEX idx_propiedades_creado (creado),
  CONSTRAINT fk_propiedades_vendedor
    FOREIGN KEY (vendedor_id)
    REFERENCES vendedores(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO usuarios (email, password)
VALUES ('admin@bienesraices.com', '$2y$10$3mz172QLi4UmIkQIx8HkWui4COaWUca2CBAI6k970sO1gHf7IMLOO');
