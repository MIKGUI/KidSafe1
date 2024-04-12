-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2024 a las 07:22:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `safekid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Contraseña` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`ID`, `Nombre`, `Correo`, `Contraseña`) VALUES
(1, 'Miguel', 'non@l.com', '1234'),
(2, 'Miguel', 'non@l.com', 'jolwis'),
(3, 'Miguel', 'a@a.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuidador`
--

CREATE TABLE `cuidador` (
  `ID_Cuidador` int(11) NOT NULL,
  `ID_Cuenta` int(11) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `NumTel` varchar(20) DEFAULT NULL,
  `Parentesco` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuidador`
--

INSERT INTO `cuidador` (`ID_Cuidador`, `ID_Cuenta`, `Nombre`, `Apellido1`, `Apellido2`, `Edad`, `NumTel`, `Parentesco`) VALUES
(1, 3, 'Miguelppp', 'Mendoza', 'Alvarado', 21, '4691239902', 'hermano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hijo`
--

CREATE TABLE `hijo` (
  `ID_Hijo` int(11) NOT NULL,
  `ID_Cuenta` int(11) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Vinculo` varchar(50) DEFAULT NULL,
  `Datos_del_Niño` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hijo`
--

INSERT INTO `hijo` (`ID_Hijo`, `ID_Cuenta`, `Nombre`, `Apellido1`, `Apellido2`, `Edad`, `Vinculo`, `Datos_del_Niño`) VALUES
(1, 3, 'Miguels', 'Mendoza', 'a', 21, 'server actual:Kidsafe(5)/<br /><b>Warning</b>:  Un', 'es niño'),
(2, 3, 'Miguelon', 'Mendoza', 'a', 21, 'server actual:Kidsafe(5)/<br /><b>Warning</b>:  Un', 'es niño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `madre`
--

CREATE TABLE `madre` (
  `ID_Madre` int(11) NOT NULL,
  `ID_Cuenta` int(11) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `NumTel` varchar(20) DEFAULT NULL,
  `Tutor` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `madre`
--

INSERT INTO `madre` (`ID_Madre`, `ID_Cuenta`, `Nombre`, `Apellido1`, `Apellido2`, `Edad`, `NumTel`, `Tutor`) VALUES
(1, 3, 'E', 'a', 'a', 21, '223', 1),
(2, 3, 'A', 'a', 'a', 21, '223', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padre`
--

CREATE TABLE `padre` (
  `ID_Padre` int(11) NOT NULL,
  `ID_Cuenta` int(11) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `NumTel` varchar(20) DEFAULT NULL,
  `Tutor` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `padre`
--

INSERT INTO `padre` (`ID_Padre`, `ID_Cuenta`, `Nombre`, `Apellido1`, `Apellido2`, `Edad`, `NumTel`, `Tutor`) VALUES
(1, NULL, 'Marco', 'Mendoza', 'Alvarado', 12, '3222', NULL),
(2, 3, 'Miguelin', 'Mendoza', 'Alvarado', 21, '4691239902', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `cuidador`
--
ALTER TABLE `cuidador`
  ADD PRIMARY KEY (`ID_Cuidador`),
  ADD KEY `ID_Cuenta` (`ID_Cuenta`);

--
-- Indices de la tabla `hijo`
--
ALTER TABLE `hijo`
  ADD PRIMARY KEY (`ID_Hijo`),
  ADD KEY `ID_Cuenta` (`ID_Cuenta`);

--
-- Indices de la tabla `madre`
--
ALTER TABLE `madre`
  ADD PRIMARY KEY (`ID_Madre`),
  ADD KEY `ID_Cuenta` (`ID_Cuenta`);

--
-- Indices de la tabla `padre`
--
ALTER TABLE `padre`
  ADD PRIMARY KEY (`ID_Padre`),
  ADD KEY `ID_Cuenta` (`ID_Cuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cuidador`
--
ALTER TABLE `cuidador`
  MODIFY `ID_Cuidador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hijo`
--
ALTER TABLE `hijo`
  MODIFY `ID_Hijo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `madre`
--
ALTER TABLE `madre`
  MODIFY `ID_Madre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `padre`
--
ALTER TABLE `padre`
  MODIFY `ID_Padre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuidador`
--
ALTER TABLE `cuidador`
  ADD CONSTRAINT `cuidador_ibfk_1` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuenta` (`ID`);

--
-- Filtros para la tabla `hijo`
--
ALTER TABLE `hijo`
  ADD CONSTRAINT `hijo_ibfk_1` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuenta` (`ID`);

--
-- Filtros para la tabla `madre`
--
ALTER TABLE `madre`
  ADD CONSTRAINT `madre_ibfk_1` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuenta` (`ID`);

--
-- Filtros para la tabla `padre`
--
ALTER TABLE `padre`
  ADD CONSTRAINT `padre_ibfk_1` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuenta` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
