-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2026 a las 00:31:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rh_aspirantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(120) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `attempted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `estado_civil` enum('soltero','casado','divorciado','viudo','union_libre') DEFAULT NULL,
  `genero` enum('masculino','femenino','otro','prefiero_no_decir') NOT NULL,
  `tipo_sangre` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(60) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `residencia` varchar(160) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `estado` enum('no_revisado','no_considerado','considerado') NOT NULL DEFAULT 'no_revisado',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `id_usuario`, `cedula`, `nombre`, `apellido`, `estado_civil`, `genero`, `tipo_sangre`, `fecha_nacimiento`, `nacionalidad`, `telefono`, `residencia`, `correo`, `estado`, `updated_at`) VALUES
(5, 5, '8-106-134', '--....................-adf', 'Garía', 'divorciado', 'masculino', 'A-', '2004-03-31', 'BF', '9039-0904', 'ayala', 'fadsfa@aewr.com', 'considerado', '2026-05-17 17:24:58'),
(6, 6, '8-1065-234', 'AEGIS ASSETS ADVISOR', 'AEGIS ASSETS ADVISORS', 'soltero', 'masculino', 'A+', '0004-03-23', 'BD', '9039-0904', 'Chiriqui', 'fadsfa@aewr.com', 'no_revisado', '2026-05-17 00:33:36'),
(7, 7, '111111111111111111', '2', '3', 'casado', 'masculino', 'A-', '2026-05-17', 'BE', '123433333', '2', 'jonas@gmail.com', 'no_revisado', '2026-05-17 14:34:38'),
(8, 8, 'PE12345', 'hola', 'Cedeño', 'soltero', 'masculino', 'A-', '2004-01-21', 'BF', '12341234', ' la utp', 'jjjonas@gmail.com', 'no_revisado', '2026-05-18 22:42:51'),
(9, 11, '1-123-1234', 'IndianSlayer', 'Cedeño', 'soltero', 'masculino', 'B-', '1999-11-11', 'AD', '11234124', 'hwai', 'jjjonas@gmail.com', 'considerado', '2026-05-19 14:52:21'),
(10, 12, '1-123-1234', 'Guerra de los cien años', 'Cedeño', 'soltero', 'femenino', 'A-', '2000-12-12', 'BG', '12341234', ' la utp', 'joans@gmail.com', 'considerado', '2026-05-19 14:25:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rh_usuario`
--

CREATE TABLE `rh_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` varchar(60) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rh_usuario`
--

INSERT INTO `rh_usuario` (`id`, `id_usuario`, `contrasena`) VALUES
(1, 'jonatha', 'jonathan10'),
(2, 'JonasDB', '$2a$12$ICdjiaqOgH/g8MeerUIGj.fJ0SJa7h5V9tcob2TtPU4ZMF9bDpoVG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` varchar(30) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `perfil_completo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `id_usuario`, `contrasena`, `created_at`, `perfil_completo`) VALUES
(5, '12345', '$argon2id$v=19$m=65536,t=4,p=1$RjRuNUJ1MmtteC96M1JuNA$wNMI9qEC+T2KMdmxmlLJ3QqY+PDjpUp7d3KVCPhz+lE', '2026-05-17 00:03:00', 1),
(6, 'garciasjuan', '$argon2id$v=19$m=65536,t=4,p=1$NDhvcVpjUHF1QjhDbGVMWg$StOKFVkeziUU0+k92AEXnUsRgCeIfU1wMbhzcJH6p9k', '2026-05-17 00:33:04', 1),
(7, 'you', '$argon2id$v=19$m=65536,t=4,p=1$OUQ3MmdlcEdVZFpHVEMzMg$0In0yHGwrl4TVumvhDy2jm+edPsX+Oyv7/5+/VHGCbs', '2026-05-17 14:24:54', 1),
(8, 'Jonastan', '$argon2id$v=19$m=65536,t=4,p=1$TUV2UC80QlB1VEtHeFJ4Qw$BskS84ZVePOFfRnLqV87GWEn4fgi9KGrq4r2UPhom/o', '2026-05-18 21:49:04', 1),
(9, 'canario', '$argon2id$v=19$m=65536,t=4,p=1$TXozZlBMVU1OLy5WU2pIaA$XM8AEN2kKSji9C5bTDVWEj2zMfowCbC0/QELfA4qGWY', '2026-05-18 22:46:11', 0),
(11, 'sandiagomez', '$argon2id$v=19$m=65536,t=4,p=1$MXdaS2czMDVTUjdNRDhnLg$D4bPIdJdDTVfkQ1HQq/+ymIklsK2/8KMFvKeKGpSnGg', '2026-05-18 22:48:03', 1),
(12, 'rigomez', '$argon2id$v=19$m=65536,t=4,p=1$RjU3Vm56dXJzdW1mc2VsWA$AoA/ocE+/SBXh3wsdRzEkwSNdfO9uvenZ4kt8zTzTWQ', '2026-05-18 22:51:47', 1),
(13, 'jonas1', '$argon2id$v=19$m=65536,t=4,p=1$OU85UmpRWDdzWHFrZVNLLg$Dv6mx1KD/HZDhJEVFR4ZsY7+MpwOzeE42m99By9JWnY', '2026-05-19 14:30:20', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_identifier` (`identifier`),
  ADD KEY `idx_ip` (`ip`),
  ADD KEY `idx_time` (`attempted_at`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `rh_usuario`
--
ALTER TABLE `rh_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rh_usuario`
--
ALTER TABLE `rh_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `fk_perfil_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
