CREATE DATABASE IF NOT EXISTS rh_aspirantes
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE rh_aspirantes;

CREATE TABLE IF NOT EXISTS usuario (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario  VARCHAR(30)  NOT NULL UNIQUE,
    contrasena  VARCHAR(255) NOT NULL,
    created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS perfil (
    id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario       INT UNSIGNED NOT NULL UNIQUE,
    cedula           VARCHAR(20)  NOT NULL,
    nombre           VARCHAR(80)  NOT NULL,
    apellido         VARCHAR(80)  NOT NULL,
    estado_civil     ENUM('soltero','casado','divorciado','viudo','union_libre') DEFAULT NULL,
    genero           ENUM('masculino','femenino','otro','prefiero_no_decir')     NOT NULL,
    tipo_sangre      ENUM('A+','A-','B+','B-','AB+','AB-','O+','O-')            DEFAULT NULL,
    fecha_nacimiento DATE         NOT NULL,
    nacionalidad     VARCHAR(60)  NOT NULL,
    telefono         VARCHAR(20)  NOT NULL,
    residencia       VARCHAR(160) NOT NULL,
    correo           VARCHAR(120) NOT NULL,
    estado           ENUM('no_revisado','no_considerado','considerado') NOT NULL DEFAULT 'no_revisado',
    updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_perfil_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuario(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS rh_usuario (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario  VARCHAR(60)  NOT NULL UNIQUE,
    contrasena  VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS login_attempts (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    identifier   VARCHAR(120) NOT NULL,
    ip           VARCHAR(45)  NOT NULL,
    attempted_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_identifier (identifier),
    INDEX idx_ip         (ip),
    INDEX idx_time       (attempted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
