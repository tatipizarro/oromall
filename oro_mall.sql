-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2015 a las 14:51:57
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `oro_mall`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE IF NOT EXISTS `autos` (
  `id_auto` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(200) DEFAULT NULL,
  `clase` varchar(50) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `año` year(4) DEFAULT NULL,
  `chasis` varchar(50) DEFAULT NULL,
  `motor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id_auto`, `placa`, `marca`, `modelo`, `clase`, `tipo`, `color`, `año`, `chasis`, `motor`) VALUES
(1, 'ABB7389', 'HYUNDAI', 'TUCSON IX GL 5P 4X2 2.0 TM AC', 'VEHICULO UTILITARIO', 'JEEP', 'PLOMO', 2011, 'KMHJT81BABU184056', 'G4KDAU139879'),
(2, 'OPA1261', 'MAZDA', 'B2200 CABINA DOBLE FULL', 'CAMIONETA', 'DOBLE CABINA\r\n', 'BLANCO', 2007, '8LFUNY0247M006363', 'F2834846'),
(3, 'GOW0993', 'KIA', 'PICANTO 1.1L', 'AUTOMOVIL', 'SEDAN', 'PLATEADO', 2006, 'KNABA24326T276125', 'G4HG6088335'),
(4, 'OBA2402', 'CHEVROLET', 'N200 VAN PASAJEROS 1.2L TM', 'VEHICULO UTILITARIO', 'FURGONETA', 'BLANCO', 2012, 'LZWCAGA1C4002821', 'LAQ8B71310993'),
(5, 'OBL0637', 'TOYOTA', 'HILUX', 'CAMION', 'PICK-UP', 'PLOMO', 1977, 'RN20407787', '12R1527568'),
(6, 'ABA7844', 'SUZUKI', 'GRAND VITARA SZ 2.0L 5P TM 4X2', 'VEHICULO UTILITARIO', 'JEEP', 'NEGRO', 2010, '8LDCB5356A0036781', 'J20A690517'),
(7, 'ABE3151', 'KIA', 'CARNIVAL 11PAS AC 2.9 5P 4X2 TM DIESEL', 'VEHICULO UTILITARIO', 'FURGONETA', 'PLATEADO', 2015, 'KNHMD371AF6594062', 'J3E000325'),
(9, 'TATTY123', '', '', '', '', '', 0000, '', ''),
(11, 'PATO123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'TITO', '', '', '', '', '', 0000, '', ''),
(13, 'XXX', '', '', '', '', '', 0000, '', ''),
(14, 'MATHEW', '', '', '', '', '', 0000, '', ''),
(15, 'PATOO123', '', '', '', '', '', 0000, '', ''),
(16, 'GOX630', '', '', '', '', '', 0000, '', ''),
(17, 'TATI', '', '', '', '', '', 0000, '', ''),
(18, 'PATO', '', '', '', '', '', 0000, '', ''),
(19, 'TATTY', '', '', '', '', '', 0000, '', ''),
(20, 'OPA-126', '', '', '', '', '', 0000, '', ''),
(21, '23', '', '', '', '', '', 0000, '', ''),
(22, 'OBA1230', '', '', '', '', '', 0000, '', ''),
(23, 'JUAN', '', '', '', '', '', 0000, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios`
--

CREATE TABLE IF NOT EXISTS `espacios` (
  `id_espacio` int(11) NOT NULL,
  `id_localidad` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT '1',
  `id_placa` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `espacios`
--

INSERT INTO `espacios` (`id_espacio`, `id_localidad`, `id_nivel`, `id_estado`, `id_placa`, `numero`) VALUES
(1, 1, 1, 1, 0, 1),
(2, 1, 1, 3, 0, 2),
(3, 1, 1, 1, 0, 3),
(4, 1, 1, 1, 0, 4),
(5, 1, 1, 1, 0, 5),
(6, 1, 1, 1, 0, 6),
(7, 1, 1, 1, 0, 7),
(8, 1, 1, 1, 0, 8),
(9, 1, 2, 1, 0, 1),
(10, 1, 2, 1, 0, 2),
(11, 1, 2, 1, 0, 3),
(12, 1, 2, 1, 0, 4),
(13, 1, 2, 1, 0, 5),
(14, 1, 2, 1, 0, 6),
(15, 1, 2, 1, 0, 7),
(16, 1, 2, 1, 0, 8),
(17, 1, 3, 1, 0, 1),
(18, 1, 3, 1, 0, 2),
(19, 1, 3, 1, 0, 3),
(20, 1, 3, 1, 0, 4),
(21, 1, 3, 1, 0, 5),
(22, 1, 3, 1, 0, 6),
(23, 1, 3, 1, 0, 7),
(24, 1, 3, 1, 0, 8),
(25, 1, 3, 1, 0, 9),
(26, 1, 3, 1, 0, 10),
(27, 1, 4, 1, 0, 1),
(28, 1, 4, 1, 0, 2),
(29, 1, 4, 1, 0, 3),
(30, 1, 4, 1, 0, 4),
(31, 1, 4, 1, 0, 5),
(32, 1, 4, 1, 0, 6),
(33, 1, 4, 1, 0, 7),
(34, 1, 4, 1, 0, 8),
(35, 1, 4, 1, 0, 9),
(36, 1, 4, 1, 0, 10),
(37, 1, 5, 1, 0, 1),
(38, 1, 5, 1, 0, 2),
(39, 1, 5, 1, 0, 3),
(40, 1, 5, 1, 0, 4),
(41, 1, 5, 1, 0, 5),
(42, 1, 5, 1, 0, 6),
(43, 1, 5, 1, 0, 7),
(44, 1, 5, 1, 0, 8),
(45, 1, 5, 1, 0, 9),
(46, 1, 5, 1, 0, 10),
(47, 2, 6, 1, 0, 1),
(48, 2, 6, 1, 0, 2),
(49, 2, 6, 1, 0, 3),
(50, 2, 6, 1, 0, 4),
(51, 2, 6, 1, 0, 5),
(52, 2, 6, 1, 0, 6),
(53, 2, 6, 1, 0, 7),
(54, 2, 6, 1, 0, 8),
(55, 2, 6, 1, 0, 9),
(56, 2, 6, 1, 0, 10),
(57, 2, 7, 1, 0, 1),
(58, 2, 7, 1, 0, 2),
(59, 2, 7, 1, 0, 3),
(60, 2, 7, 1, 0, 4),
(61, 2, 7, 1, 0, 5),
(62, 2, 7, 1, 0, 6),
(63, 2, 7, 1, 0, 7),
(64, 2, 7, 1, 0, 8),
(65, 2, 7, 1, 0, 9),
(66, 2, 7, 1, 0, 10),
(67, 2, 7, 1, 0, 11),
(68, 2, 7, 1, 0, 12),
(69, 2, 8, 1, 0, 1),
(70, 2, 8, 1, 0, 2),
(71, 2, 8, 1, 0, 3),
(72, 2, 8, 1, 0, 4),
(73, 2, 8, 1, 0, 5),
(74, 2, 8, 1, 0, 6),
(75, 2, 8, 1, 0, 7),
(76, 2, 8, 1, 0, 8),
(77, 2, 8, 1, 0, 9),
(78, 2, 8, 1, 0, 10),
(79, 2, 8, 1, 0, 11),
(80, 2, 8, 1, 0, 12),
(81, 2, 9, 1, 0, 1),
(82, 2, 9, 1, 0, 2),
(83, 2, 9, 1, 0, 3),
(84, 2, 9, 1, 0, 4),
(85, 2, 9, 1, 0, 5),
(86, 2, 9, 1, 0, 6),
(87, 2, 9, 1, 0, 7),
(88, 2, 9, 1, 0, 8),
(89, 2, 9, 1, 0, 9),
(90, 2, 9, 1, 0, 10),
(91, 2, 9, 1, 0, 11),
(92, 2, 9, 1, 0, 12),
(93, 3, 10, 1, 0, 1),
(94, 3, 10, 1, 0, 2),
(95, 3, 10, 3, 0, 3),
(96, 3, 10, 1, 0, 4),
(97, 3, 10, 1, 0, 5),
(98, 3, 10, 1, 0, 6),
(99, 3, 10, 1, 0, 7),
(100, 3, 10, 1, 0, 8),
(101, 4, 11, 1, 0, 1),
(102, 4, 11, 2, 0, 2),
(103, 4, 11, 1, 0, 3),
(104, 4, 11, 1, 0, 4),
(105, 4, 11, 1, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `nombre`) VALUES
(1, 'DISPONIBLE'),
(2, 'BLOQUEADO'),
(3, 'OCUPADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `id_historial` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `id_localidad` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `espacio_nombre` int(11) NOT NULL,
  `espacio_estado` int(11) NOT NULL,
  `fecha_llegada` date DEFAULT NULL,
  `hora_llegada` time DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `hora_salida` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_usuario`, `id_auto`, `id_localidad`, `id_nivel`, `espacio_nombre`, `espacio_estado`, `fecha_llegada`, `hora_llegada`, `fecha_salida`, `hora_salida`) VALUES
(1, 2, 1, 1, 1, 1, 3, '2015-10-11', '02:22:45', NULL, '00:00:01'),
(2, 1, 4, 2, 1, 7, 1, '2015-09-03', '09:29:16', NULL, '00:00:01'),
(3, 1, 12, 0, 0, 4, 1, '0000-00-00', '00:00:00', NULL, '00:00:01'),
(4, 1, 9, 1, 1, 6, 3, '2015-09-05', '00:00:00', NULL, '00:00:01'),
(5, 1, 2, 11, 1, 1, 6, '0000-00-00', '00:20:15', NULL, '00:00:01'),
(6, 2, 11, 1, 1, 7, 3, '2015-09-05', '00:54:09', NULL, '00:00:01'),
(7, 2, 14, 1, 1, 8, 3, '2015-09-05', '00:55:59', NULL, '00:00:01'),
(8, 2, 14, 1, 1, 8, 1, '2015-09-05', '00:56:51', NULL, '00:00:02'),
(9, 2, 11, 1, 1, 7, 1, '2015-09-05', '08:47:20', NULL, '00:00:02'),
(10, 2, 11, 1, 1, 1, 1, '2015-09-05', '08:47:58', NULL, '00:00:02'),
(11, 2, 11, 1, 1, 2, 1, '2015-09-05', '08:48:19', NULL, '00:00:02'),
(12, 2, 11, 1, 1, 3, 1, '2015-09-05', '08:48:28', NULL, '00:00:02'),
(13, 2, 11, 1, 1, 4, 1, '2015-09-05', '08:48:37', NULL, '00:00:02'),
(14, 2, 11, 1, 1, 5, 1, '2015-09-05', '08:48:45', NULL, '00:00:02'),
(15, 2, 11, 1, 1, 6, 1, '2015-09-05', '08:48:53', NULL, '00:00:02'),
(16, 2, 14, 1, 1, 8, 3, '2015-09-05', '08:50:22', NULL, '00:00:02'),
(17, 2, 14, 1, 1, 8, 1, '2015-09-05', '08:57:18', NULL, '00:00:02'),
(18, 2, 14, 1, 1, 8, 3, '2015-09-05', '09:02:50', NULL, '00:00:01'),
(19, 2, 14, 1, 1, 7, 3, '2015-09-05', '09:51:55', NULL, '00:00:02'),
(20, 2, 14, 1, 1, 8, 3, '2015-09-05', '09:53:05', NULL, '00:00:02'),
(21, 2, 2, 1, 1, 8, 3, '2015-09-05', '09:53:37', NULL, '00:00:01'),
(22, 2, 2, 1, 1, 8, 1, '2015-09-05', '09:55:46', NULL, '00:00:02'),
(23, 2, 1, 1, 1, 8, 3, '2015-09-05', '10:05:56', NULL, '00:00:01'),
(24, 2, 1, 1, 1, 8, 1, '2015-09-05', '10:07:10', NULL, '00:00:02'),
(25, 2, 1, 1, 1, 1, 3, '2015-09-05', '10:09:01', NULL, '00:00:01'),
(26, 2, 1, 1, 1, 1, 1, '2015-09-05', '10:09:39', NULL, '00:00:02'),
(27, 2, 15, 1, 1, 3, 3, '2015-09-05', '22:41:39', NULL, '00:00:01'),
(28, 2, 15, 1, 1, 3, 1, '2015-09-05', '22:42:22', NULL, '00:00:02'),
(29, 2, 11, 1, 1, 7, 3, '2015-09-06', '01:42:55', NULL, '00:00:01'),
(30, 2, 11, 1, 1, 7, 1, '2015-09-06', '01:43:01', NULL, '00:00:02'),
(31, 2, 1, 1, 1, 1, 3, '2015-09-00', '17:43:52', NULL, '00:00:01'),
(32, 2, 11, 1, 1, 2, 3, '2015-09-00', '23:16:26', NULL, '00:00:01'),
(33, 2, 9, 1, 2, 2, 3, '2015-09-01', '00:22:24', NULL, '00:00:01'),
(34, 2, 9, 1, 1, 1, 3, '2015-09-01', '00:22:42', '2015-09-00', '00:35:07'),
(35, 2, 12, 1, 1, 8, 3, '2015-09-01', '00:24:18', NULL, '00:00:01'),
(36, 2, 14, 1, 2, 4, 3, '2015-09-01', '00:41:25', NULL, '00:00:01'),
(37, 2, 9, 1, 2, 7, 3, '2015-09-01', '00:41:57', NULL, '00:00:01'),
(38, 2, 1, 1, 4, 10, 3, '2015-09-01', '00:42:26', NULL, '00:00:01'),
(39, 2, 16, 1, 5, 8, 3, '2015-09-01', '00:42:42', NULL, '00:00:01'),
(40, 2, 2, 1, 5, 3, 3, '2015-09-01', '00:42:52', NULL, '00:00:01'),
(41, 0, 9, 0, 1, 3, 3, '2015-09-01', '02:40:42', NULL, '00:00:01'),
(42, 0, 9, 0, 1, 4, 3, '2015-09-01', '02:44:09', NULL, '00:00:01'),
(43, 0, 14, 0, 1, 7, 3, '2015-09-01', '03:21:37', NULL, '00:00:01'),
(44, 0, 17, 0, 1, 2, 3, '2015-09-01', '03:28:03', NULL, '00:00:01'),
(45, 0, 12, 0, 5, 10, 3, '2015-09-03', '23:52:22', NULL, '00:00:01'),
(46, 0, 12, 0, 5, 10, 1, '2015-09-03', '23:52:31', NULL, '00:00:02'),
(47, 0, 18, 0, 5, 2, 3, '2015-09-04', '00:06:09', NULL, '00:00:01'),
(48, 0, 18, 0, 5, 2, 1, '2015-09-04', '00:06:24', NULL, '00:00:02'),
(49, 0, 12, 0, 1, 4, 3, '2015-09-04', '00:14:46', NULL, '00:00:01'),
(50, 0, 12, 0, 1, 4, 3, '2015-09-04', '00:12:45', NULL, '00:00:01'),
(51, 0, 12, 0, 1, 4, 1, '2015-09-04', '00:13:02', NULL, '00:00:02'),
(52, 0, 12, 0, 1, 4, 3, '2015-09-04', '00:13:14', NULL, '00:00:01'),
(53, 0, 18, 0, 1, 8, 3, '2015-09-04', '00:19:28', NULL, '00:00:01'),
(54, 0, 12, 0, 1, 8, 3, '2015-09-04', '10:46:41', NULL, '00:00:01'),
(55, 0, 12, 0, 1, 2, 3, '2015-09-04', '12:34:05', NULL, '00:00:01'),
(56, 0, 12, 0, 1, 2, 3, '2015-09-04', '12:35:31', NULL, '00:00:01'),
(57, 0, 19, 0, 1, 2, 3, '2015-09-05', '00:39:18', NULL, '00:00:01'),
(58, 0, 1, 0, 1, 4, 3, '2015-09-06', '11:47:07', NULL, '00:00:01'),
(59, 0, 12, 0, 1, 5, 3, '2015-09-06', '19:34:52', NULL, '00:00:01'),
(60, 1, 14, 0, 1, 8, 3, '2015-09-06', '19:45:53', NULL, '00:00:01'),
(61, 1, 9, 1, 1, 6, 3, '2015-09-06', '19:47:33', NULL, '00:00:00'),
(62, 1, 9, 1, 1, 6, 1, '2015-10-24', '19:47:44', NULL, '00:00:00'),
(63, 2, 12, 1, 1, 1, 3, '2015-09-06', '23:48:10', '2015-10-25', '00:20:00'),
(64, 2, 9, 1, 5, 10, 3, '2015-09-00', '00:24:56', '2015-09-00', '00:31:16'),
(65, 2, 9, 1, 5, 10, 3, '2015-09-00', '00:30:13', '0000-00-00', '00:00:00'),
(66, 2, 9, 1, 1, 1, 3, '2015-09-00', '00:34:21', '2015-10-25', '11:26:00'),
(67, 2, 9, 1, 1, 1, 0, '2015-09-00', '00:30:13', '0000-00-00', '00:00:00'),
(68, 2, 14, 4, 11, 5, 3, '2015-09-00', '11:36:02', '0000-00-00', '00:00:00'),
(69, 2, 12, 3, 10, 7, 3, '2015-09-00', '11:41:14', '0000-00-00', '00:00:00'),
(70, 2, 2, 3, 10, 4, 3, '2015-09-00', '11:45:31', '0000-00-00', '00:00:00'),
(71, 2, 20, 3, 10, 6, 3, '2015-09-00', '11:50:20', '0000-00-00', '00:00:00'),
(72, 2, 1, 4, 11, 2, 3, '2015-09-00', '11:56:26', '2015-09-00', '11:56:46'),
(73, 2, 21, 1, 1, 3, 3, '2015-09-00', '16:15:55', '0000-00-00', '00:00:00'),
(74, 2, 1, 1, 1, 8, 3, '2015-09-01', '02:06:05', '0000-00-00', '00:00:00'),
(75, 2, 2, 1, 1, 8, 3, '2015-09-01', '02:11:03', '0000-00-00', '00:00:00'),
(76, 1, 22, 1, 5, 10, 3, '2015-09-01', '02:17:52', '2015-09-01', '02:18:06'),
(77, 2, 14, 1, 1, 3, 3, '2015-10-26', '02:32:36', '0000-00-00', '00:00:00'),
(78, 2, 9, 3, 10, 7, 3, '2015-10-26', '02:35:23', '2015-10-26', '02:36:14'),
(79, 1, 18, 1, 1, 6, 3, '2015-10-26', '03:36:31', '0000-00-00', '00:00:00'),
(80, 1, 14, 1, 1, 6, 3, '2015-10-26', '04:12:26', '0000-00-00', '00:00:00'),
(81, 1, 23, 3, 10, 3, 3, '2015-10-26', '04:15:36', '0000-00-00', '00:00:00'),
(82, 1, 19, 1, 1, 2, 3, '2015-10-26', '05:12:41', '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE IF NOT EXISTS `localidades` (
  `id_localidad` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `alias` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id_localidad`, `nombre`, `alias`) VALUES
(1, 'Torre A', 'Garita A'),
(2, 'Torre B', 'Garita B'),
(3, 'Patio Exterior', 'Garita C'),
(4, 'Subsuleo Exterior', 'Garita D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE IF NOT EXISTS `niveles` (
  `id_nivel` int(11) NOT NULL,
  `id_localidad` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `n_puestos` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id_nivel`, `id_localidad`, `nombre`, `alias`, `n_puestos`) VALUES
(1, 1, 'AS1', 'Subsuelo 1', 8),
(2, 1, 'AS2', 'Subsuelo 2', 8),
(3, 1, 'AP1', 'Primer Piso', 10),
(4, 1, 'AP2', 'Segundo Piso', 10),
(5, 1, 'AP3', 'Tercer Piso', 10),
(6, 2, 'BP1', 'Primer Piso', 10),
(7, 2, 'BP2', 'Segundo Piso', 12),
(8, 2, 'BP3', 'Tercer Piso', 12),
(9, 2, 'BP4', 'Cuarto Piso', 12),
(10, 3, 'CPE', 'Patio Exterior', 8),
(11, 4, 'DSE', 'Subsuelo Exterior', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `mail`, `usuario`, `pass`, `perfil`) VALUES
(1, 'Administrador', 'admin@oromall.com', 'admin', 'admin', 1),
(2, 'Tito Pizarro', 'titomauriciopizarroochoa@gmail.com', 'titopizarro', 'mathew', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id_auto`), ADD UNIQUE KEY `placa` (`placa`);

--
-- Indices de la tabla `espacios`
--
ALTER TABLE `espacios`
  ADD PRIMARY KEY (`id_espacio`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`), ADD KEY `id_usuario` (`id_usuario`), ADD KEY `id_usuario_2` (`id_usuario`), ADD KEY `id_usuario_3` (`id_usuario`), ADD KEY `id_car` (`id_auto`), ADD KEY `id_parqueo` (`id_localidad`), ADD KEY `id_nivel` (`id_nivel`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id_localidad`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id_nivel`), ADD UNIQUE KEY `nombre` (`nombre`), ADD KEY `id_parqueo` (`id_localidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `mail` (`mail`), ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autos`
--
ALTER TABLE `autos`
  MODIFY `id_auto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `espacios`
--
ALTER TABLE `espacios`
  MODIFY `id_espacio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
