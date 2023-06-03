-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 03-06-2023 a las 18:55:59
-- Versión del servidor: 8.0.33
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fruteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaran`
--

CREATE TABLE `albaran` (
  `num_albaran` int NOT NULL,
  `fecha_entrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proveedor` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `albaran`
--

INSERT INTO `albaran` (`num_albaran`, `fecha_entrada`, `proveedor`) VALUES
(1, '2023-06-02 02:26:36', 'B67228429'),
(2, '2023-06-03 15:48:21', 'B67228429'),
(3, '2023-06-03 18:36:44', 'B67228429'),
(4, '2023-06-03 18:41:56', 'B67228429'),
(5, '2023-06-03 18:54:56', 'B67228429');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ID` int NOT NULL,
  `Usuario` varchar(70) NOT NULL,
  `Password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID`, `Usuario`, `Password`) VALUES
(1, 'vicent', '0d74bd6855bf1c9639376769437f797b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `num_factura` int NOT NULL,
  `fecha_salida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`num_factura`, `fecha_salida`, `cliente`) VALUES
(1, '2023-06-02 02:28:57', 1),
(2, '2023-06-02 03:04:04', 2),
(3, '2023-06-03 15:47:30', 3),
(4, '2023-06-03 18:53:53', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fruta`
--

CREATE TABLE `fruta` (
  `codigo_fruta` int NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `origen` varchar(30) NOT NULL,
  `stock` decimal(10,2) DEFAULT NULL,
  `temporada` enum('Invierno','Primavera','Verano','Otoño','Perenne') NOT NULL,
  `clase` enum('Bayas','Cítricos','Cucurbitáceos','Exóticos','Fruta dulce','Frutos secos') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` enum('ALTA','BAJA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fruta`
--

INSERT INTO `fruta` (`codigo_fruta`, `nombre`, `precio`, `origen`, `stock`, `temporada`, `clase`, `estado`) VALUES
(1, 'Manzana', 1.89, 'España', 37.47, 'Perenne', 'Fruta dulce', 'BAJA'),
(3, 'Limón', 1.79, 'Perú', 40.92, 'Perenne', 'Cítricos', 'ALTA'),
(5, 'Mandarina', 2.59, 'Argentina', 39.18, 'Invierno', 'Cítricos', 'ALTA'),
(6, 'Pera', 2.24, 'España', 40.00, 'Perenne', 'Fruta dulce', 'ALTA'),
(7, 'Cacahuete', 6.95, 'Ecuador', 56.46, 'Perenne', 'Frutos secos', 'ALTA'),
(8, 'Melón', 1.59, 'España', 21.75, 'Primavera', 'Cucurbitáceos', 'ALTA'),
(9, 'Arándano', 10.38, 'Argentina', 52.75, 'Otoño', 'Bayas', 'ALTA'),
(10, 'Frambuesa', 12.76, 'Ecuador', 50.00, 'Otoño', 'Bayas', 'ALTA'),
(11, 'Fresa', 4.34, 'España', 50.00, 'Perenne', 'Bayas', 'ALTA'),
(12, 'Pomelo', 2.60, 'Argentina', 32.44, 'Invierno', 'Cítricos', 'ALTA'),
(13, 'Sandía', 1.29, 'España', 16.00, 'Verano', 'Cucurbitáceos', 'ALTA'),
(14, 'Aguacate', 5.75, 'Brasil', 38.75, 'Perenne', 'Exóticos', 'ALTA'),
(15, 'Chirimoya', 7.48, 'India', 40.00, 'Invierno', 'Exóticos', 'ALTA'),
(16, 'Coco', 1.25, 'Rep. Dominicana', 48.65, 'Perenne', 'Exóticos', 'ALTA'),
(17, 'Dátil', 9.97, 'Marruecos', 60.00, 'Otoño', 'Exóticos', 'ALTA'),
(18, 'Kiwi', 4.99, 'Nueva Zelanda', 35.00, 'Otoño', 'Exóticos', 'ALTA'),
(19, 'Mango', 1.99, 'Rep. Dominicana', 45.00, 'Primavera', 'Exóticos', 'ALTA'),
(20, 'Papaya', 5.45, 'Bangladesh', 20.00, 'Verano', 'Exóticos', 'ALTA'),
(21, 'Piña', 2.39, 'Camerún', 18.00, 'Perenne', 'Exóticos', 'ALTA'),
(22, 'Plátano', 1.35, 'Filipinas', 60.00, 'Perenne', 'Exóticos', 'ALTA'),
(23, 'Albaricoque', 3.80, 'Australia', 40.00, 'Invierno', 'Fruta dulce', 'ALTA'),
(24, 'Cereza', 6.78, 'Colombia', 40.00, 'Verano', 'Fruta dulce', 'ALTA'),
(25, 'Ciruela', 5.98, 'Bélgica', 40.00, 'Verano', 'Fruta dulce', 'ALTA'),
(26, 'Higo', 5.75, 'Turquía', 40.00, 'Primavera', 'Fruta dulce', 'ALTA'),
(27, 'Kaki', 6.98, 'España', 40.00, 'Primavera', 'Fruta dulce', 'ALTA'),
(28, 'Melocotón', 4.79, 'Chile', 40.00, 'Invierno', 'Fruta dulce', 'ALTA'),
(29, 'Nectarina', 3.99, 'Australia', 35.00, 'Otoño', 'Fruta dulce', 'ALTA'),
(30, 'Níspero', 4.95, 'España', 35.00, 'Primavera', 'Fruta dulce', 'ALTA'),
(31, 'Uva', 4.90, 'Brasil', 30.00, 'Invierno', 'Fruta dulce', 'ALTA'),
(32, 'Almendra', 11.75, 'Italia', 59.65, 'Perenne', 'Frutos secos', 'ALTA'),
(33, 'Avellana', 14.75, 'España', 60.00, 'Otoño', 'Frutos secos', 'ALTA'),
(34, 'Castaña', 4.25, 'España', 60.00, 'Invierno', 'Frutos secos', 'ALTA'),
(35, 'Nuez', 6.86, 'Chile', 60.00, 'Perenne', 'Frutos secos', 'ALTA'),
(36, 'Pistacho', 13.95, 'Irán', 60.00, 'Perenne', 'Frutos secos', 'ALTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_albaran`
--

CREATE TABLE `lineas_albaran` (
  `num_linea` int NOT NULL,
  `kilos` decimal(10,2) DEFAULT NULL,
  `precio_kilo` decimal(10,2) DEFAULT NULL,
  `albaran` int NOT NULL,
  `fruta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lineas_albaran`
--

INSERT INTO `lineas_albaran` (`num_linea`, `kilos`, `precio_kilo`, `albaran`, `fruta`) VALUES
(1, 40.00, 1.59, 1, 1),
(2, 40.00, 1.49, 1, 3),
(3, 40.00, 2.29, 1, 5),
(4, 40.00, 1.94, 1, 6),
(5, 60.00, 6.65, 1, 7),
(6, 20.00, 1.29, 1, 8),
(7, 50.00, 10.08, 1, 9),
(8, 50.00, 12.46, 1, 10),
(9, 50.00, 4.04, 1, 11),
(10, 35.00, 2.30, 1, 12),
(11, 20.00, 0.99, 1, 13),
(12, 40.00, 5.45, 1, 14),
(13, 40.00, 7.18, 1, 15),
(14, 50.00, 0.95, 1, 16),
(15, 60.00, 9.67, 1, 17),
(16, 35.00, 4.69, 1, 18),
(17, 45.00, 1.69, 1, 19),
(18, 20.00, 5.15, 1, 20),
(19, 20.00, 2.09, 1, 21),
(20, 60.00, 1.05, 1, 22),
(21, 40.00, 3.50, 1, 23),
(22, 40.00, 6.48, 1, 24),
(23, 40.00, 5.68, 1, 25),
(24, 40.00, 5.45, 1, 26),
(25, 40.00, 6.68, 1, 27),
(26, 40.00, 4.49, 1, 28),
(27, 35.00, 3.69, 1, 29),
(28, 35.00, 4.65, 1, 30),
(29, 30.00, 4.60, 1, 31),
(30, 60.00, 11.45, 1, 32),
(31, 60.00, 14.45, 1, 33),
(32, 60.00, 3.95, 1, 34),
(33, 60.00, 6.56, 1, 35),
(34, 60.00, 13.65, 1, 36),
(35, 0.00, 1.49, 2, 3),
(36, 0.00, 2.29, 2, 5),
(37, 0.00, 1.94, 2, 6),
(38, 0.00, 6.65, 2, 7),
(39, 0.00, 1.29, 2, 8),
(40, 0.00, 10.08, 2, 9),
(41, 0.00, 12.46, 2, 10),
(42, 0.00, 4.04, 2, 11),
(43, 0.00, 2.30, 2, 12),
(44, 4.00, 0.99, 2, 13),
(45, 0.00, 5.45, 2, 14),
(46, 0.00, 7.18, 2, 15),
(47, 0.00, 0.95, 2, 16),
(48, 0.00, 9.67, 2, 17),
(49, 0.00, 4.69, 2, 18),
(50, 0.00, 1.69, 2, 19),
(51, 0.00, 5.15, 2, 20),
(52, 0.00, 2.09, 2, 21),
(53, 0.00, 1.05, 2, 22),
(54, 0.00, 3.50, 2, 23),
(55, 0.00, 6.48, 2, 24),
(56, 0.00, 5.68, 2, 25),
(57, 0.00, 5.45, 2, 26),
(58, 0.00, 6.68, 2, 27),
(59, 0.00, 4.49, 2, 28),
(60, 0.00, 3.69, 2, 29),
(61, 0.00, 4.65, 2, 30),
(62, 0.00, 4.60, 2, 31),
(63, 0.00, 11.45, 2, 32),
(64, 0.00, 14.45, 2, 33),
(65, 0.00, 3.95, 2, 34),
(66, 0.00, 6.56, 2, 35),
(67, 0.00, 13.65, 2, 36),
(68, 0.00, 1.19, 3, 3),
(69, 0.00, 1.99, 3, 5),
(70, 0.00, 1.64, 3, 6),
(71, 0.00, 6.35, 3, 7),
(72, 10.00, 0.99, 3, 8),
(73, 0.00, 9.78, 3, 9),
(74, 0.00, 12.16, 3, 10),
(75, 0.00, 3.74, 3, 11),
(76, 0.00, 2.00, 3, 12),
(77, 0.00, 0.69, 3, 13),
(78, 0.00, 5.15, 3, 14),
(79, 0.00, 6.88, 3, 15),
(80, 0.00, 0.65, 3, 16),
(81, 0.00, 9.37, 3, 17),
(82, 0.00, 4.39, 3, 18),
(83, 0.00, 1.39, 3, 19),
(84, 0.00, 4.85, 3, 20),
(85, 0.00, 1.79, 3, 21),
(86, 0.00, 0.75, 3, 22),
(87, 0.00, 3.20, 3, 23),
(88, 0.00, 6.18, 3, 24),
(89, 0.00, 5.38, 3, 25),
(90, 0.00, 5.15, 3, 26),
(91, 0.00, 6.38, 3, 27),
(92, 0.00, 4.19, 3, 28),
(93, 0.00, 3.39, 3, 29),
(94, 0.00, 4.35, 3, 30),
(95, 0.00, 4.30, 3, 31),
(96, 0.00, 11.15, 3, 32),
(97, 0.00, 14.15, 3, 33),
(98, 0.00, 3.65, 3, 34),
(99, 0.00, 6.26, 3, 35),
(100, 0.00, 13.35, 3, 36),
(101, 1.00, 1.19, 4, 3),
(102, 0.00, 1.99, 4, 5),
(103, 0.00, 1.64, 4, 6),
(104, 0.00, 6.35, 4, 7),
(105, 0.00, 0.99, 4, 8),
(106, 0.00, 9.78, 4, 9),
(107, 0.00, 12.16, 4, 10),
(108, 0.00, 3.74, 4, 11),
(109, 0.00, 2.00, 4, 12),
(110, 0.00, 0.69, 4, 13),
(111, 0.00, 5.15, 4, 14),
(112, 0.00, 6.88, 4, 15),
(113, 0.00, 0.65, 4, 16),
(114, 0.00, 9.37, 4, 17),
(115, 0.00, 4.39, 4, 18),
(116, 0.00, 1.39, 4, 19),
(117, 0.00, 4.85, 4, 20),
(118, 0.00, 1.79, 4, 21),
(119, 0.00, 0.75, 4, 22),
(120, 0.00, 3.20, 4, 23),
(121, 0.00, 6.18, 4, 24),
(122, 0.00, 5.38, 4, 25),
(123, 0.00, 5.15, 4, 26),
(124, 0.00, 6.38, 4, 27),
(125, 0.00, 4.19, 4, 28),
(126, 0.00, 3.39, 4, 29),
(127, 0.00, 4.35, 4, 30),
(128, 0.00, 4.30, 4, 31),
(129, 0.00, 11.15, 4, 32),
(130, 0.00, 14.15, 4, 33),
(131, 0.00, 3.65, 4, 34),
(132, 0.00, 6.26, 4, 35),
(133, 0.00, 13.35, 4, 36),
(134, 0.00, 1.19, 5, 3),
(135, 0.00, 1.99, 5, 5),
(136, 0.00, 1.64, 5, 6),
(137, 0.00, 6.35, 5, 7),
(138, 0.00, 0.99, 5, 8),
(139, 3.00, 9.78, 5, 9),
(140, 0.00, 12.16, 5, 10),
(141, 0.00, 3.74, 5, 11),
(142, 0.00, 2.00, 5, 12),
(143, 0.00, 0.69, 5, 13),
(144, 0.00, 5.15, 5, 14),
(145, 0.00, 6.88, 5, 15),
(146, 0.00, 0.65, 5, 16),
(147, 0.00, 9.37, 5, 17),
(148, 0.00, 4.39, 5, 18),
(149, 0.00, 1.39, 5, 19),
(150, 0.00, 4.85, 5, 20),
(151, 0.00, 1.79, 5, 21),
(152, 0.00, 0.75, 5, 22),
(153, 0.00, 3.20, 5, 23),
(154, 0.00, 6.18, 5, 24),
(155, 0.00, 5.38, 5, 25),
(156, 0.00, 5.15, 5, 26),
(157, 0.00, 6.38, 5, 27),
(158, 0.00, 4.19, 5, 28),
(159, 0.00, 3.39, 5, 29),
(160, 0.00, 4.35, 5, 30),
(161, 0.00, 4.30, 5, 31),
(162, 0.00, 11.15, 5, 32),
(163, 0.00, 14.15, 5, 33),
(164, 0.00, 3.65, 5, 34),
(165, 0.00, 6.26, 5, 35),
(166, 0.00, 13.35, 5, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_factura`
--

CREATE TABLE `lineas_factura` (
  `num_linea` int NOT NULL,
  `kilos` decimal(10,2) DEFAULT NULL,
  `precio_kilo` decimal(10,2) DEFAULT NULL,
  `factura` int NOT NULL,
  `fruta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lineas_factura`
--

INSERT INTO `lineas_factura` (`num_linea`, `kilos`, `precio_kilo`, `factura`, `fruta`) VALUES
(1, 1.24, 1.89, 1, 1),
(2, 0.00, 1.79, 1, 3),
(3, 0.82, 2.59, 1, 5),
(4, 0.00, 2.24, 1, 6),
(5, 3.54, 6.95, 1, 7),
(6, 3.00, 1.59, 1, 8),
(7, 0.00, 10.38, 1, 9),
(8, 0.00, 12.76, 1, 10),
(9, 0.00, 4.34, 1, 11),
(10, 0.00, 2.60, 1, 12),
(11, 3.00, 1.29, 1, 13),
(12, 1.25, 5.75, 1, 14),
(13, 0.00, 7.48, 1, 15),
(14, 0.00, 1.25, 1, 16),
(15, 0.00, 9.97, 1, 17),
(16, 0.00, 4.99, 1, 18),
(17, 0.00, 1.99, 1, 19),
(18, 0.00, 5.45, 1, 20),
(19, 0.00, 2.39, 1, 21),
(20, 0.00, 1.35, 1, 22),
(21, 0.00, 3.80, 1, 23),
(22, 0.00, 6.78, 1, 24),
(23, 0.00, 5.98, 1, 25),
(24, 0.00, 5.75, 1, 26),
(25, 0.00, 6.98, 1, 27),
(26, 0.00, 4.79, 1, 28),
(27, 0.00, 3.99, 1, 29),
(28, 0.00, 4.95, 1, 30),
(29, 0.00, 4.90, 1, 31),
(30, 0.35, 11.75, 1, 32),
(31, 0.00, 14.75, 1, 33),
(32, 0.00, 4.25, 1, 34),
(33, 0.00, 6.86, 1, 35),
(34, 0.00, 13.95, 1, 36),
(35, 0.00, 1.89, 2, 1),
(36, 0.00, 1.79, 2, 3),
(37, 0.00, 2.59, 2, 5),
(38, 0.00, 2.24, 2, 6),
(39, 0.00, 6.95, 2, 7),
(40, 0.00, 1.59, 2, 8),
(41, 0.25, 10.38, 2, 9),
(42, 0.00, 12.76, 2, 10),
(43, 0.00, 4.34, 2, 11),
(44, 0.00, 2.60, 2, 12),
(45, 0.00, 1.29, 2, 13),
(46, 0.00, 5.75, 2, 14),
(47, 0.00, 7.48, 2, 15),
(48, 0.00, 1.25, 2, 16),
(49, 0.00, 9.97, 2, 17),
(50, 0.00, 4.99, 2, 18),
(51, 0.00, 1.99, 2, 19),
(52, 0.00, 5.45, 2, 20),
(53, 0.00, 2.39, 2, 21),
(54, 0.00, 1.35, 2, 22),
(55, 0.00, 3.80, 2, 23),
(56, 0.00, 6.78, 2, 24),
(57, 0.00, 5.98, 2, 25),
(58, 0.00, 5.75, 2, 26),
(59, 0.00, 6.98, 2, 27),
(60, 0.00, 4.79, 2, 28),
(61, 0.00, 3.99, 2, 29),
(62, 0.00, 4.95, 2, 30),
(63, 0.00, 4.90, 2, 31),
(64, 0.00, 11.75, 2, 32),
(65, 0.00, 14.75, 2, 33),
(66, 0.00, 4.25, 2, 34),
(67, 0.00, 6.86, 2, 35),
(68, 0.00, 13.95, 2, 36),
(69, 1.29, 1.89, 3, 1),
(70, 0.08, 1.79, 3, 3),
(71, 0.00, 2.59, 3, 5),
(72, 0.00, 2.24, 3, 6),
(73, 0.00, 6.95, 3, 7),
(74, 2.25, 1.59, 3, 8),
(75, 0.00, 10.38, 3, 9),
(76, 0.00, 12.76, 3, 10),
(77, 0.00, 4.34, 3, 11),
(78, 0.00, 2.60, 3, 12),
(79, 0.00, 1.29, 3, 13),
(80, 0.00, 5.75, 3, 14),
(81, 0.00, 7.48, 3, 15),
(82, 0.00, 1.25, 3, 16),
(83, 0.00, 9.97, 3, 17),
(84, 0.00, 4.99, 3, 18),
(85, 0.00, 1.99, 3, 19),
(86, 0.00, 5.45, 3, 20),
(87, 0.00, 2.39, 3, 21),
(88, 0.00, 1.35, 3, 22),
(89, 0.00, 3.80, 3, 23),
(90, 0.00, 6.78, 3, 24),
(91, 0.00, 5.98, 3, 25),
(92, 0.00, 5.75, 3, 26),
(93, 0.00, 6.98, 3, 27),
(94, 0.00, 4.79, 3, 28),
(95, 0.00, 3.99, 3, 29),
(96, 0.00, 4.95, 3, 30),
(97, 0.00, 4.90, 3, 31),
(98, 0.00, 11.75, 3, 32),
(99, 0.00, 14.75, 3, 33),
(100, 0.00, 4.25, 3, 34),
(101, 0.00, 6.86, 3, 35),
(102, 0.00, 13.95, 3, 36),
(103, 0.00, 1.89, 4, 1),
(104, 0.00, 1.79, 4, 3),
(105, 0.00, 2.59, 4, 5),
(106, 0.00, 2.24, 4, 6),
(107, 0.00, 6.95, 4, 7),
(108, 3.00, 1.59, 4, 8),
(109, 0.00, 10.38, 4, 9),
(110, 0.00, 12.76, 4, 10),
(111, 0.00, 4.34, 4, 11),
(112, 2.56, 2.60, 4, 12),
(113, 5.00, 1.29, 4, 13),
(114, 0.00, 5.75, 4, 14),
(115, 0.00, 7.48, 4, 15),
(116, 1.35, 1.25, 4, 16),
(117, 0.00, 9.97, 4, 17),
(118, 0.00, 4.99, 4, 18),
(119, 0.00, 1.99, 4, 19),
(120, 0.00, 5.45, 4, 20),
(121, 2.00, 2.39, 4, 21),
(122, 0.00, 1.35, 4, 22),
(123, 0.00, 3.80, 4, 23),
(124, 0.00, 6.78, 4, 24),
(125, 0.00, 5.98, 4, 25),
(126, 0.00, 5.75, 4, 26),
(127, 0.00, 6.98, 4, 27),
(128, 0.00, 4.79, 4, 28),
(129, 0.00, 3.99, 4, 29),
(130, 0.00, 4.95, 4, 30),
(131, 0.00, 4.90, 4, 31),
(132, 0.00, 11.75, 4, 32),
(133, 0.00, 14.75, 4, 33),
(134, 0.00, 4.25, 4, 34),
(135, 0.00, 6.86, 4, 35),
(136, 0.00, 13.95, 4, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `cif` char(9) NOT NULL,
  `razon_social` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` char(12) NOT NULL,
  `dirección` varchar(200) NOT NULL,
  `mapa` text NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('ALTA','BAJA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`cif`, `razon_social`, `email`, `telefono`, `dirección`, `mapa`, `descripcion`, `estado`) VALUES
('B67228429', 'ESCOFRUIT FRUITES I VERDURES S.L.', 'business@escofruit.com', '+34 93556433', 'C/ Longitudinal 7, 136, 08040, (Barcelona)', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d890.7321151688506!2d2.119190303035649!3d41.32944410722633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a498e570deac8f%3A0x9b4bcd2efbd54e9e!2sEscofruit!5e0!3m2!1ses!2ses!4v1685118667371!5m2!1ses!2ses\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\" class=\"card-img-top\"></iframe>', 'Comercio al por mayor de frutas y frutos, verduras frescas y hortalizas', 'ALTA'),
('B73833725', 'Frutas Y Hortalizas Verde Levante SL', 'verdelevante@verdelevante.com', '968 713 344', 'Avenida Trasvase del ebro, 11 - NAV 1 Y 2, Lorqui, 30564 , Murcia', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d392.4914977580933!2d-1.2446832214258363!3d38.0952469903315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6386f84db7a9ff%3A0x4ab30a85c033084f!2sVerde%20Levante!5e0!3m2!1ses!2ses!4v1685034155180!5m2!1ses!2ses\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\" class=\"card-img-top\"></iframe>', 'La compraventa, importación y exportación de todo tipo de productos agrícolas, por cuenta propia o ajena, así como su recolección, manipulación, envasado, conservación en cámaras frigoríficas y su distribución a los distintos mercados nacionales e internacionales', 'ALTA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albaran`
--
ALTER TABLE `albaran`
  ADD PRIMARY KEY (`num_albaran`),
  ADD KEY `proveedor` (`proveedor`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`num_factura`),
  ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `fruta`
--
ALTER TABLE `fruta`
  ADD PRIMARY KEY (`codigo_fruta`);

--
-- Indices de la tabla `lineas_albaran`
--
ALTER TABLE `lineas_albaran`
  ADD PRIMARY KEY (`num_linea`),
  ADD KEY `fruta` (`fruta`),
  ADD KEY `albaran` (`albaran`);

--
-- Indices de la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  ADD PRIMARY KEY (`num_linea`),
  ADD KEY `fruta` (`fruta`),
  ADD KEY `factura` (`factura`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`cif`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albaran`
--
ALTER TABLE `albaran`
  MODIFY `num_albaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `num_factura` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fruta`
--
ALTER TABLE `fruta`
  MODIFY `codigo_fruta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `lineas_albaran`
--
ALTER TABLE `lineas_albaran`
  MODIFY `num_linea` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT de la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  MODIFY `num_linea` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albaran`
--
ALTER TABLE `albaran`
  ADD CONSTRAINT `albaran_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`cif`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas_albaran`
--
ALTER TABLE `lineas_albaran`
  ADD CONSTRAINT `lineas_albaran_ibfk_1` FOREIGN KEY (`fruta`) REFERENCES `fruta` (`codigo_fruta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lineas_albaran_ibfk_2` FOREIGN KEY (`albaran`) REFERENCES `albaran` (`num_albaran`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  ADD CONSTRAINT `lineas_factura_ibfk_1` FOREIGN KEY (`fruta`) REFERENCES `fruta` (`codigo_fruta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lineas_factura_ibfk_2` FOREIGN KEY (`factura`) REFERENCES `factura` (`num_factura`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
