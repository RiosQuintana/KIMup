-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2017 a las 05:59:15
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kimup`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `cargo` varchar(100) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `md5` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`cargo`, `usuario`, `clave`, `md5`) VALUES
('Admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mermas`
--

CREATE TABLE `mermas` (
  `codigo` int(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `cantidad_mermas` int(50) NOT NULL,
  `motivo` varchar(500) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mermas`
--

INSERT INTO `mermas` (`codigo`, `fecha`, `cantidad_mermas`, `motivo`, `id`) VALUES
(7100, '2017-06-19', 10, 'Caducidad', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meta`
--

CREATE TABLE `meta` (
  `monto` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `meta`
--

INSERT INTO `meta` (`monto`) VALUES
(0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `fecha` date DEFAULT NULL,
  `codigo` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `proveedor` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio_compra` int(10) NOT NULL,
  `precio_venta` int(10) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `minimo` int(5) NOT NULL,
  `cant_actual` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`fecha`, `codigo`, `descripcion`, `proveedor`, `cantidad`, `precio_compra`, `precio_venta`, `departamento`, `minimo`, `cant_actual`) VALUES
('2017-06-18', 7100, 'Camarones importados 500 grs.', 'Mar verde', 50, 3500, 6790, 'Congelados', 5, 50),
('2017-06-01', 7123, 'Aceite de oliva extra virgen 1lt.', 'Talliani', 200, 2500, 5400, 'Despensa', 20, 150),
('2017-06-02', 7340, 'Queso cheddar laminado', 'Dos alamos', 100, 200, 1590, 'Lacteos', 10, 90),
('2017-06-19', 7446, 'Choclo dulce 400 grs.', 'Minuto verde', 100, 600, 1599, 'Congelados', 10, 88),
('2017-06-08', 7657, 'Arroz integral 450 grs.', 'Miraflores', 200, 300, 950, 'Despensa', 30, 180),
('2017-06-18', 7665, 'Cerveza nacional 985cc.', 'Stella Artois', 100, 560, 1999, 'Bebidas y licores', 15, 75),
('2017-06-06', 7734, 'Lasagna precocida 360 grs.', 'Lucchetti', 200, 200, 760, 'Despensa', 30, 200),
('2017-06-17', 7788, 'Agua purificada con gas 500cc.', 'Benedictino', 100, 290, 549, 'Bebidas y licores', 15, 82),
('2017-06-15', 7789, 'Pechuga pollo bandeja', 'Ariztia', 100, 2000, 4790, 'Carniceria', 20, 95),
('2017-06-17', 7890, 'Yoghurt Light Natural 115 grs.', 'Danone', 250, 60, 210, 'Lacteos', 20, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `codigo` int(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`codigo`, `descripcion`, `cantidad`, `fecha`, `hora`, `id`) VALUES
(7123, '', 50, '2017-06-20', '05:00:00.000000', 1),
(7340, '', 10, '2017-06-20', '00:00:00.000000', 5),
(7789, '', 5, '2017-06-19', '00:00:00.000000', 6),
(7789, '', 15, '2017-06-20', '00:00:00.000000', 7),
(7446, '', 12, '2017-05-20', '00:00:00.000000', 8),
(7788, '', 18, '2017-06-20', '00:00:00.000000', 9),
(7890, '', 50, '2017-05-20', '00:00:00.000000', 12),
(7657, '', 20, '2017-06-18', '00:00:00.000000', 13),
(7665, '', 25, '2017-06-18', '00:00:00.000000', 14);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mermas`
--
ALTER TABLE `mermas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_2` (`codigo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mermas`
--
ALTER TABLE `mermas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
