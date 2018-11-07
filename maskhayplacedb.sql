-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2018 a las 14:02:08
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `maskhayplacedb`
--
CREATE DATABASE IF NOT EXISTS `maskhayplacedb` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `maskhayplacedb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_calificacion` int(11) NOT NULL,
  `lugar` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `calificacion` double NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `respuesta` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `tipo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `lugar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacia`
--

CREATE TABLE `farmacia` (
  `id_farmacia` int(11) NOT NULL,
  `horario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `turno` tinyint(1) NOT NULL DEFAULT '0',
  `vacunas` tinyint(1) NOT NULL DEFAULT '0',
  `servicio_enfermeria` tinyint(1) NOT NULL DEFAULT '0',
  `entrega_domicilio` tinyint(1) NOT NULL DEFAULT '0',
  `lugar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `sabado` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domingo` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `semanal` tinyint(1) NOT NULL DEFAULT '0',
  `lun_vier` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lunes` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `martes` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `miercoles` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `jueves` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `viernes` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `categoria` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `parqueo` tinyint(1) NOT NULL DEFAULT '0',
  `piscina` tinyint(1) NOT NULL DEFAULT '0',
  `area_recreativa` tinyint(1) NOT NULL DEFAULT '0',
  `bar` tinyint(1) NOT NULL DEFAULT '0',
  `cable` tinyint(1) NOT NULL DEFAULT '0',
  `internet` tinyint(1) NOT NULL DEFAULT '0',
  `aire_acondicionado` tinyint(1) NOT NULL DEFAULT '0',
  `desayuno` tinyint(1) NOT NULL DEFAULT '0',
  `gimnasio` tinyint(1) NOT NULL DEFAULT '0',
  `mascota` tinyint(1) NOT NULL DEFAULT '0',
  `spa` tinyint(1) NOT NULL DEFAULT '0',
  `comedor` tinyint(1) NOT NULL DEFAULT '0',
  `servicio_habitacion` tinyint(1) NOT NULL DEFAULT '0',
  `lugar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `lugar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `id_lugar` int(11) NOT NULL,
  `nombre_lugar` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `longitud_gps` double NOT NULL,
  `latitud_gps` double NOT NULL,
  `usuario` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `id_medicamento` int(11) NOT NULL,
  `nombre_medicamento` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `precio_medicamento` double NOT NULL,
  `descuento` int(11) NOT NULL,
  `precio_descuento` double NOT NULL,
  `descripcion` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `farmacia` int(11) NOT NULL,
  `imagen_medicamento` varchar(55) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nombre_menu` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `decripcion_menu` text COLLATE utf8_spanish_ci NOT NULL,
  `dia_semana` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_plato`
--

CREATE TABLE `menu_plato` (
  `id_menuplato` int(11) NOT NULL,
  `nombre_plato` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `precio_plato` int(11) NOT NULL,
  `descripcion_plato` text COLLATE utf8_spanish_ci NOT NULL,
  `menu` int(11) NOT NULL,
  `imagen_menuplato` varchar(55) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pieza`
--

CREATE TABLE `pieza` (
  `id_pieza` int(11) NOT NULL,
  `nombre_pieza` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_pieza` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_noche` int(11) NOT NULL,
  `sanitario_privado` tinyint(1) NOT NULL DEFAULT '0',
  `frigobar` tinyint(1) NOT NULL DEFAULT '0',
  `hotel` int(11) NOT NULL,
  `imagen_pieza` varchar(55) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `restaurante` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nombre_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cantidad_personas` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

CREATE TABLE `restaurante` (
  `id_restaurante` int(11) NOT NULL,
  `horario` int(11) NOT NULL,
  `categoria` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `parqueo` tinyint(1) NOT NULL DEFAULT '0',
  `recreativo` tinyint(1) NOT NULL DEFAULT '0',
  `area_fumadores` tinyint(1) NOT NULL DEFAULT '0',
  `auto_servicio` tinyint(1) NOT NULL DEFAULT '0',
  `internet` tinyint(1) NOT NULL DEFAULT '0',
  `lugar` int(11) NOT NULL,
  `reserva_mesa` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superusuario`
--

CREATE TABLE `superusuario` (
  `id_superusuario` int(11) NOT NULL,
  `usuario` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(35) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioregistrado`
--

CREATE TABLE `usuarioregistrado` (
  `id_usuarioregistrado` int(11) NOT NULL,
  `usuario` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `negocio` tinyint(1) NOT NULL DEFAULT '0',
  `celular` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `lugar` (`lugar`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `lugar` (`lugar`);

--
-- Indices de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  ADD PRIMARY KEY (`id_farmacia`),
  ADD KEY `lugar` (`lugar`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `restaurante` (`restaurante`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `lugar` (`lugar`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `lugar` (`lugar`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id_lugar`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`id_medicamento`),
  ADD KEY `farmacia` (`farmacia`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `restaurante` (`restaurante`);

--
-- Indices de la tabla `menu_plato`
--
ALTER TABLE `menu_plato`
  ADD PRIMARY KEY (`id_menuplato`),
  ADD KEY `menu` (`menu`);

--
-- Indices de la tabla `pieza`
--
ALTER TABLE `pieza`
  ADD PRIMARY KEY (`id_pieza`),
  ADD KEY `hotel` (`hotel`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `restaurante` (`restaurante`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`id_restaurante`),
  ADD KEY `lugar` (`lugar`);

--
-- Indices de la tabla `superusuario`
--
ALTER TABLE `superusuario`
  ADD PRIMARY KEY (`id_superusuario`);

--
-- Indices de la tabla `usuarioregistrado`
--
ALTER TABLE `usuarioregistrado`
  ADD PRIMARY KEY (`id_usuarioregistrado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  MODIFY `id_farmacia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu_plato`
--
ALTER TABLE `menu_plato`
  MODIFY `id_menuplato` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pieza`
--
ALTER TABLE `pieza`
  MODIFY `id_pieza` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `superusuario`
--
ALTER TABLE `superusuario`
  MODIFY `id_superusuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarioregistrado`
--
ALTER TABLE `usuarioregistrado`
  MODIFY `id_usuarioregistrado` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `lugar` (`id_lugar`),
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarioregistrado` (`id_usuarioregistrado`);

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `lugar` (`id_lugar`);

--
-- Filtros para la tabla `farmacia`
--
ALTER TABLE `farmacia`
  ADD CONSTRAINT `farmacia_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `lugar` (`id_lugar`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`restaurante`) REFERENCES `restaurante` (`id_restaurante`);

--
-- Filtros para la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `lugar` (`id_lugar`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `lugar` (`id_lugar`);

--
-- Filtros para la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD CONSTRAINT `lugar_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarioregistrado` (`id_usuarioregistrado`);

--
-- Filtros para la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD CONSTRAINT `medicamento_ibfk_1` FOREIGN KEY (`farmacia`) REFERENCES `farmacia` (`id_farmacia`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`restaurante`) REFERENCES `restaurante` (`id_restaurante`);

--
-- Filtros para la tabla `menu_plato`
--
ALTER TABLE `menu_plato`
  ADD CONSTRAINT `menu_plato_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `pieza`
--
ALTER TABLE `pieza`
  ADD CONSTRAINT `pieza_ibfk_1` FOREIGN KEY (`hotel`) REFERENCES `hotel` (`id_hotel`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`restaurante`) REFERENCES `restaurante` (`id_restaurante`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarioregistrado` (`id_usuarioregistrado`);

--
-- Filtros para la tabla `restaurante`
--
ALTER TABLE `restaurante`
  ADD CONSTRAINT `restaurante_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `lugar` (`id_lugar`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
