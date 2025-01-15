-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 13-01-2025 a les 11:44:28
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `apellesfenosa`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `numero_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `archivos`
--

INSERT INTO `archivos` (`id_archivo`, `enlace`, `numero_registro`) VALUES
(1, 'images/prueb.jpg', 4),
(2, 'images/prueba2.jpg', 5),
(7, 'images/prueba2.jpg', 1),
(25, 'images/prueba2.jpg', 10),
(26, 'images/prueba2.jpg', 14),
(27, 'images/prueb.jpg', 8),
(28, 'images/prueba2.jpg', 17),
(29, 'images/prueba2.jpg', 18),
(30, 'images/prueba2.jpg', 19),
(31, 'images/prueb.jpg', 20),
(32, 'images/prueb.jpg', 21),
(34, 'images/prueb.jpg', 23),
(36, 'images/prueb.jpg', 33),
(37, 'archivos/obra_33/hola.ods', 33),
(38, 'archivos/obra_33/hola.odt', 33),
(39, 'archivos/obra_33/apellesfenosa.sql', 33),
(40, 'archivos/obra_33/prueba2.jpg', 33),
(41, 'images/prueb.jpg', 24),
(42, 'archivos/obra_24/hola.ods', 24),
(43, 'archivos/obra_24/hola.odt', 24),
(44, 'archivos/obra_24/apellesfenosa.sql', 24),
(45, 'archivos/obra_24/prueba2.jpg', 24),
(46, 'archivos/obra_24/fundaci___apel__les_fenosa.sql', 24),
(47, 'images/prueb.jpg', 1212),
(48, 'archivos/obra_1212/a.jpg', 1212);

-- --------------------------------------------------------

--
-- Estructura de la taula `autores`
--

CREATE TABLE `autores` (
  `codigo_autor` int(11) NOT NULL,
  `nombre_autor` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `autores`
--

INSERT INTO `autores` (`codigo_autor`, `nombre_autor`, `activo`) VALUES
(1, 'Michelangelo223 Buonarroti22', 0),
(2, 'Leonardo da Vinci2', 0),
(3, 'Michelangelo2', 0),
(4, 'Michelangelo22', 0),
(6, 'Michelangelo222', 1),
(8, '1', 1),
(9, '12', 1),
(10, 'Michelangelocre', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `clasificaciones_genericas`
--

CREATE TABLE `clasificaciones_genericas` (
  `id_clasificacion` int(11) NOT NULL,
  `texto_clasificacion` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `clasificaciones_genericas`
--

INSERT INTO `clasificaciones_genericas` (`id_clasificacion`, `texto_clasificacion`, `activo`) VALUES
(0, 'Escultura3334', 1),
(1, 'Escultura33', 1),
(2, 'Pintura', 1),
(3, 'Dibujo', 0),
(5, 'Escultura332', 1),
(6, 'creado', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `dataciones`
--

CREATE TABLE `dataciones` (
  `id_datacion` int(11) NOT NULL,
  `nombre_datacion` varchar(255) NOT NULL,
  `ano_inicio` int(11) DEFAULT NULL,
  `ano_final` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `dataciones`
--

INSERT INTO `dataciones` (`id_datacion`, `nombre_datacion`, `ano_inicio`, `ano_final`, `activo`) VALUES
(0, 'Periodo Renacentista22', 111, 11222, 0),
(2, 'Periodo Renacentista2', 1402, 1602, 1),
(4, 'segon quart segle IV ante', -375, -351, 1),
(5, 'segona meitat segle IV ante', -350, -301, 1),
(6, 'tercer quart segle IV ante', -350, -326, 1),
(7, 'últim quart segle IV ante', -325, -301, 1),
(8, 'segle III ante', -300, -201, 1),
(9, 'primera meitat segle III ante', -300, -251, 1),
(10, 'primer quart segle III ante', -300, -276, 1),
(11, 'segon quart segle III ante', -275, -251, 1),
(12, 'segona meitat segle III ante', -250, -201, 1),
(13, 'tercer quart segle III ante', -250, -226, 1),
(14, 'últim quart segle III ante', -225, -201, 1),
(15, 'segle II ante', -200, -101, 1),
(16, 'primera meitat segle II ante', -200, -151, 1),
(17, 'primer quart segle II ante', -200, -176, 1),
(18, 'segon quart segle II ante', -175, -151, 1),
(19, 'segona meitat segle II ante', -150, -101, 1),
(20, 'tercer quart segle II ante', -150, -126, 1),
(21, 'últim quart segle II ante', -125, -101, 1),
(22, 'segle I ante', -100, -1, 1),
(23, 'primera meitat segle I ante', -100, -51, 1),
(24, 'primer quart segle I ante', -100, -76, 1),
(25, 'segon quart segle I ante', -75, -51, 1),
(26, 'segona meitat segle I ante', -50, -1, 1),
(27, 'tercer quart segle I ante', -50, -26, 1),
(28, 'últim quart segle I ante', -25, -1, 1),
(29, 'segle I', 1, 100, 1),
(30, 'primera meitat segle I', 1, 50, 1),
(31, 'primer quart segle I', 1, 25, 1),
(32, 'segon quart segle I', 26, 50, 1),
(33, 'segona meitat segle I', 51, 100, 1),
(34, 'tercer quart segle I', 51, 75, 1),
(35, 'últim quart segle I', 76, 100, 1),
(36, 'segle II', 101, 200, 1),
(37, 'primera meitat segle II', 101, 150, 1),
(38, 'primer quart segle II', 101, 125, 1),
(39, 'segon quart segle II', 126, 150, 1),
(40, 'segona meitat segle II', 151, 200, 1),
(41, 'tercer quart segle II', 151, 175, 1),
(42, 'últim quart segle II', 176, 200, 1),
(43, 'segle III', 201, 300, 1),
(44, 'primera meitat segle III', 201, 250, 1),
(45, 'primer quart segle III', 201, 225, 1),
(46, 'segon quart segle III', 226, 250, 1),
(47, 'segona meitat segle III', 251, 300, 1),
(48, 'tercer quart segle III', 251, 275, 1),
(49, 'últim quart segle III', 276, 300, 1),
(50, 'segle IV', 301, 400, 1),
(51, 'primera meitat segle IV', 301, 350, 1),
(52, 'primer quart segle IV', 301, 325, 1),
(53, 'segon quart segle IV', 326, 350, 1),
(54, 'segona meitat segle IV', 351, 400, 1),
(55, 'tercer quart segle IV', 351, 375, 1),
(56, 'últim quart segle IV', 376, 400, 1),
(57, 'segle V', 401, 500, 1),
(58, 'primera meitat segle V', 401, 450, 1),
(59, 'primer quart segle V', 401, 425, 1),
(60, 'segon quart segle V', 426, 450, 1),
(61, 'segona meitat segle V', 451, 500, 1),
(62, 'tercer quart segle V', 451, 475, 1),
(63, 'últim quart segle V', 476, 500, 1),
(64, 'segle VI', 501, 600, 1),
(65, 'primera meitat segle VI', 501, 550, 1),
(66, 'primer quart segle VI', 501, 525, 1),
(67, 'segon quart segle VI', 526, 550, 1),
(68, 'segona meitat segle VI', 551, 600, 1),
(69, 'tercer quart segle VI', 551, 575, 1),
(70, 'últim quart segle VI', 576, 600, 1),
(71, 'segle VII', 601, 700, 1),
(72, 'primera meitat segle VII', 601, 650, 1),
(73, 'primer quart segle VII', 601, 625, 1),
(74, 'segon quart segle VII', 626, 650, 1),
(75, 'segona meitat segle VII', 651, 700, 1),
(76, 'tercer quart segle VII', 651, 675, 1),
(77, 'últim quart segle VII', 676, 700, 1),
(78, 'segle VIII', 701, 800, 1),
(79, 'primera meitat segle VIII', 701, 750, 1),
(80, 'primer quart segle VIII', 701, 725, 1),
(81, 'segon quart segle VIII', 726, 750, 1),
(82, 'segona meitat segle VIII', 751, 800, 1),
(83, 'tercer quart segle VIII', 751, 775, 1),
(84, 'últim quart segle VIII', 776, 800, 1),
(85, 'segle IX', 801, 900, 1),
(86, 'primera meitat segle IX', 801, 850, 1),
(87, 'primer quart segle IX', 801, 825, 1),
(88, 'segon quart segle IX', 826, 850, 1),
(89, 'segona meitat segle IX', 851, 900, 1),
(90, 'tercer quart segle IX', 851, 875, 1),
(91, 'últim quart segle IX', 876, 900, 1),
(92, 'segle X', 901, 1000, 1),
(93, 'primera meitat segle X', 901, 950, 1),
(94, 'primer quart segle X', 901, 925, 1),
(95, 'segon quart segle X', 926, 950, 1),
(96, 'segona meitat segle X', 951, 1000, 1),
(97, 'tercer quart segle X', 951, 975, 1),
(98, 'últim quart segle X', 976, 1000, 1),
(99, 'segle XI', 1001, 1100, 1),
(100, 'primera meitat segle XI', 1001, 1050, 1),
(101, 'primer quart segle XI', 1001, 1025, 1),
(102, 'segon quart segle XI', 1026, 1050, 1),
(103, 'segona meitat segle XI', 1051, 1100, 1),
(104, 'tercer quart segle XI', 1051, 1075, 1),
(105, 'últim quart segle XI', 1076, 1100, 1),
(106, 'segle XII', 1101, 1200, 1),
(107, 'primera meitat segle XII', 1101, 1150, 1),
(108, 'primer quart segle XII', 1101, 1125, 1),
(109, 'segon quart segle XII', 1126, 1150, 1),
(110, 'segona meitat segle XII', 1151, 1200, 1),
(111, 'tercer quart segle XII', 1151, 1175, 1),
(112, 'últim quart segle XII', 1176, 1200, 1),
(113, 'segle XIII', 1201, 1300, 1),
(114, 'primera meitat segle XIII', 1201, 1250, 1),
(115, 'primer quart segle XIII', 1201, 1225, 1),
(116, 'segon quart segle XIII', 1226, 1250, 1),
(117, 'segona meitat segle XIII', 1251, 1300, 1),
(118, 'tercer quart segle XIII', 1251, 1275, 1),
(119, 'últim quart segle XIII', 1276, 1300, 1),
(120, 'segle XIV', 1301, 1400, 1),
(121, 'primera meitat segle XIV', 1301, 1350, 1),
(122, 'primer quart segle XIV', 1301, 1325, 1),
(123, 'segon quart segle XIV', 1326, 1350, 1),
(124, 'segona meitat segle XIV', 1351, 1400, 1),
(125, 'tercer quart segle XIV', 1351, 1375, 1),
(126, 'últim quart segle XIV', 1376, 1400, 1),
(127, 'segle XV', 1401, 1500, 1),
(128, 'primera meitat segle XV', 1401, 1450, 1),
(129, 'primer quart segle XV', 1401, 1425, 1),
(130, 'segon quart segle XV', 1426, 1450, 1),
(131, 'segona meitat segle XV', 1451, 1500, 1),
(132, 'tercer quart segle XV', 1451, 1475, 1),
(133, 'últim quart segle XV', 1476, 1500, 1),
(134, 'segle XVI', 1501, 1600, 1),
(135, 'primera meitat segle XVI', 1501, 1550, 1),
(136, 'primer quart segle XVI', 1501, 1525, 1),
(137, 'segon quart segle XVI', 1526, 1550, 1),
(138, 'segona meitat segle XVI', 1551, 1600, 1),
(139, 'tercer quart segle XVI', 1551, 1575, 1),
(140, 'últim quart segle XVI', 1576, 1600, 1),
(141, 'segle XVII', 1601, 1700, 1),
(142, 'primera meitat segle XVII', 1601, 1650, 1),
(143, 'primer quart segle XVII', 1601, 1625, 1),
(144, 'segon quart segle XVII', 1626, 1650, 1),
(145, 'segona meitat segle XVII', 1651, 1700, 1),
(146, 'tercer quart segle XVII', 1651, 1675, 1),
(147, 'últim quart segle XVII', 1676, 1700, 1),
(148, 'segle XVIII', 1701, 1800, 1),
(149, 'primera meitat segle XVIII', 1701, 1750, 1),
(150, 'primer quart segle XVIII', 1701, 1725, 1),
(151, 'segon quart segle XVIII', 1726, 1750, 1),
(152, 'segona meitat segle XVIII', 1751, 1800, 1),
(153, 'tercer quart segle XVIII', 1751, 1775, 1),
(154, 'últim quart segle XVIII', 1776, 1800, 1),
(155, 'segle XIX', 1801, 1900, 1),
(156, 'primera meitat segle XIX', 1801, 1850, 1),
(157, 'primer quart segle XIX', 1801, 1825, 1),
(158, 'dècada de 1800', 1801, 1810, 1),
(159, 'dècada de 1810', 1811, 1820, 1),
(160, 'dècada de 1820', 1821, 1830, 1),
(161, 'segon quart segle XIX', 1826, 1850, 1),
(162, 'dècada de 1830', 1831, 1840, 1),
(163, 'dècada de 1840', 1841, 1850, 1),
(164, 'segona meitat segle XIX', 1851, 1900, 1),
(165, 'tercer quart segle XIX', 1851, 1875, 1),
(166, 'dècada de 1850', 1851, 1860, 1),
(167, 'dècada de 1860', 1861, 1870, 1),
(168, 'dècada de 1870', 1871, 1880, 1),
(169, 'últim quart segle XIX', 1876, 1900, 1),
(170, 'dècada de 1880', 1881, 1890, 1),
(171, 'dècada de 1890', 1891, 1900, 1),
(172, 'segle XX', 1901, 2000, 1),
(173, 'primera meitat segle XX', 1901, 1950, 1),
(174, 'primer quart segle XX', 1901, 1925, 1),
(175, 'dècada de 1900', 1901, 1910, 1),
(176, 'dècada de 1910', 1911, 1920, 1),
(177, 'dècada de 1920 i 1930', 1921, 1940, 1),
(178, 'dècada de 1920', 1921, 1930, 1),
(179, 'segon quart segle XX', 1926, 1950, 1),
(180, 'dècada de 1930 i 1940', 1931, 1950, 1),
(181, 'dècada de 1930', 1931, 1940, 1),
(182, 'dècada de 1940', 1941, 1950, 1),
(183, 'segona meitat segle XX', 1951, 2000, 1),
(184, 'tercer quart segle XX', 1951, 1975, 1),
(185, 'dècada de 1950', 1951, 1960, 1),
(186, 'dècada de 1960', 1961, 1970, 1),
(187, 'dècada de 1970', 1971, 1980, 1),
(188, 'últim quart segle XX', 1976, 2000, 1),
(189, 'dècada de 1980', 1981, 1990, 1),
(190, 'dècada de 1990', 1991, 2000, 1),
(191, 'segle XXI', 2001, 2100, 1),
(192, 'primera meitat segle XXI', 2001, 2050, 1),
(193, 'primer quart segle XXI', 2001, 2025, 1),
(194, 'segon quart segle XXI', 2026, 2050, 1),
(195, 'abans', NULL, NULL, 1),
(196, 'circa', NULL, NULL, 1),
(197, 'posterior', NULL, NULL, 1),
(198, 'precís', NULL, NULL, 1),
(199, 'paleolític', -3000000, -9000, 1),
(200, 'paleolític inferior', -3000000, -120000, 1),
(201, 'paleolític inferior arcaic', -3000000, -600000, 1),
(202, 'paleolític inferior peces evolucionades', -599999, -120000, 1),
(203, 'paleolític inferior-mig indiferenciat', -119999, -50000, 1),
(204, 'paleolític mig', -89999, -33000, 1),
(205, 'paleolític superior', -22999, -9000, 1),
(206, 'paleolític-epipaleolític', -10999, -7000, 1),
(207, 'epipaleolític', -8999, -5000, 1),
(208, 'neolític', -5499, -2200, 1),
(209, 'neolític antic', -5499, -3500, 1),
(210, 'neolític antic cardial', -5499, -4000, 1),
(211, 'neolític antic postcardial', -3999, -3500, 1),
(212, 'neolític mig-recent', -3499, -2500, 1),
(213, 'neolític final', -2499, -2000, 1),
(214, 'calcolític', -2199, -1800, 1),
(215, 'bronze', -1799, -650, 1),
(216, 'bronze antic', -1799, -1500, 1),
(217, 'bronze mig', -1499, -1200, 1),
(218, 'bronze final', -1199, -650, 1),
(219, 'ferro-ibèric-colonitzacions', -649, 50, 1),
(220, 'ferro-ibèric antic', -649, -450, 1),
(221, 'ferro-ibèric ple', -449, -200, 1),
(222, 'romà', -218, 476, 1),
(223, 'romà república', -218, -50, 1),
(224, 'ferro-ibèric final', -199, -50, 1),
(225, 'romà August', -27, 14, 1),
(226, 'romà alt imperi', 14, 192, 1),
(227, 'romà segle III', 192, 284, 1),
(228, 'romà baix imperi', 284, 476, 1),
(229, 'medieval', 400, 1492, 1),
(230, 'medieval domini visigòtic', 401, 715, 1),
(231, 'medieval ocupació i domini musulmà', 715, 799, 1),
(232, 'medieval món islàmic', 800, 1150, 1),
(233, 'medieval Catalunya vella sota Carolingis', 800, 988, 1),
(234, 'medieval món islàmic Emirat', 800, 899, 1),
(235, 'medieval món islàmic Califat', 900, 1015, 1),
(236, 'medieval comptes de Barcelona', 988, 1150, 1),
(237, 'medieval món islàmic Taifes', 1016, 1150, 1),
(238, 'medieval consolidació Corona d\'Aragó', 1150, 1230, 1),
(239, 'medieval baixa edat mitjana', 1230, 1492, 1),
(240, 'modern', 1492, 1789, 1),
(241, 'contemporani', 1798, NULL, 1),
(242, 'asdsadas', 111, 112, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `estado_conservacion`
--

CREATE TABLE `estado_conservacion` (
  `id_estado` int(4) NOT NULL,
  `nombre_estado` varchar(200) NOT NULL,
  `activo` binary(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `estado_conservacion`
--

INSERT INTO `estado_conservacion` (`id_estado`, `nombre_estado`, `activo`) VALUES
(1, 'Bo', 0x31),
(2, 'Dolent', 0x31),
(3, 'Excel·lent', 0x31),
(4, 'Indeterminat', 0x31),
(5, 'Desconeguda', 0x31),
(6, 'Regular', 0x31);

-- --------------------------------------------------------

--
-- Estructura de la taula `exposiciones`
--

CREATE TABLE `exposiciones` (
  `id_exposicion` int(11) NOT NULL,
  `fecha_inicio_expo` date DEFAULT NULL,
  `fecha_fin_expo` date DEFAULT NULL,
  `tipo_exposicion` varchar(255) DEFAULT NULL,
  `sitio_exposicion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `exposicion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `exposiciones`
--

INSERT INTO `exposiciones` (`id_exposicion`, `fecha_inicio_expo`, `fecha_fin_expo`, `tipo_exposicion`, `sitio_exposicion`, `activo`, `exposicion`) VALUES
(1, '2023-07-01', '2023-09-01', 'Temporal232ed2', 'Museo Nacional de Florencia', 0, 'A'),
(2, '2023-07-02', '2023-09-02', 'Temporal_creada', 'Museo Nacional de Florencia2', 1, 'PRUEBA'),
(3, '2023-07-22', '2023-09-23', 'Temporal_creada2', 'Museo Nacional de Florencia23', 1, NULL),
(14, '2023-07-02', '2023-07-14', 'prestamos33', 'Museo Nacional de Florencia5', 1, NULL),
(15, '2023-07-22', '2023-09-23', 'Temporal_creada', 'Museo Nacional de Florencia23', 1, NULL),
(16, '2024-10-11', '2024-10-18', 'A', 'prueba', 1, 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de la taula `formas_ingreso`
--

CREATE TABLE `formas_ingreso` (
  `id_forma_ingreso` int(11) NOT NULL,
  `texto_forma_ingreso` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `formas_ingreso`
--

INSERT INTO `formas_ingreso` (`id_forma_ingreso`, `texto_forma_ingreso`, `activo`) VALUES
(1, 'Donación', 0),
(2, 'Compra', 1),
(3, 'Préstamo', 0),
(4, 'Cessió', 1),
(5, 'Comodat', 1),
(6, 'Dació', 1),
(7, 'Desconeguda2', 1),
(8, 'Dipòsit', 1),
(9, 'Entrega obligatòria', 1),
(10, 'Excavació', 1),
(11, 'Expropiació', 1),
(12, 'Herència', 1),
(13, 'Intercanvi', 1),
(14, 'Llegat', 1),
(15, 'Ocupació', 1),
(16, 'Ofrena', 1),
(17, 'Permuta', 1),
(18, 'Premi', 1),
(19, 'Propietat directa', 1),
(20, 'Recol.lecció', 1),
(21, 'Recuperació', 1),
(22, 'Successió interadministrativa', 1),
(23, 'ingresoNuevo', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `materiales`
--

CREATE TABLE `materiales` (
  `codigo_getty_material` int(11) NOT NULL,
  `texto_material` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `materiales`
--

INSERT INTO `materiales` (`codigo_getty_material`, `texto_material`, `activo`) VALUES
(1, 'Mármol2233', 0),
(2, 'Bronce32', 1),
(3, 'Madera_editado3', 0),
(4, 'Oro', 0),
(6, 'Mármol_creado', 0),
(7, 'Mármol_creado2', 1),
(8, 'Mármol_creado1', 1),
(9, 'Mármol_creado4', 1),
(10, 'Mármol_creado3', 1),
(11, 'Mármol22', 1),
(12, 'Mármol22', 1),
(13, 'Mármol24', 1),
(14, 'material14', 1),
(122555, 'Material Prueba', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `obras`
--

CREATE TABLE `obras` (
  `numero_registro` varchar(10) NOT NULL,
  `classificacion_generica` int(11) DEFAULT NULL,
  `nombre_objeto` varchar(255) NOT NULL,
  `coleccion_procedencia` varchar(255) DEFAULT NULL,
  `maxima_altura` decimal(10,2) DEFAULT NULL,
  `maxima_anchura` decimal(10,2) DEFAULT NULL,
  `maxima_profundidad` decimal(10,2) DEFAULT NULL,
  `material` int(11) DEFAULT NULL,
  `tecnica` int(11) DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `ano_inicio` int(11) DEFAULT NULL,
  `ano_final` int(11) DEFAULT NULL,
  `datacion` int(11) DEFAULT NULL,
  `ubicacion` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `numero_ejemplares` int(11) DEFAULT NULL,
  `forma_ingreso` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fuente_ingreso` varchar(255) DEFAULT NULL,
  `baja` tinyint(1) DEFAULT NULL,
  `causa_baja` varchar(255) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `persona_aut_baja` varchar(255) DEFAULT NULL,
  `estado_conservacion` varchar(255) DEFAULT NULL,
  `lugar_ejecucion` varchar(255) DEFAULT NULL,
  `lugar_procedencia` varchar(255) DEFAULT NULL,
  `num_tirada` int(11) DEFAULT NULL,
  `otros_num_id` varchar(255) DEFAULT NULL,
  `valoracion_econ` decimal(10,2) DEFAULT NULL,
  `id_exposicion` int(11) DEFAULT NULL,
  `bibliografia` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `historia_obra` text DEFAULT NULL,
  `usuari_creador` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `obras`
