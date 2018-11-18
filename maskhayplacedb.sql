-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2018 a las 23:22:25
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

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`id_calificacion`, `lugar`, `usuario`, `calificacion`, `comentario`, `fecha`, `respuesta`) VALUES
(1, 1, 1, 3, 'Este es un buen restaurante', '2018-11-12', ''),
(2, 1, 2, 4, 'Es restaurante es excelente, me encanta el ambiente, 100% recomendado', '2018-11-11', ''),
(3, 1, 3, 2, 'No me parecio mucho el lugar', '2018-11-13', ''),
(5, 2, 3, 5, 'Me encanto el hotel, atencion de primera, ambientes limpios y confortantes', '2018-11-16', ''),
(8, 2, 2, 2, 'No me gusto el lugar, falta mejorar atencion', '2018-11-16', ''),
(11, 3, 2, 3, 'Este es mi comentario', '2018-11-17', '');

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

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `tipo`, `numero`, `lugar`) VALUES
(1, 'Telefono', '4414017', 1),
(2, 'Celular', '65706492', 1),
(3, 'Celular', '77999124', 2),
(4, 'Telefono', '4221556', 2),
(5, 'Telefono', '4567781', 2),
(6, 'Celular', '70763369', 3),
(7, 'Whatsapp', '67899121', 3);

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

--
-- Volcado de datos para la tabla `farmacia`
--

INSERT INTO `farmacia` (`id_farmacia`, `horario`, `turno`, `vacunas`, `servicio_enfermeria`, `entrega_domicilio`, `lugar`) VALUES
(1, '7:00 - 23:00', 0, 0, 1, 1, 3);

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

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `sabado`, `domingo`, `semanal`, `lun_vier`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `restaurante`) VALUES
(1, '8:00 - 20:00', '11:00 - 17:00', 0, NULL, '8:00 - 22:00', '8:00 - 22:00', '8:00 - 22:00', '8:00 - 22:00', '8:00 - 23:00', 1);

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

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `categoria`, `nivel`, `parqueo`, `piscina`, `area_recreativa`, `bar`, `cable`, `internet`, `aire_acondicionado`, `desayuno`, `gimnasio`, `mascota`, `spa`, `comedor`, `servicio_habitacion`, `lugar`) VALUES
(1, 'Hotel', 3, 1, 1, 0, 1, 1, 1, 0, 1, 1, 0, 0, 1, 0, 2);

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

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id_imagen`, `descripcion`, `url`, `lugar`) VALUES
(1, 'resto1', 'assets/public/img/imagenes/1_1.jpeg', 1),
(2, 'resto2', 'assets/public/img/imagenes/1_2.jpeg', 1),
(4, 'Resto3', 'assets/public/img/imagenes/1_3.jpeg', 1),
(8, 'Hotel1', 'assets/public/img/imagenes/2_1.jpeg', 2),
(9, 'Hotel2', 'assets/public/img/imagenes/2_2.jpeg', 2),
(10, 'Hotel3', 'assets/public/img/imagenes/2_3.jpeg', 2),
(11, 'Farma1', 'assets/public/img/imagenes/3_1.jpeg', 3),
(12, 'Farma2', 'assets/public/img/imagenes/3_2.jpeg', 3),
(13, 'Farma3', 'assets/public/img/imagenes/3_3.jpeg', 3);

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
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `categoria` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `revisado` tinyint(1) NOT NULL DEFAULT '0',
  `encargado_rev` int(11) DEFAULT NULL,
  `observaciones` text COLLATE utf8_spanish_ci,
  `estado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`id_lugar`, `nombre_lugar`, `direccion`, `longitud_gps`, `latitud_gps`, `usuario`, `descripcion`, `logo`, `activo`, `categoria`, `revisado`, `encargado_rev`, `observaciones`, `estado`) VALUES
