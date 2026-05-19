-- Database schema for Parcial 02
CREATE DATABASE IF NOT EXISTS parcial02 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE parcial02;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('applicant','rh') NOT NULL DEFAULT 'applicant',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS applicants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  cedula VARCHAR(50) NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  estado_civil VARCHAR(50),
  genero VARCHAR(20) NOT NULL,
  tipo_sangre VARCHAR(10),
  fecha_nacimiento DATE NOT NULL,
  nacionalidad VARCHAR(100) NOT NULL,
  telefono VARCHAR(50) NOT NULL,
  residencia TEXT NOT NULL,
  correo VARCHAR(255) NOT NULL,
  estado ENUM('no revisado','no considerado','considerado') NOT NULL DEFAULT 'no revisado',
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Default RH account (password: change after import)
INSERT IGNORE INTO users (username, email, password, role) VALUES (
  'adminrh', 'rh@example.com', '$2y$10$abcdefghijklmnopqrstuv', 'rh'
);
