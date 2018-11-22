-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2018 a las 12:36:26
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
(11, 3, 2, 3, 'Este es mi comentario', '2018-11-17', ''),
(12, 2, 1, 5, 'Me encanto el hotel, atencion de maravilla', '2018-11-18', ''),
(13, 3, 1, 2, 'Mas o menos la atencion no es muy buena', '2018-11-18', '');

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
(7, 'Whatsapp', '67899121', 3),
(26, 'Fijo', '4244954', 22),
(27, 'Celular', '65194792', 24),
(28, 'Fijo', '4568265', 25),
(29, 'Celular', '65321589', 26),
(30, 'Celular', '72282312', 27),
(31, 'Fijo', '4938015', 28),
(32, 'Whatsapp', '763467347', 29),
(33, 'Fijo', '4462365', 29),
(34, 'Celular', '97626554', 30),
(35, 'Fijo', '4244956', 31),
(36, 'Fijo', '44223623', 32),
(37, 'Celular', '65548848', 33),
(38, 'Fijo', '4244896', 34),
(39, 'Fijo', '44623784', 35);

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
(1, '7:00 - 23:00', 0, 0, 1, 1, 3),
(4, '8:00 - 8:00', 1, 0, 0, 1, 26),
(5, '24:00 - 24:00', 1, 0, 0, 1, 31),
(6, '7:00 - 22:00', 1, 1, 1, 1, 34),
(7, '10:00 - 20:00', 0, 1, 1, 1, 35);

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
(1, 'Hotel', 3, 1, 1, 0, 1, 1, 1, 0, 1, 1, 0, 0, 1, 0, 2),
(10, 'Hotel', 4, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 22),
(11, 'Hotel', 4, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 25),
(12, 'Hotel', 4, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
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
(13, 'Farma3', 'assets/public/img/imagenes/3_3.jpeg', 3),
(58, 'Amplia piscina disponible las 24hrs', 'assets/public/img/imagenes/350315429011836312.jpg', 22),
(59, 'Amplias dormitorios y camas familiares', 'assets/public/img/imagenes/650415429011837393.jpg', 22),
(60, 'SalÃ³n de eventos ambientes cÃ³modos para reuniones', 'assets/public/img/imagenes/674115429011838578.jpg', 22),
(61, 'los mejores platos tipicos \"SILPANCHO\"', 'assets/public/img/imagenes/57391542901404506.jpg', 24),
(62, 'los mejores platos de \" PIQUE\"', 'assets/public/img/imagenes/853415429014045810.jpg', 24),
(63, 'Amplias y cÃ³modas habitaciones', 'assets/public/img/imagenes/659215429016474775.jpg', 25),
(64, 'Camas Amplias para numerosas familias ', 'assets/public/img/imagenes/71115429016477896.jpg', 25),
(65, 'La mejor piscina de la ciudad atemperada', 'assets/public/img/imagenes/159015429016479900.jpg', 25),
(66, 'Nuestro equipo de trabajo', 'assets/public/img/imagenes/916515429022983670.jpg', 26),
(67, 'nuestra tienda', 'assets/public/img/imagenes/21881542902298112.jpg', 26),
(68, 'nuestra tienda con variedad de productos', 'assets/public/img/imagenes/5431542902298327.jpg', 26),
(69, 'nuestra sucursal', 'assets/public/img/imagenes/453515429022987783.jpeg', 26),
(70, '', 'assets/public/img/imagenes/909215429022981696.', 26),
(71, 'Mesas con atenciÃ³n preferencial', 'assets/public/img/imagenes/405015429023154783.jpg', 27),
(72, 'La mejor atenciÃ³n de la ciudad en comidas', 'assets/public/img/imagenes/82015429031192188.jpg', 28),
(73, 'Mesas y sillas cÃ³modas para todos nuestros clientes ', 'assets/public/img/imagenes/903115429031192842.jpg', 28),
(74, 'La mejor Comida tÃ­pica Oriental de Bolivia ', 'assets/public/img/imagenes/246215429031194276.jpg', 28),
(75, 'img combo', 'assets/public/img/imagenes/764815429036356917.png', 29),
(76, 'Img interior', 'assets/public/img/imagenes/4301542903635419.png', 29),
(77, 'Img combo 2', 'assets/public/img/imagenes/728215429036359281.png', 29),
(78, 'pollos la mejor opcion', 'assets/public/img/imagenes/935515429036966495.jpg', 30),
(79, 'AtenciÃ³n rÃ¡pida y amable', 'assets/public/img/imagenes/364415429036973657.jpg', 31),
(80, 'Consulte nuestros precios y productos', 'assets/public/img/imagenes/360315429036977654.jpg', 31),
(81, 'atenciÃ³n las 24 hrs.', 'assets/public/img/imagenes/724715429036971278.jpg', 31),
(82, 'Interior', 'assets/public/img/imagenes/939515429040713166.png', 32),
(83, 'Especial de la Casa', 'assets/public/img/imagenes/964815429040718134.png', 32),
(84, 'Pizza estilo ClÃ¡sico', 'assets/public/img/imagenes/861315429040714457.png', 32),
(85, 'nuestros habitaciones', 'assets/public/img/imagenes/819615429043143951.jpg', 33),
(86, 'Productos garantizados', 'assets/public/img/imagenes/20515429043458851.jpg', 34),
(87, 'Amabilidad y paciencia es lo que nos caracteriza', 'assets/public/img/imagenes/899015429043455465.jpg', 34),
(88, 'Consulte todos nuestros productos al mejor precio', 'assets/public/img/imagenes/1281154290434584.jpg', 34),
(89, 'Imagen Stock', 'assets/public/img/imagenes/42401542904497611.png', 35),
(90, 'Imagen Equipamiento', 'assets/public/img/imagenes/954515429044976328.png', 35),
(91, 'Imagen Fachada', 'assets/public/img/imagenes/357115429044978703.png', 35);

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
  `logo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
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
(1, 'Pollos Lopez', 'Av. Dorvigni 1827 entre Vasco de Gama y VIlla de Oropeza', -66.183877, -17.376269, 1, 'Nuevo restaurante de Pollos, muy deliciosos que se encuentran ubicados en la zona del hipodromo venga a probarlos son muy delciosos.', 'assets/public/img/logos/1.jpeg', 1, 'Restaurante', 1, 1, NULL, 'Aceptado'),
(2, 'Hotel Diplomat', 'Av. Peru entre Visconte Almanza 2445', -66.180914, -17.377673, 3, 'Hotel Diplomat el lugar que usted necesita para descansar, confie en nuestros servicios contamos con ambientes completos y diversos para toda nuestra poblacion.', 'assets/public/img/logos/2.jpeg', 1, 'Hotel', 1, 1, NULL, 'Aceptado'),
(3, 'Farmacia \"Los Angeles\"', 'Av. Villa de Galindo 256', -66.165169, -17.378824, 2, 'Le ofrecemos los mejores medicamentos, a su alcance al mejor precio, damos la mejor atencion posible, por que usted es primero para nosotros', 'assets/public/img/logos/3.jpeg', 1, 'Farmacia', 1, 1, NULL, 'Aceptado'),
(22, 'Hotel Magna', 'Boulevard Susmozas No. 752', -66.17834201068115, -17.382109473917083, 7, '\r\n\r\nLOS HUÃ‰SPEDES QUE BUSCAN EXCLUSIVIDAD PUEDEN SUMERGIRSE EN EL AMBIENTE DISCRETO Y DISTINGUIDO DEL MEJOR BOUTIQUE HOTEL DE LUJO, QUE CUENTA CON 12 ESPECTACULARES HABITACIONES Y SUITES DE ENSUEÃ‘O.\r\n', 'assets/public/img/logos/624615429011834663.jpg', 1, 'Hotel', 1, 1, NULL, 'Aceptado'),
(24, 'RESTAURANTE BIGOTON', 'esquina calama y ayacucho', -66.15782847613525, -17.39677097605786, 9, 'la mejor opcion de degustar los mejores platos tipicos de cochabamba', 'assets/public/img/logos/383015429014047816.jpg', 1, 'Restaurante', 1, 1, NULL, 'Aceptado'),
(25, 'Hotel Ostella', 'Avenida Onega No. 158', -66.1492454072876, -17.373017114379092, 10, 'El hotel, inmejorablemente situado y que ocupa un antiguo palacete del siglo XIX ampliado y rehabilitado, presenta una oferta de alojamiento', 'assets/public/img/logos/776815429016479991.jpg', 1, 'Hotel', 1, 1, NULL, 'Aceptado'),
(26, 'Farma Elias', 'calle 16 de julio entre calle bolivar', -66.14954581469726, -17.39226617028582, 12, 'Nuestra farmacia  brinda servicio a todo tipo de clientes con variedad de medicamentos,', 'assets/public/img/logos/728115429022985346.png', 1, 'Farmacia', 1, 1, NULL, 'Aceptado'),
(27, 'Chifa & thai', 'Todoran No. 808', -66.15448107928466, -17.38501729539346, 11, 'Restaurante con el sabor caracterÃ­stico chino encuentranos en Cochabamba', 'assets/public/img/logos/506715429023151008.jpg', 1, 'Restaurante', 1, 1, NULL, 'Aceptado'),
(28, 'Casa del camba', 'Real del Santo Domingo No. 539', -66.16267791003418, -17.37240274947721, 15, 'La mejor comida camba de Bolivia Ãºnica con su sabor Oriental.', 'assets/public/img/logos/897915429031196575.jpg', 1, 'Restaurante', 1, 1, NULL, 'Aceptado'),
(29, 'Chicken Kingdom', 'Av. Juan de la Rosa y Jaime Mendoza', -66.16928687304687, -17.37686708750097, 18, 'Los mejores Pollos con nuestra famosa Salsa', 'assets/public/img/logos/239815429036354162.png', 1, 'Restaurante', 1, 1, NULL, 'Aceptado'),
(30, 'POLLOS FELIPE', 'AVENIDA AYACUCHO ENTRE HEROINAS', -66.15868678302002, -17.392593796265043, 17, 'nustros pollos son los mejores de todo cochabamba', 'assets/public/img/logos/92721542903696563.jpg', 1, 'Restaurante', 1, 1, NULL, 'Aceptado'),
(31, 'Farmacia Creis', 'Cerrada Romana No. 485', -66.16829982012939, -17.37834152385432, 20, 'En nuestras farmacia le ofrecemos los mejores productos farmacÃ©uticos de calidad. Gracias por elegirnos', 'assets/public/img/logos/181215429036977021.jpg', 1, 'Farmacia', 1, 1, NULL, 'Aceptado'),
(32, 'Ellis Pizzas', 'Av. Santa Cruz y Beni', -66.15666976184082, -17.377399524220532, 21, 'La mejor Pizza al estilo italiano', 'assets/public/img/logos/180915429040712880.png', 0, 'Restaurante', 0, NULL, NULL, NULL),
(33, 'HOTEL PARK', 'avenida America y   Santa Cruz', -66.15688433856201, -17.373017114379092, 8, 'la mejor atenciÃ³n en hoteles y servicios', 'assets/public/img/logos/574215429043144816.jpg', 0, 'Hotel', 0, NULL, NULL, NULL),
(34, 'Farmacia PFARMA', 'Cerrada Romana No. 485', -66.16636862963867, -17.378628218432986, 22, 'La farmacia mas grade de la ciudad con productos de calidad y los mejores precios.', 'assets/public/img/logos/915429043457509.jpg', 0, 'Farmacia', 0, NULL, NULL, NULL),
(35, 'Farmacia San Elias', 'Pedro Blanco y Trinidad', -66.15752806872558, -17.376088907971763, 23, 'Satisfaciendo las necesidades medicas del cliente con un servicio amigable y confiable', 'assets/public/img/logos/411815429044978834.png', 0, 'Farmacia', 0, NULL, NULL, NULL);

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
(10, 1, 3, 'Marcelo Quiroga', '2018-11-30', '10:00:00', 6, 'Pendiente'),
(11, 1, 3, 'Abelito Lopez', '2018-11-27', '11:00:00', 5, 'Pendiente'),
(12, 1, 1, 'Abelito Lopez', '2018-11-25', '12:00:00', 5, 'Pendiente');

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
(1, 'Polleria', 1, 0, 0, 0, 1, 1, 1),
(5, 'COMIDA TÃPICA', 1, 1, 0, 0, 0, 24, 1),
(6, 'Comida china', 1, 0, 1, 0, 1, 27, 1),
(7, 'Comida Tipica ', 1, 0, 0, 0, 1, 28, 1),
(8, 'Polleria', 0, 0, 0, 1, 1, 29, 0),
(9, 'Pollos', 1, 1, 0, 0, 0, 30, 1),
(10, 'Pizzeria', 1, 1, 1, 0, 0, 32, 0);

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

--
-- Volcado de datos para la tabla `superusuario`
--

INSERT INTO `superusuario` (`id_superusuario`, `usuario`, `password`, `nombre`, `apellidos`) VALUES
(1, 'Administrador', 'admin', 'Abel', 'Lopez');

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
(3, 'carlangas', '12345', 'Carlos Rodrigo', 'Velasquez Castellon', 'carlas@gmail.com', 1, '68992212'),
(4, 'shakir', '123', 'Marcelo', 'Vargas', 'marce@gmail.com', 0, '67892222'),
(6, 'Jona123', '1234', 'Jona', 'Sevilla', 'sevilla@gmail.com', 0, '65422112'),
(7, 'Mauricio Gamarra', 'q1w2e3r4t5', 'Mauricio', 'Gamarra Vargas', 'mauriciogamarravargas@gmail.com', 0, '72282312'),
(8, 'fernandito', '123456789', 'fernandito', 'vargas rios', 'ferdynan@gmail.com', 0, '65194792'),
(9, 'pedrito', '123456789', 'pedro', 'rios vargas', 'pedro@gmail,com', 0, '65194792'),
(10, 'pabloh', 'q1w2e3r4t5', 'Pablo', 'Hilaquita yujra', 'pablohy@gmail.com', 0, '75963214'),
(11, 'MarioTorres', 'q1w2e3r4t5', 'Mario', 'torrez', 'mariotorres@gmail.com', 0, '6038825'),
(12, 'kevin', '123456', 'kevin', 'cardenas', 'jayrokevin1@gmail.com', 0, '78945612'),
(13, 'Adrian', 'admin1', 'Adrian', 'Reyes', 'adrian11@gmail', 0, '79854652'),
(14, 'kriz', '123456', 'kriz', 'gutierrez', 'krizg49@gmail.com', 0, '68508768'),
(15, 'ChapoGuzman', 'q1w2e3r4t5', 'Joaquin', 'Guzman Loera', 'chapoguzman@gmail.com', 0, '75698212'),
(16, 'AMADO CARRILLO', '123456789', 'AMADO', ' CARRILLO', 'AMADOLEAL@GMAIL', 0, '65254878'),
(17, 'AMADO LEAL', '123456789', 'Amado', 'Leal', 'AMADO@gmail.com', 0, '66519474'),
(18, 'Red', '1234', 'hello', 'pichu', 'red@gmail.com', 0, '7777777888'),
(19, 'lita', 'lala', 'Alejandra', 'Gomez', 'lita@yahoo.com', 0, 'Mendoza'),
(20, 'ArmandoEscalera', 'q1w2e3r4t5', 'Armando', 'Escalera', 'ArmandoEscalera@gmail.com', 0, '60325869'),
(21, 'Redding', '1111', 'Rodolfo', 'Sanchez', 'red523@hotmail.com', 0, '77346236'),
(22, 'Ventura X', 'q1w2e3r4t5', ' Ventura ', 'Tenelema Cabanilla', 'fmcabanilla12@yopmail.com', 0, '70798632'),
(23, 'Ghost123', '2222', 'Rodrigo', 'Rodriguez', 'Red5235@hotmail.com', 0, '77534263'),
(24, 'Jorge', '123456789', 'jorge', 'arturo', 'jorge@gmail.com', 0, '6567844');

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
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  MODIFY `id_farmacia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
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
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `superusuario`
--
ALTER TABLE `superusuario`
  MODIFY `id_superusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarioregistrado`
--
ALTER TABLE `usuarioregistrado`
  MODIFY `id_usuarioregistrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