(1, 'Pollos Lopez', 'Av. Dorvigni 1827 entre Vasco de Gama y VIlla de Oropeza', -66.183877, -17.376269, 1, 'Nuevo restaurante de Pollos, muy deliciosos que se encuentran ubicados en la zona del hipodromo venga a probarlos son muy delciosos.', 'assets/public/img/logos/1.jpeg', 1, 'Restaurante', 0, NULL, NULL, NULL),
(2, 'Hotel Diplomat', 'Av. Peru entre Visconte Almanza 2445', -66.180914, -17.377673, 3, 'Hotel Diplomat el lugar que usted necesita para descansar, confie en nuestros servicios contamos con ambientes completos y diversos para toda nuestra poblacion.', 'assets/public/img/logos/2.jpeg', 1, 'Hotel', 0, NULL, NULL, NULL),
(3, 'Farmacia \"Los Angeles\"', 'Av. Villa de Galindo 256', -66.165169, -17.378824, 2, 'Le ofrecemos los mejores medicamentos, a su alcance al mejor precio, damos la mejor atencion posible, por que usted es primero para nosotros', 'assets/public/img/logos/3.jpeg', 1, 'Farmacia', 0, NULL, NULL, NULL);

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

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`id_medicamento`, `nombre_medicamento`, `precio_medicamento`, `descuento`, `precio_descuento`, `descripcion`, `farmacia`, `imagen_medicamento`) VALUES
(1, 'Paracetamol Forte', 45, 1, 34.5, 'Blester de 10 Unidades', 1, NULL),
(2, 'Biodem', 155, 1, 120, 'Calmante - 125mL', 1, NULL);

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

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `nombre_menu`, `decripcion_menu`, `dia_semana`, `restaurante`) VALUES
(1, 'Especial', 'Menu para el dia a dia, con mucha variedad, visite nuestro restaurante para poder encontrar el plato que necesite a un precio acorde.', 'Jueves', 1);

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

--
-- Volcado de datos para la tabla `menu_plato`
--

INSERT INTO `menu_plato` (`id_menuplato`, `nombre_plato`, `precio_plato`, `descripcion_plato`, `menu`, `imagen_menuplato`) VALUES
(1, 'Almuerzo Completo', 15, 'Sopa Esparragos / Albondiga', 1, NULL),
(2, 'Chuleta de Cerdo', 20, 'Cerdo + Pure de Papa + Buffet Ensalada', 1, NULL);

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

--
-- Volcado de datos para la tabla `pieza`
--

INSERT INTO `pieza` (`id_pieza`, `nombre_pieza`, `descripcion_pieza`, `precio_noche`, `sanitario_privado`, `frigobar`, `hotel`, `imagen_pieza`) VALUES
(1, 'Simple', 'Pieza simple de una cama, generalmente para una sola persona.', 125, 1, 1, 1, NULL),
(2, 'Matrimonial', 'Habitacion con cama matrimonial. especialmente para dos personas, buen ambiente y jacuzzi incluido', 185, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `restaurante` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nombre_reserva` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cantidad_personas` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `restaurante`, `usuario`, `nombre_reserva`, `fecha`, `hora`, `cantidad_personas`, `estado`) VALUES
(9, 1, 3, 'Carlos Velasquez', '2018-11-30', '20:00:00', 4, 'Pendiente'),
(10, 1, 3, 'Marcelo', '2018-11-27', '10:00:00', 2, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

CREATE TABLE `restaurante` (
  `id_restaurante` int(11) NOT NULL,
  `categoria` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `parqueo` tinyint(1) NOT NULL DEFAULT '0',
  `recreativo` tinyint(1) NOT NULL DEFAULT '0',
  `area_fumadores` tinyint(1) NOT NULL DEFAULT '0',
  `auto_servicio` tinyint(1) NOT NULL DEFAULT '0',
  `internet` tinyint(1) NOT NULL DEFAULT '0',
  `lugar` int(11) NOT NULL,
  `reserva_mesa` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `restaurante`
--

INSERT INTO `restaurante` (`id_restaurante`, `categoria`, `parqueo`, `recreativo`, `area_fumadores`, `auto_servicio`, `internet`, `lugar`, `reserva_mesa`) VALUES
(1, 'Polleria', 1, 0, 0, 0, 1, 1, 1);

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
-- Volcado de datos para la tabla `usuarioregistrado`
--

INSERT INTO `usuarioregistrado` (`id_usuarioregistrado`, `usuario`, `password`, `nombre`, `apellidos`, `correo`, `negocio`, `celular`) VALUES
(1, 'topx777', 'slr8830213', 'Abel', 'Lopez Paniagua', 'topx777@gmail.com', 1, '65706492'),
(2, 'groverm', '1234', 'Grover', 'Mamani Veizan', 'groverf@gmail.com', 0, '66889832'),
(3, 'carlangas', '12345', 'Carlos Rodrigo', 'Velasquez Castellon', 'carlas@gmail.com', 0, '68992212'),
(4, 'shakir', '123', 'Marcelo', 'Vargas', 'marce@gmail.com', 0, '67892222');

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
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  MODIFY `id_farmacia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `menu_plato`
--
ALTER TABLE `menu_plato`
  MODIFY `id_menuplato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pieza`
--
ALTER TABLE `pieza`
  MODIFY `id_pieza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `superusuario`
--
ALTER TABLE `superusuario`
  MODIFY `id_superusuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarioregistrado`
--
ALTER TABLE `usuarioregistrado`
  MODIFY `id_usuarioregistrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
