CREATE DATABASE IF NOT EXISTS `crud_php`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE `crud_php`;

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id`               INT UNSIGNED   NOT NULL AUTO_INCREMENT,
  `nombre_completo`  VARCHAR(150)   NOT NULL,
  `documento`        VARCHAR(20)    NOT NULL,
  `email`            VARCHAR(100)   NOT NULL,
  `telefono`         VARCHAR(20)    DEFAULT NULL,
  `direccion`        VARCHAR(255)   DEFAULT NULL,
  `rol`              VARCHAR(50)    NOT NULL,
  `estado`           VARCHAR(20)    NOT NULL DEFAULT 'Activo',
  `created_at`       TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`       TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_email` (`email`),
  INDEX `idx_estado` (`estado`),
  INDEX `idx_rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
