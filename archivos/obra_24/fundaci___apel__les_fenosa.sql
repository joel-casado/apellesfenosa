-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2024 a las 08:19:23
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
-- Base de datos: `fundació apel·les fenosa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `numero_registro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `codigo_autor` int(11) NOT NULL,
  `nombre_autor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificaciones_genericas`
--

CREATE TABLE `clasificaciones_genericas` (
  `id_clasificacion` int(11) NOT NULL,
  `texto_clasificacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dataciones`
--

CREATE TABLE `dataciones` (
  `id_datacion` int(11) NOT NULL,
  `nombre_datacion` varchar(255) NOT NULL,
  `ano_inicio` int(11) DEFAULT NULL,
  `ano_final` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exposiciones`
--

CREATE TABLE `exposiciones` (
  `id_exposicion` int(11) NOT NULL,
  `fecha_inicio_expo` date DEFAULT NULL,
  `fecha_fin_expo` date DEFAULT NULL,
  `tipo_exposicion` varchar(255) DEFAULT NULL,
  `sitio_exposicion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_ingreso`
--

CREATE TABLE `formas_ingreso` (
  `id_forma_ingreso` int(11) NOT NULL,
  `texto_forma_ingreso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `codigo_getty_material` int(11) NOT NULL,
  `texto_material` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `numero_registro` int(11) NOT NULL,
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
  `historia_obra` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `numero_registro` int(11) DEFAULT NULL,
  `fecha_prestacion` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restauraciones`
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
-- Estructura de tabla para la tabla `tecnicas`
--

CREATE TABLE `tecnicas` (
  `codigo_getty_tecnica` int(11) NOT NULL,
  `texto_tecnica` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id_ubicacion` int(11) NOT NULL,
  `fecha_inicio_ubi` date DEFAULT NULL,
  `fecha_fin_ubi` date DEFAULT NULL,
  `ubicacion_padre` int(11) DEFAULT NULL,
  `comentario_ubicacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre_usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `numero_registro` (`numero_registro`);

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`codigo_autor`);

--
-- Indices de la tabla `clasificaciones_genericas`
--
ALTER TABLE `clasificaciones_genericas`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Indices de la tabla `dataciones`
--
ALTER TABLE `dataciones`
  ADD PRIMARY KEY (`id_datacion`);

--
-- Indices de la tabla `exposiciones`
--
ALTER TABLE `exposiciones`
  ADD PRIMARY KEY (`id_exposicion`);

--
-- Indices de la tabla `formas_ingreso`
--
ALTER TABLE `formas_ingreso`
  ADD PRIMARY KEY (`id_forma_ingreso`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`codigo_getty_material`);

--
-- Indices de la tabla `obras`
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
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `numero_registro` (`numero_registro`);

--
-- Indices de la tabla `restauraciones`
--
ALTER TABLE `restauraciones`
  ADD PRIMARY KEY (`codigo_restauracion`),
  ADD KEY `numero_registro` (`numero_registro`);

--
-- Indices de la tabla `tecnicas`
--
ALTER TABLE `tecnicas`
  ADD PRIMARY KEY (`codigo_getty_tecnica`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`),
  ADD KEY `ubicacion_padre` (`ubicacion_padre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`numero_registro`) REFERENCES `obras` (`numero_registro`);

--
-- Filtros para la tabla `obras`
--
ALTER TABLE `obras`
  ADD CONSTRAINT `obras_ibfk_1` FOREIGN KEY (`classificacion_generica`) REFERENCES `clasificaciones_genericas` (`id_clasificacion`),
  ADD CONSTRAINT `obras_ibfk_2` FOREIGN KEY (`material`) REFERENCES `materiales` (`codigo_getty_material`),
  ADD CONSTRAINT `obras_ibfk_3` FOREIGN KEY (`tecnica`) REFERENCES `tecnicas` (`codigo_getty_tecnica`),
  ADD CONSTRAINT `obras_ibfk_4` FOREIGN KEY (`autor`) REFERENCES `autores` (`codigo_autor`),
  ADD CONSTRAINT `obras_ibfk_5` FOREIGN KEY (`datacion`) REFERENCES `dataciones` (`id_datacion`),
  ADD CONSTRAINT `obras_ibfk_6` FOREIGN KEY (`ubicacion`) REFERENCES `ubicaciones` (`id_ubicacion`),
  ADD CONSTRAINT `obras_ibfk_7` FOREIGN KEY (`forma_ingreso`) REFERENCES `formas_ingreso` (`id_forma_ingreso`),
  ADD CONSTRAINT `obras_ibfk_8` FOREIGN KEY (`id_exposicion`) REFERENCES `exposiciones` (`id_exposicion`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`numero_registro`) REFERENCES `obras` (`numero_registro`);

--
-- Filtros para la tabla `restauraciones`
--
ALTER TABLE `restauraciones`
  ADD CONSTRAINT `restauraciones_ibfk_1` FOREIGN KEY (`numero_registro`) REFERENCES `obras` (`numero_registro`);

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`ubicacion_padre`) REFERENCES `ubicaciones` (`id_ubicacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
