-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2024 a las 16:02:59
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
-- Base de datos: `sportiva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IDcar` int(8) NOT NULL,
  `usuCar` int(8) NOT NULL,
  `fechaCar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`IDcar`, `usuCar`, `fechaCar`) VALUES
(68015, 1005, '2024-08-05 11:00:45'),
(68016, 1005, '2024-08-05 11:01:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IDcat` int(8) NOT NULL,
  `nomCat` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IDcat`, `nomCat`) VALUES
(101, 'Hombres'),
(102, 'Mujeres'),
(103, 'Niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idCom` int(8) NOT NULL,
  `tipCom` enum('duda','queja','recomendacion') NOT NULL,
  `comCom` varchar(200) NOT NULL,
  `usuCom` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idCom`, `tipCom`, `comCom`, `usuCom`) VALUES
(9001, 'duda', '¿Cómo puedo cambiar mi contraseña?', 1001),
(9002, 'queja', 'El producto llegó en mal estado.', 1002),
(9003, 'recomendacion', 'Sería bueno agregar más opciones de tallas.', 1005),
(9005, 'queja', 'Mi pedido llegó destrozado.', 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_carrito`
--

CREATE TABLE `detalle_carrito` (
  `IDdet` int(8) NOT NULL,
  `carID` int(8) NOT NULL,
  `proID` int(8) NOT NULL,
  `cantDet` int(8) NOT NULL,
  `preDet` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_carrito`
--

INSERT INTO `detalle_carrito` (`IDdet`, `carID`, `proID`, `cantDet`, `preDet`) VALUES
(69033, 68015, 4002, 1, 25000.00),
(69034, 68015, 4003, 1, 30000.00),
(69035, 68016, 3002, 1, 29000.00),
(69036, 68016, 3002, 1, 29000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IDpro` int(8) NOT NULL,
  `nomPro` varchar(32) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `prePro` mediumint(9) NOT NULL,
  `stockPro` smallint(6) NOT NULL,
  `fotoPro` varchar(32) NOT NULL DEFAULT 'notimg.png',
  `tallePro` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `catPro` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IDpro`, `nomPro`, `prePro`, `stockPro`, `fotoPro`, `tallePro`, `catPro`) VALUES
(2001, 'Botines Fútbol Puma', 140000, 15, '1719828951.jpg', 'S', 103),
(2002, 'Lentes de Sol Flexibles', 32000, 20, '1722845832.jpg', 'XS', 103),
(2003, 'Remera Deportiva Topper', 17500, 20, '1722845896.jpg', 'S', 103),
(2004, 'Botines Fútbol Puma', 140000, 1, 'nophoto.jpg', 'S', 103),
(2005, 'Lentes de Sol Flexibles', 32000, 1, 'nophoto.jpg', 'XS', 103),
(2006, 'Remera Deportiva Topper', 17500, 1, 'nophoto.jpg', 'S', 103),
(3001, 'Top Deportivo de Mujer', 14000, 29, '1719829112.jpg', 'L', 102),
(3002, 'Short Running de Mujer', 29000, 27, '1722845554.jpg', 'M', 102),
(3003, 'Corpiño Seamless', 10000, 40, '1722845681.jpg', 'S', 102),
(3004, 'Top Deportivo de Mujer', 14000, 1, 'nophoto.jpg', 'L', 102),
(3005, 'Short Running de Mujer', 29000, 1, 'nophoto.jpg', 'M', 102),
(3006, 'Corpiño Seamless', 10000, 1, 'nophoto.jpg', 'S', 102),
(4001, 'Short Running de hombre', 30000, 30, '1719829181.jpg', 'XL', 101),
(4002, 'Musculosa deportiva de hombre', 25000, 19, '1722845287.jpg', 'L', 101),
(4003, 'Buzo Deportivo Elastizado', 30000, 7, '1722845491.jpg', 'M', 101),
(4004, 'Short Running de hombre', 30000, 1, 'nophoto.jpg', 'XL', 101),
(4005, 'Musculosa deportiva de hombre', 25000, 1, 'nophoto.jpg', 'L', 101),
(4006, 'Buzo Deportivo Elastizado', 30000, 1, 'nophoto.jpg', 'M', 101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDusu` int(8) NOT NULL,
  `nomUsu` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `apeUsu` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `mailUsu` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contraUsu` varchar(100) DEFAULT NULL,
  `rolUsu` enum('Admin','Usuario','Asesor','Ban') CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDusu`, `nomUsu`, `apeUsu`, `mailUsu`, `contraUsu`, `rolUsu`) VALUES
(1001, 'ejemplo', 'ejemplo', 'ejemplo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Usuario'),
(1002, 'admin', 'admin', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(1003, 'ban', 'ban', 'ban@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Ban'),
(1005, 'asesor', 'asesor', 'asesor@gmail.com', 'fe3e366c20ef0ed452da5bf49b99a40c', 'Asesor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`IDcar`),
  ADD KEY `usuCar` (`usuCar`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IDcat`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idCom`),
  ADD KEY `fk_usuario` (`usuCom`);

--
-- Indices de la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  ADD PRIMARY KEY (`IDdet`),
  ADD KEY `carID` (`carID`),
  ADD KEY `proID` (`proID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IDpro`),
  ADD KEY `catPro` (`catPro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDusu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `IDcar` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68017;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IDcat` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idCom` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9006;

--
-- AUTO_INCREMENT de la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  MODIFY `IDdet` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69037;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IDpro` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5002;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDusu` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuCar`) REFERENCES `usuario` (`IDusu`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuCom`) REFERENCES `usuario` (`IDusu`);

--
-- Filtros para la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  ADD CONSTRAINT `detalle_carrito_ibfk_1` FOREIGN KEY (`carID`) REFERENCES `carrito` (`IDcar`),
  ADD CONSTRAINT `detalle_carrito_ibfk_2` FOREIGN KEY (`proID`) REFERENCES `producto` (`IDpro`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`catPro`) REFERENCES `categoria` (`IDcat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