--

INSERT INTO `obras` (`numero_registro`, `classificacion_generica`, `nombre_objeto`, `coleccion_procedencia`, `maxima_altura`, `maxima_anchura`, `maxima_profundidad`, `material`, `tecnica`, `autor`, `titulo`, `ano_inicio`, `ano_final`, `datacion`, `ubicacion`, `fecha_registro`, `numero_ejemplares`, `forma_ingreso`, `fecha_ingreso`, `fuente_ingreso`, `baja`, `causa_baja`, `fecha_baja`, `persona_aut_baja`, `estado_conservacion`, `lugar_ejecucion`, `lugar_procedencia`, `num_tirada`, `otros_num_id`, `valoracion_econ`, `id_exposicion`, `bibliografia`, `descripcion`, `historia_obra`, `usuari_creador`) VALUES
('', 0, 'Dsffdsfsdf', '', 0.00, 0.00, 0.00, 8, 4, 8, 'Dgfdgfg', 0, 0, 0, NULL, '0000-00-00', 0, 7, '0000-00-00', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 0.00, NULL, '', '', '', ''),
('1', 5, '', 'prueba', 5.17, 2.15, 1.50, 8, 3, 1, 'prueba', -225, -251, 2, NULL, '2024-11-14', 1, 5, '0000-00-00', '2024-11-14', NULL, NULL, NULL, NULL, 'prueba', 'prueba', 'asddas', NULL, NULL, 0.00, 3, '1002000.00', 'prueba', 'prueba', ''),
('1212', 0, 'Nuevi', '', 0.00, 0.00, 0.00, 0, 0, 0, 'Nuevi', 0, 0, 0, NULL, '0000-00-00', 0, 0, '0000-00-00', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 0.00, NULL, '', '', '', 'admin'),
('2', 0, '', 'aaaa', NULL, NULL, NULL, NULL, NULL, 1, 'aa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('3', 3, 'Sdfsdf', '', 0.00, 0.00, 0.00, 10, 4, 3, 'Sdfsdf', -325, -76, 16, NULL, '0000-00-00', 0, 6, '0000-00-00', '', NULL, NULL, NULL, NULL, '2', '', '', NULL, NULL, 0.00, NULL, '', '', '', '<br />\r\n<b>Warning</b>:  Undefined variable $usuari_creador in <b>C:\\xampp\\htdocs\\Crea una carpeta\\apellesfenosa\\views\\crear_obra\\crear.php</b> on line <b>258</b><br />'),
('333333', 0, 'Holahola', '', 0.00, 0.00, 0.00, 0, 0, 0, 'Holahola', 0, 0, 0, NULL, '0000-00-00', 0, 0, '0000-00-00', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 0.00, NULL, '', '', '', 'admin ?>'),
('34234', 0, 'Dasdas', '', 0.00, 0.00, 0.00, 0, 0, 2, 'Asds', 0, 0, 0, NULL, '0000-00-00', 0, 0, '0000-00-00', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 0.00, NULL, '', '', '', 'admin ?>'),
('4', 1, '', 'prueba1', 5.17, 2.12, 1.50, 10, 2, 3, 'prueba1', 1402, 1602, 4, NULL, '2024-11-14', 1, 6, '2024-11-15', 'prueba1', NULL, NULL, NULL, NULL, 'eeee', 'prueba1', 'prueba1', NULL, NULL, 1002000.00, 2, 'prueba1', 'prueba1', 'prueba1', ''),
('44444', 0, 'Hola2', '', 0.00, 0.00, 0.00, 0, 0, 0, 'Hola2', 0, 0, 0, NULL, '0000-00-00', 0, 0, '0000-00-00', '', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 0.00, NULL, '', '', '', 'admin'),
('45345', 5, 'Dasdas', '', 0.00, 0.00, 0.00, 12, 3, 2, 'Asdas', -250, -201, 12, NULL, '0000-00-00', 0, 4, '0000-00-00', '', NULL, NULL, NULL, NULL, '3', '', '', NULL, NULL, 0.00, NULL, '', '', '', ''),
('534654654', 2, 'Ewrwerewr', '', 0.00, 0.00, 0.00, 13, 2, 3, 'Werewr', -225, -201, 14, NULL, '0000-00-00', 0, 7, '0000-00-00', '', NULL, NULL, NULL, NULL, '2', '', '', NULL, NULL, 0.00, NULL, '', '', '', ''),
('546456', 5, 'Dasd', '', 0.00, 0.00, 0.00, 12, 2, 4, 'Asdas', -200, -101, 15, NULL, '0000-00-00', 0, 5, '0000-00-00', '', NULL, NULL, NULL, NULL, '2', '', '', NULL, NULL, 0.00, NULL, '', '', '', '<br />\n<b>Warning</b>:  Undefined variable $user_name in <b>C:\\xampp\\htdocs\\Crea una carpeta\\apellesfenosa\\views\\crear_obra\\crear.php</b> on line <b>258</b><br />'),
('F00001.00', 1, '', 'prueba1', 5.17, 2.12, 1.50, 10, 2, 3, 'prueba1', 1402, 1602, 4, NULL, '2024-11-14', 1, 6, '2024-11-15', 'prueba1', NULL, NULL, NULL, NULL, '1', 'prueba1', 'prueba1', NULL, NULL, 1002000.00, 2, 'prueba1', 'prueba1', 'prueba1', ''),
('F00002.00', 2, 'nombre', 'coleccion procedencia', 5.18, 2.15, 1.50, 10, 2, 4, 'titulo', -100, 100, 14, NULL, '2024-11-14', 1, 18, '2024-11-14', 'fuente ingreso', NULL, NULL, NULL, NULL, NULL, 'ejecucion', 'procedencia', NULL, NULL, 1002200.00, 1, 'biblibografia', 'descripcion', 'historia', ''),
('F00003.00', 0, 'nombre', 'coleccion procedencia', 5.18, 2.15, 1.50, 9, 3, 3, 'titulo', 1, -1, 18, NULL, '2024-11-14', 1, 18, '2024-11-14', 'fuente ingreso', NULL, NULL, NULL, NULL, NULL, 'prueba', 'Florencia', NULL, NULL, 1002200.00, NULL, 'Bibliografía', 'Descripción', 'Historia de la Obra:', ''),
('F00004.00', 1, 'Nombre', 'Colección Procedencia', 5.18, 2.15, 1.50, 1, 1, 3, 'Título', -50, -26, 18, NULL, '2024-11-19', 1, 2, '2024-11-14', 'Fuente de Ingreso', NULL, NULL, NULL, NULL, '2', 'Lugar de Ejecución', 'Lugar de Procedencia', NULL, NULL, 1002200.00, NULL, 'Bibliografía', 'Descripción', 'Historia', ''),
('F00005.00', 1, 'aaaaaaa', 'aaaaaaa', 5.18, 2.12, 1.50, 122555, 3, 3, 'aaaaaaa', -75, -76, 18, NULL, '2024-11-20', 1, 4, '2024-11-11', 'aaaaaaa', NULL, NULL, NULL, NULL, NULL, 'aaaaaaa', 'aaaaaaa', NULL, NULL, 1002000.00, NULL, 'aaaaaaa', 'aaaaaaa', 'aaaaaaa', ''),
('F00006.00', 1, '', 'pppp', 2.12, 2.12, 1.50, 4, 2, 2, 'pppp', -100, -176, NULL, NULL, '0000-00-00', 0, 16, '0000-00-00', '2024-11-06', NULL, NULL, NULL, NULL, 'pppp', NULL, 'pppp', NULL, NULL, 0.00, 1, '1002200.00', '2024-11-15', 'pppp', ''),
('F00007.00', 1, '', 'prueba2', 5.17, 2.15, 1.50, 3, 2, 2, 'prueba2', 1402, 1602, 4, NULL, '2024-11-08', 1, 4, '0000-00-00', '2024-11-14', NULL, NULL, NULL, NULL, 'prueba2', 'prueba2', NULL, NULL, NULL, 0.00, 1, '1111111.00', 'prueba2', 'prueba2', ''),
('F00008.00', 2, '', 'prueba4', 5.17, 2.15, 1.50, 8, 3, 1, 'prueba4', -225, -251, 2, NULL, '2024-11-14', 1, 5, '0000-00-00', '2024-11-14', NULL, NULL, NULL, NULL, 'prueba4', 'prueba4', 'prueba4', NULL, NULL, 0.00, 1, 'prueba4asdddpdprueba4asddddddddprueba4asddddddddprueba4asddddddd\ndprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddd\ndddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4a\nsddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprue\nba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asdddddddd\nprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asdddd\nddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4as\nddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueb\na4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddp\nrueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddd\ndddprueba4asddddddddprueba4asddddddddprueba4asdddddddddddprueba4\nasdprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asd\ndddddddddprueba4asddddddddprueba4asddddddd', 'prueba4asdddpdprueba4asddddddddprueba4asddddddddprueba4asddddddd\ndprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddd\ndddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4a\nsddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprue\nba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asdddddddd\nprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asdddd\nddddprueba4asddddddddprueba4asdddd', 'prueba4asdddpdprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asdddddddddddprueba4asdprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asddddddddprueba4asdddddddd', ''),
('F00009.00', 1, 'asdasd', 'awd', 5.18, 2.16, 1.50, 3, 3, 3, 'asdasd', -150, -101, 19, NULL, '2024-11-19', 1, 5, '2024-11-20', 'asdasd', NULL, NULL, NULL, NULL, '1', 'asdasd', 'asdasda', NULL, NULL, 1111111.00, NULL, 'asda', 'sdasdad', 'ssd', ''),
('F00011.00', 2, 'erwerwe', 'qweqwe', 5.18, 2.15, 1.50, 14, 2, 4, 'werw', -200, -176, 17, NULL, '2024-11-27', 1, 5, '2024-11-13', 'awe', NULL, NULL, NULL, NULL, '2', 'awea', 'wewe', NULL, NULL, 1002000.00, NULL, 'awe', 'wewee', 'weaeaw', ''),
('F00012.00', 3, 'asdaasd', 'edqwe', 5.18, 2.15, 1.50, 4, 2, 2, 'dssd', -175, -151, 18, NULL, '2024-11-20', 1, 14, '2024-11-21', 'dffd', NULL, NULL, NULL, NULL, '1', 'asda', 'sdasd', NULL, NULL, 1002000.00, NULL, 'asdasd', 'asda', 'sdasd', ''),
('F00013.00', 2, 'asd', '123sd', 5.18, 2.12, 1.52, 4, 3, 2, 'asdsad', -175, -151, 18, NULL, '2024-11-28', 1, 5, '2024-11-14', 'sdad', NULL, NULL, NULL, NULL, '2', 'asd', 'asdasd', NULL, NULL, 1111111.00, NULL, 'asd', 'asdd', 'asd', ''),
('F00014.00', 3, 'sdf', 'dsf', 5.18, 2.12, 1.50, 122555, 3, 2, 'df', -150, -101, 19, NULL, '2024-11-29', 1, 6, '2024-11-20', 'sdasda', NULL, NULL, NULL, NULL, '3', 'asdasd', 'asdad', NULL, NULL, 1002200.00, NULL, 'sdfsdf', 'sdfdsf', 'sdfsdf', ''),
('F00015.00', 3, 'sdf', 'dsf', 5.18, 2.12, 1.50, 122555, 3, 2, 'df', -150, -101, 19, NULL, '2024-11-29', 1, 6, '2024-11-20', 'sdasda', NULL, NULL, NULL, NULL, '3', 'asdasd', 'asdad', NULL, NULL, 1002200.00, NULL, 'sdfsdf', 'sdfdsf', 'sdfsdf', ''),
('F00016.00', 1, '', 'Nuevo', 2.12, 2.12, 1.52, 3, 3, 1, 'Nuevo', 1400, 1600, 2, NULL, '2024-10-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Excelente', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'Nuevo', NULL, ''),
('F00017.00', 3, 'Nombre', 'Colección Procedencia:', 5.18, 2.15, 1.50, 4, 2, 2, 'Título', -150, -101, 19, NULL, '2024-11-21', 1, 5, '2024-11-14', 'Fuente de Ingreso:', NULL, NULL, NULL, NULL, '3', 'Lugar de Ejecución:', 'Lugar de Procedencia:', NULL, NULL, 1002000.00, NULL, 'Bibliografía', 'Descripción', 'Historia de la Obra:', ''),
('F00018.00', 3, 'Nombre', 'Colección Procedencia:', 5.18, 2.15, 1.50, 4, 2, 2, 'Título', -150, -101, 19, NULL, '2024-11-21', 1, 5, '2024-11-14', 'Fuente de Ingreso:', NULL, NULL, NULL, NULL, '3', 'Lugar de Ejecución:', 'Lugar de Procedencia:', NULL, NULL, 1002000.00, NULL, 'Bibliografía', 'Descripción', 'Historia de la Obra:', ''),
('F00019.00', 3, 'Nombre', 'Colección Procedencia', 5.18, 2.15, 1.50, 4, 2, 2, 'Título', -150, -101, 19, NULL, '2024-11-20', 1, 5, '2024-11-21', 'Fuente de Ingreso', NULL, NULL, NULL, NULL, '4', 'Lugar de Ejecución', 'Lugar de Procedencia', NULL, NULL, 1002200.00, NULL, 'Bibliografía', 'Descripción', 'Historia de la Obra:', ''),
('F00020.00', 1, '', 'prueba1', 5.17, 2.12, 1.50, 10, 2, 3, 'prueba1', 1402, 1602, 4, NULL, '2024-11-14', 1, 6, '2024-11-15', 'prueba1', NULL, NULL, NULL, NULL, 'eeee', 'prueba1', 'prueba1', NULL, NULL, 1002000.00, 2, 'prueba1', 'prueba1', 'prueba1', ''),
('F00021.00', 0, 'nombre', 'coleccion procedencia', 5.18, 2.15, 1.50, 1, 1, 2, 'titulo', -375, -26, 17, NULL, '2024-11-14', 1, 15, '2024-11-29', 'fuente ingreso', NULL, NULL, NULL, NULL, '5', 'ejecucion', 'procedencia', NULL, NULL, 1002200.00, NULL, 'Bibliografía', 'Descripción', 'Historia', ''),
('F00022.00', 2, '', '1', 5.18, 1.00, 1.00, 3, 1, 2, 'Creada2', 1501, 0, 2, NULL, '2024-10-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aa', NULL, ''),
('F00023.00', 2, 'Creada', 'cambio', 5.18, 1.00, 1.00, 3, 1, 2, 'David2', 1501, 0, 2, NULL, '0000-00-00', 1, 1, '2023-09-15', 'Donación privada\n', 0, NULL, NULL, NULL, 'Excelente', 'Florencia', 'Florencia', 1, '1234ABC', 1000000.00, 2, 'Bibliografía de David\n', 'a', 'Bibliografía de David\n', '');

-- --------------------------------------------------------

--
-- Estructura de la taula `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `numero_registro` int(11) DEFAULT NULL,
  `fecha_prestacion` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `institucion_solicitante` varchar(255) NOT NULL,
  `responsable_prestamo` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `exposicion` varchar(255) NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `nombre_objeto` varchar(255) NOT NULL,
  `dimensiones` varchar(255) NOT NULL,
  `materiales` varchar(255) NOT NULL,
  `datacion` varchar(255) NOT NULL,
  `direccion_recogida` varchar(255) NOT NULL,
  `direccion_devolucion` varchar(255) NOT NULL,
  `telefono_recogida` varchar(20) NOT NULL,
  `telefono_devolucion` varchar(20) NOT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `numero_registro`, `fecha_prestacion`, `fecha_devolucion`, `activo`, `institucion_solicitante`, `responsable_prestamo`, `cargo`, `exposicion`, `lugar`, `nombre_objeto`, `dimensiones`, `materiales`, `datacion`, `direccion_recogida`, `direccion_devolucion`, `telefono_recogida`, `telefono_devolucion`, `observaciones`) VALUES
(0, 33, '2024-12-06', '2024-11-23', 1, 'd', 'sfsdf', 'f', 'sdf', 'sd', 'd', 'fd', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf'),
(1, 12, '2012-03-15', '2012-03-16', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL),
(2, 2, '0000-00-00', '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL),
(12, 13, '2012-03-04', '2012-04-04', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `restauraciones`
--

CREATE TABLE `restauraciones` (
  `codigo_restauracion` int(11) NOT NULL,
  `fecha_inicio_restauracion` date DEFAULT NULL,
  `fecha_fin_restauracion` date DEFAULT NULL,
  `comentario_restauracion` text DEFAULT NULL,
  `nombre_restaurador` varchar(255) DEFAULT NULL,
  `numero_registro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `tecnicas`
--

CREATE TABLE `tecnicas` (
  `codigo_getty_tecnica` int(11) NOT NULL,
  `texto_tecnica` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `tecnicas`
--

INSERT INTO `tecnicas` (`codigo_getty_tecnica`, `texto_tecnica`, `activo`) VALUES
(1, 'Cincelado3', 1),
(2, 'Modelado', 0),
(3, 'Talla', 0),
(4, 'Cincelado32', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id_ubicacion` int(11) NOT NULL,
  `fecha_inicio_ubi` date DEFAULT NULL,
  `fecha_fin_ubi` date DEFAULT NULL,
  `ubicacion_padre` int(11) DEFAULT NULL,
  `comentario_ubicacion` text DEFAULT NULL,
  `nombre_ubicacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre_usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_usuario` varchar(50) DEFAULT NULL,
  `estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `usuarios`
--

INSERT INTO `usuarios` (`nombre_usuario`, `password`, `rol_usuario`, `estado`) VALUES
('a', '$2y$10$hnbSHtpAAQtvdFE8pMkZp.IWyTQpfOaJ564Xw2SYUYMztdlCjdx3u', 'convidat', 'activo'),
('admin', '$2y$10$tenYeP.sKqOT7nrzCtNBd.YRJ3KUqHdOqyVFmoezns.pC4bfJTW6G', 'admin', 'activo'),
('hola', '$2y$10$qAkelnBxicHjDEP455/T9e34p0LJ67e/QaQC4TsGUcVNEx8f4ujE2', 'admin', NULL),
('ola', '$2y$10$jxaJy7QXLaczUc4cv3GEU.Hjz65QKAq35OWUEc2SNih86IlXjj072', 'admin', NULL),
('olga', '$2y$10$bKAZcpz07CbKFC.lOPbZXuLcwoIdnA1wFTYCsw/kfUq.Wf/KD0PQy', 'admin', NULL),
('sdf', '$2y$10$oyyvR.JfqZP/jcxj73x.e.FZIiRKpMTjmx8d/gNFx9dp530CbiAni', 'tecnic', NULL),
('user1', 'password456', 'convidat', 'activo');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_numero_registro` (`numero_registro`);

--
-- Índexs per a la taula `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`codigo_autor`);

--
-- Índexs per a la taula `clasificaciones_genericas`
--
ALTER TABLE `clasificaciones_genericas`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Índexs per a la taula `dataciones`
--
ALTER TABLE `dataciones`
  ADD PRIMARY KEY (`id_datacion`);

--
-- Índexs per a la taula `exposiciones`
--
ALTER TABLE `exposiciones`
  ADD PRIMARY KEY (`id_exposicion`);

--
-- Índexs per a la taula `formas_ingreso`
--
ALTER TABLE `formas_ingreso`
  ADD PRIMARY KEY (`id_forma_ingreso`);

--
-- Índexs per a la taula `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`codigo_getty_material`);

--
-- Índexs per a la taula `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`numero_registro`),
  ADD KEY `classificacion_generica` (`classificacion_generica`),
  ADD KEY `material` (`material`),
  ADD KEY `tecnica` (`tecnica`),
  ADD KEY `autor` (`autor`),
  ADD KEY `datacion` (`datacion`),
  ADD KEY `ubicacion` (`ubicacion`),
  ADD KEY `forma_ingreso` (`forma_ingreso`),
  ADD KEY `id_exposicion` (`id_exposicion`);

--
-- Índexs per a la taula `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `numero_registro` (`numero_registro`);

--
-- Índexs per a la taula `restauraciones`
--
ALTER TABLE `restauraciones`
  ADD PRIMARY KEY (`codigo_restauracion`),
  ADD KEY `numero_registro` (`numero_registro`);

--
-- Índexs per a la taula `tecnicas`
--
ALTER TABLE `tecnicas`
  ADD PRIMARY KEY (`codigo_getty_tecnica`);

--
-- Índexs per a la taula `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`),
  ADD KEY `ubicacion_padre` (`ubicacion_padre`);

--
-- Índexs per a la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`ubicacion_padre`) REFERENCES `ubicaciones` (`id_ubicacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
