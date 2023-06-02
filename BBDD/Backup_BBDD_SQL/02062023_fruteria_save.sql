-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 02-06-2023 a las 02:54:49
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
(1, '2023-06-02 02:26:36', 'B67228429');

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
(1);

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
(1, '2023-06-02 02:28:57', 1);

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
(1, 'Manzana', 1.89, 'España', 38.76, 'Perenne', 'Fruta dulce', 'ALTA'),
(3, 'Limón', 1.79, 'Perú', 40.00, 'Perenne', 'Cítricos', 'ALTA'),
(5, 'Mandarina', 2.59, 'Argentina', 39.18, 'Invierno', 'Cítricos', 'ALTA'),
(6, 'Pera', 2.24, 'España', 40.00, 'Perenne', 'Fruta dulce', 'ALTA'),
(7, 'Cacahuete', 6.95, 'Ecuador', 56.46, 'Perenne', 'Frutos secos', 'ALTA'),
(8, 'Melón', 1.59, 'España', 17.00, 'Primavera', 'Cucurbitáceos', 'ALTA'),
(9, 'Arándano', 10.38, 'Argentina', 50.00, 'Otoño', 'Bayas', 'ALTA'),
(10, 'Frambuesa', 12.76, 'Ecuador', 50.00, 'Otoño', 'Bayas', 'ALTA'),
(11, 'Fresa', 4.34, 'España', 50.00, 'Perenne', 'Bayas', 'ALTA'),
(12, 'Pomelo', 2.60, 'Argentina', 35.00, 'Invierno', 'Cítricos', 'ALTA'),
(13, 'Sandía', 1.29, 'España', 17.00, 'Verano', 'Cucurbitáceos', 'ALTA'),
(14, 'Aguacate', 5.75, 'Brasil', 38.75, 'Perenne', 'Exóticos', 'ALTA'),
(15, 'Chirimoya', 7.48, 'India', 40.00, 'Invierno', 'Exóticos', 'ALTA'),
(16, 'Coco', 1.25, 'Rep. Dominicana', 50.00, 'Perenne', 'Exóticos', 'ALTA'),
(17, 'Dátil', 9.97, 'Marruecos', 60.00, 'Otoño', 'Exóticos', 'ALTA'),
(18, 'Kiwi', 4.99, 'Nueva Zelanda', 35.00, 'Otoño', 'Exóticos', 'ALTA'),
(19, 'Mango', 1.99, 'Rep. Dominicana', 45.00, 'Primavera', 'Exóticos', 'ALTA'),
(20, 'Papaya', 5.45, 'Bangladesh', 20.00, 'Verano', 'Exóticos', 'ALTA'),
(21, 'Piña', 2.39, 'Camerún', 20.00, 'Perenne', 'Exóticos', 'ALTA'),
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
(34, 60.00, 13.65, 1, 36);

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
(34, 0.00, 13.95, 1, 36);

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
  MODIFY `num_albaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `num_factura` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fruta`
--
ALTER TABLE `fruta`
  MODIFY `codigo_fruta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `lineas_albaran`
--
ALTER TABLE `lineas_albaran`
  MODIFY `num_linea` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  MODIFY `num_linea` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
