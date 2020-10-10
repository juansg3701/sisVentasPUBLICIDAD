-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2020 a las 22:06:40
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unoa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_modulo`
--

CREATE TABLE `cargo_modulo` (
  `id_cargoModulo` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cargo_modulo`
--

INSERT INTO `cargo_modulo` (`id_cargoModulo`, `id_cargo`, `id_modulo`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 1, 7),
(4, 2, 4),
(5, 3, 3),
(6, 3, 2),
(7, 3, 1),
(8, 3, 5),
(9, 1, 1),
(10, 1, 2),
(11, 3, 6),
(12, 4, 10),
(13, 4, 5),
(14, 3, 7),
(15, 4, 6),
(16, 3, 6),
(17, 1, 6),
(18, 1, 3),
(19, 1, 8),
(20, 1, 9),
(21, 1, 10),
(22, 1, 11),
(23, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'alimentos', 'verduras'),
(2, 'Ropa', 'Deportiva'),
(3, 'accesorios', 'ropa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_stock_especiales`
--

CREATE TABLE `categoria_stock_especiales` (
  `id_categoriaStock` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `verificacion_nit` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_empresa` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cartera_activa` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `user_id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `direccion`, `telefono`, `correo`, `documento`, `verificacion_nit`, `nombre_empresa`, `cartera_activa`, `user_id_user`) VALUES
(1, 'e', 'e', '4', 'e@gmail.com', '55', '22', 'a', '1', 0),
(5, 'Andres', '', '312289734527', 'Andres@gmail.com', '3', '', '', '1', 0),
(7, 'holman', 'calle 12', '12314', 'h@gmail.com', '2131234', '123', 'canasta', '1', 0),
(23, 'Diana Torres', 'Avenida 24', '3223332212', 'dt@gmail.com', '487654321', '7', NULL, '0', 0),
(24, 'Gabriel Suarez', 'Carrera 23', '1312321132', 'daniel@gmail.com', '1312312132', '7', NULL, '0', 0),
(25, 'Holman Rincon', 'Carrera 45', '2331212132', 'holman@gmail.com', '3223223322', '8', NULL, '0', 0),
(26, 'Carlos Camargo', 'Calle 11', '12131321', 'carlos@hotmail.com', '32233232', '8', NULL, '0', 0),
(27, 'Juan Sanchez', 'calle 22', '13212321', 'h@gmail.com', '2132133123', '9', NULL, '0', 0),
(28, 'b', 'b', '1', 'b@gmail.com', '22', '', NULL, '0', 0),
(29, 'c', 'c', '1', 'c@gmail.com', '123', '6', NULL, '0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_inventario`
--

CREATE TABLE `c_inventario` (
  `id_corte` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `noproductos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor_total` double DEFAULT NULL,
  `p_tiempo_id_tiempo` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `c_inventario`
--

INSERT INTO `c_inventario` (`id_corte`, `fecha`, `noproductos`, `valor_total`, `p_tiempo_id_tiempo`, `sede_id_sede`) VALUES
(101, '2019-11-05 00:00:00', NULL, NULL, 1, 1),
(102, '2019-11-05 00:00:00', NULL, NULL, 1, 1),
(103, '2019-11-05 00:00:00', NULL, NULL, 1, 2),
(104, '2019-11-05 00:00:00', NULL, NULL, 1, 1),
(105, '2019-11-18 00:00:00', NULL, NULL, 1, 1),
(106, '2019-11-18 00:00:00', NULL, NULL, 1, 1),
(107, '2019-11-19 00:00:00', NULL, NULL, 1, 1),
(108, '2019-11-19 00:00:00', NULL, NULL, 1, 1),
(109, '2019-11-19 00:00:00', NULL, NULL, 1, 1),
(110, '2019-11-19 00:00:00', NULL, NULL, 1, 1),
(111, '2019-11-19 00:00:00', NULL, NULL, 1, 1),
(112, '2019-11-19 00:00:00', NULL, NULL, 1, 1),
(113, '2019-11-19 00:00:00', NULL, NULL, 1, 4),
(114, '2019-11-20 00:00:00', NULL, NULL, 1, 1),
(115, '2019-11-20 00:00:00', NULL, NULL, 1, 1),
(116, '2019-11-20 00:00:00', NULL, NULL, 1, 1),
(117, '2019-11-20 00:00:00', NULL, NULL, 1, 1),
(118, '2019-11-20 00:00:00', NULL, NULL, 1, 1),
(119, '2019-11-20 00:00:00', NULL, NULL, 1, 1),
(120, '2020-07-05 21:43:21', NULL, NULL, 1, 1),
(121, '2020-07-13 23:13:39', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id_descuento` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `caracteristica` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `porcentaje` double NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id_descuento`, `nombre`, `caracteristica`, `porcentaje`, `sede_id_sede`) VALUES
(1, '50% ahorro', 'semestral', 50, 1),
(2, '10% Ahorro', 'mensual', 10, 1),
(3, 'Sin descuento', 'fijo', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detallef` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `factura_id_factura` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `descuentos_id_descuento` int(11) NOT NULL,
  `impuestos_id_impuestos` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `total_impuesto` double NOT NULL,
  `total_descuento` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detallef`, `cantidad`, `precio_venta`, `factura_id_factura`, `producto_id_producto`, `descuentos_id_descuento`, `impuestos_id_impuestos`, `total`, `total_impuesto`, `total_descuento`) VALUES
(47, 3, 22456, 26, 12, 1, 1, 33684, 0, 0),
(48, 1, 34987, 26, 11, 1, 1, 17494, 0, 0),
(49, 1, 22456, 27, 12, 1, 1, 11228, 0, 0),
(50, 1, 22456, 28, 12, 3, 1, 22456, 0, 0),
(51, 1, 22456, 29, 12, 1, 1, 11228, 0, 0),
(52, 1, 22456, 30, 12, 1, 1, 11228, 0, 0),
(53, 2, 34987, 31, 11, 1, 1, 34987, 0, 0),
(54, 5, 34987, 31, 11, 3, 1, 174935, 0, 0),
(55, 1, 22456, 33, 12, 1, 1, 11228, 0, 0),
(56, 2, 22456, 34, 12, 1, 1, 22456, 0, 0),
(57, 1, 22456, 35, 12, 1, 1, 11228, 0, 0),
(58, 1, 22456, 36, 12, 1, 1, 11228, 0, 0),
(59, 2, 22456, 32, 12, 2, 2, 22456, 0, 0),
(60, 2, 34987, 32, 11, 1, 1, 34987, 0, 0),
(61, 1, 22456, 38, 12, 1, 1, 11228, 0, 0),
(62, 1, 22456, 39, 12, 1, 1, 11228, 0, 0),
(63, 1, 22456, 40, 12, 1, 1, 11228, 0, 0),
(64, 1, 22456, 41, 12, 1, 1, 11228, 0, 0),
(65, 2, 22456, 43, 12, 1, 1, 22456, 0, 0),
(66, 1, 22456, 44, 12, 1, 1, 11228, 0, 0),
(67, 1, 34987, 46, 11, 1, 1, 17494, 0, 0),
(68, 1, 22456, 46, 12, 1, 1, 11228, 0, 0),
(69, 1, 22456, 46, 12, 1, 1, 11228, 0, 0),
(70, 1, 34987, 37, 11, 1, 1, 17494, 0, 0),
(71, 1, 34987, 48, 11, 1, 1, 17494, 0, 0),
(72, 1, 34987, 49, 11, 1, 1, 17494, 0, 0),
(73, 1, 34987, 50, 11, 1, 1, 17494, 0, 0),
(74, 1, 34987, 51, 11, 1, 1, 17494, 0, 0),
(75, 1, 34987, 52, 11, 1, 1, 17494, 0, 0),
(76, 1, 34987, 53, 11, 1, 1, 17494, 0, 0),
(77, 1, 34987, 53, 11, 1, 1, 17494, 0, 0),
(78, 1, 23, 54, 8, 1, 1, 12, 0, 0),
(79, 1, 34987, 55, 11, 1, 1, 17494, 0, 0),
(80, 5, 34987, 56, 11, 1, 1, 87468, 0, 0),
(81, 5, 34987, 57, 11, 1, 1, 87468, 0, 0),
(82, 4, 34987, 59, 11, 1, 1, 69974, 0, 0),
(83, 1, 230000, 60, 8, 1, 1, 115000, 0, 0),
(84, 1, 230000, 61, 8, 1, 1, 115000, 0, 0),
(85, 1, 23, 62, 8, 1, 1, 12, 0, 0),
(86, 1, 34987, 62, 11, 1, 1, 17494, 0, 0),
(87, 1, 23, 62, 8, 1, 2, 16, 0, 0),
(88, 1, 23, 63, 8, 3, 1, 23, 0, 0),
(89, 1, 23, 64, 8, 3, 1, 23, 0, 0),
(90, 1, 23, 65, 8, 1, 1, 12, 0, 0),
(91, 1, 230000, 65, 8, 1, 1, 115000, 0, 0),
(92, 1, 23, 69, 8, 1, 1, 12, 0, 0),
(93, 1, 1, 70, 8, 1, 1, 1, 0, 0),
(94, 1, 4, 70, 8, 3, 1, 4, 0, 0),
(95, 1, 22456, 70, 12, 1, 1, 11228, 0, 0),
(96, 1, 23, 70, 8, 1, 1, 12, 0, 0),
(97, 2, 22456, 70, 12, 1, 1, 22456, 0, 0),
(98, 2, 23, 70, 8, 1, 1, 23, 0, 0),
(99, 23, 22456, 70, 12, 1, 1, 258244, 0, 0),
(100, 20, 22456, 67, 12, 1, 1, 224560, 0, 0),
(101, 24, 23, 67, 8, 1, 1, 276, 0, 0),
(102, 1, 22456, 66, 12, 1, 1, 11228, 0, 0),
(103, 1, 20000, 70, 10, 1, 1, 10000, 0, 0),
(104, 10, 20000, 71, 10, 1, 1, 100000, 0, 0),
(105, 1, 22456, 72, 12, 1, 1, 11228, 0, 0),
(106, 5, 20000, 72, 10, 1, 1, 50000, 0, 0),
(107, 5, 20000, 73, 10, 1, 1, 50000, 0, 0),
(108, 1, 22456, 73, 12, 1, 1, 11228, 0, 0),
(109, 1, 22456, 73, 12, 1, 1, 11228, 0, 0),
(110, 1, 22456, 74, 12, 1, 1, 11228, 0, 0),
(111, 1, 22456, 75, 12, 1, 1, 11228, 0, 0),
(112, 1, 22456, 76, 12, 1, 1, 11228, 0, 0),
(113, 1, 22456, 78, 12, 1, 1, 11228, 0, 0),
(114, 1, 22456, 79, 12, 1, 1, 11228, 0, 0),
(115, 1, 22456, 80, 12, 1, 1, 11228, 0, 0),
(116, 1, 22456, 81, 12, 1, 1, 11228, 0, 0),
(117, 1, 22456, 82, 12, 1, 1, 11228, 0, 0),
(118, 1, 22456, 83, 12, 1, 1, 11228, 0, 0),
(119, 1, 22456, 84, 12, 1, 1, 11228, 0, 0),
(120, 1, 22456, 85, 12, 1, 1, 11228, 0, 0),
(121, 1, 22456, 86, 12, 1, 1, 11228, 0, 0),
(122, 1, 22456, 87, 12, 1, 1, 11228, 0, 0),
(123, 1, 22456, 88, 12, 1, 1, 11228, 0, 0),
(124, 1, 22456, 89, 12, 1, 1, 11228, 0, 0),
(125, 1, 22456, 90, 12, 1, 1, 11228, 0, 0),
(126, 1, 22456, 91, 12, 1, 1, 11228, 0, 0),
(127, 1, 22456, 92, 12, 1, 1, 11228, 0, 0),
(128, 1, 20000, 92, 10, 1, 1, 10000, 0, 0),
(129, 1, 20000, 93, 10, 1, 1, 10000, 0, 0),
(130, 1, 20000, 94, 10, 1, 1, 10000, 0, 0),
(131, 1, 20000, 95, 10, 1, 1, 10000, 0, 0),
(132, 1, 34987, 97, 11, 1, 1, 17494, 0, 0),
(133, 1, 22456, 98, 12, 1, 1, 11228, 0, 0),
(134, 1, 22456, 99, 12, 1, 1, 11228, 0, 0),
(135, 8, 20000, 99, 10, 1, 1, 80000, 0, 0),
(136, 1, 22456, 100, 12, 1, 1, 11228, 0, 0),
(137, 8, 20000, 100, 10, 1, 1, 80000, 0, 0),
(138, 1, 22456, 101, 12, 1, 1, 11228, 0, 0),
(139, 8, 20000, 101, 10, 1, 1, 80000, 0, 0),
(140, 1, 22456, 102, 12, 1, 1, 11228, 0, 0),
(141, 8, 20000, 102, 10, 1, 1, 80000, 0, 0),
(145, 1, 22456, 104, 12, 1, 1, 11228, 0, 0),
(146, 8, 20000, 104, 10, 1, 1, 80000, 0, 0),
(147, 1, 22456, 105, 12, 1, 1, 11228, 0, 0),
(148, 1, 20000, 105, 10, 1, 1, 10000, 0, 0),
(150, 7, 20000, 105, 10, 1, 1, 70000, 0, 0),
(153, 1, 22456, 106, 12, 1, 1, 11228, 0, 0),
(154, 1, 20000, 107, 10, 1, 1, 10000, 0, 0),
(155, 1, 20000, 202, 10, 1, 1, 10000, 0, 0),
(156, 1, 20000, 203, 10, 1, 1, 10000, 0, 0),
(157, 1, 20000, 204, 10, 1, 1, 10000, 0, 0),
(158, 1, 2000, 205, 12, 3, 1, 2000, 0, 0),
(159, 1, 22456, 206, 13, 1, 1, 11228, 0, 0),
(160, 1, 34987, 206, 11, 1, 1, 17494, 0, 0),
(161, 1, 23, 206, 8, 1, 1, 12, 0, 0),
(162, 1, 23, 206, 8, 1, 1, 12, 0, 0),
(163, 1, 20000, 206, 14, 1, 1, 10000, 0, 0),
(164, 1, 23, 206, 8, 1, 1, 12, 0, 0),
(165, 1, 20000, 206, 10, 1, 1, 10000, 0, 0),
(166, 1, 23, 207, 8, 1, 1, 12, 0, 0),
(167, 1, 23, 209, 8, 1, 1, 12, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pagos`
--

CREATE TABLE `detalle_pagos` (
  `id_dpagos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `valor_abono` double NOT NULL,
  `valor_total` double NOT NULL,
  `valor_restante` double NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `id_cuentas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_pagos`
--

INSERT INTO `detalle_pagos` (`id_dpagos`, `fecha`, `valor_abono`, `valor_total`, `valor_restante`, `empleado_id_empleado`, `tipo_pago`, `id_cuentas`) VALUES
(1, '2020-02-02 00:00:00', 6, 12, 6, 2, 1, 4),
(2, '2020-02-02 00:00:00', 6, 12, 0, 2, 1, 4),
(3, '2020-02-02 00:00:00', 100000, 500000, 400000, 2, 1, 6),
(4, '2020-03-08 00:00:00', 12, 12, 0, 2, 1, 5),
(5, '2020-03-08 00:00:00', 100000, 500000, 300000, 2, 1, 6),
(6, '2020-03-08 00:00:00', 100000, 500000, 200000, 2, 1, 6),
(7, '2020-03-08 00:00:00', 50000, 100000, 50000, 2, 1, 7),
(8, '2020-03-10 00:00:00', 12, 100000, 49988, 2, 2, 7),
(9, '2020-03-10 00:00:00', 123, 100000, 49865, 2, 1, 7),
(10, '2020-03-10 00:00:00', 21, 1000000000, 999999979, 2, 1, 8),
(11, '2020-03-10 00:00:00', 34, 1000000000, 999999945, 2, 2, 8),
(12, '2020-03-10 00:00:00', 56, 1000000000, 999999889, 2, 3, 8),
(13, '2020-03-15 00:00:00', 10, 1000000000, 999999879, 2, 1, 8),
(14, '2020-03-15 00:00:00', 10, 1000000000, 999999869, 2, 2, 8),
(15, '2020-07-05 21:44:00', 10, 100, 90, 2, 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_corte`
--

CREATE TABLE `d_corte` (
  `id_dcorte` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `c_inventario_id_corte` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `producto_id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `d_corte`
--

INSERT INTO `d_corte` (`id_dcorte`, `cantidad`, `c_inventario_id_corte`, `fecha`, `producto_id_producto`) VALUES
(22, 1, 101, '2019-11-05 00:00:00', 5),
(23, 1, 101, '2019-11-05 00:00:00', 3),
(24, 5, 102, '2019-11-05 00:00:00', 2),
(25, 1, 102, '2019-11-05 00:00:00', 5),
(26, 4, 103, '2019-11-05 00:00:00', 2),
(27, 1, 119, '2019-11-20 00:00:00', 3),
(28, 1, 120, '2020-07-05 21:43:49', 2),
(29, 1, 120, '2020-07-13 23:12:53', 2),
(30, 1, 120, '2020-07-13 23:13:16', 5),
(31, 1, 121, '2020-07-13 23:13:53', 3),
(32, 4, 121, '2020-07-23 23:12:05', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_p_cliente`
--

CREATE TABLE `d_p_cliente` (
  `id_dpcliente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `total` double DEFAULT NULL,
  `t_p_cliente_id_remision` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `descuentos_id_descuento` int(11) NOT NULL,
  `impuestos_id_impuestos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `d_p_cliente`
--

INSERT INTO `d_p_cliente` (`id_dpcliente`, `cantidad`, `precio_venta`, `total`, `t_p_cliente_id_remision`, `producto_id_producto`, `descuentos_id_descuento`, `impuestos_id_impuestos`) VALUES
(80, 1, 1000, 500, 75, 8, 1, 1),
(81, 1, 500, 250, 76, 8, 1, 1),
(82, 2, 500, 500, 77, 8, 1, 1),
(83, 10, 1000, 10000, 78, 8, 3, 1),
(85, 1, 22456, 11228, 81, 12, 1, 1),
(86, 1, 34987, 17493.5, 81, 11, 1, 1),
(87, 1, 23, 11.5, 81, 8, 1, 1),
(88, 1, 23, 11.5, 82, 8, 1, 1),
(89, 1, 20000, 10000, 82, 10, 1, 1),
(90, 1, 23, 11.5, 82, 8, 1, 1),
(91, 1, 23, 11.5, 82, 8, 1, 1),
(92, 1, 20000, 10000, 82, 10, 1, 1),
(93, 1, 23, 11.5, 83, 8, 1, 1),
(94, 1, 22456, 11228, 83, 13, 1, 1),
(95, 1, 23, 11.5, 83, 8, 1, 1),
(96, 1, 23, 11.5, 83, 8, 1, 1),
(97, 1, 20000, 10000, 83, 14, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_p_proveedor`
--

CREATE TABLE `d_p_proveedor` (
  `id_dpproveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `total` double DEFAULT NULL,
  `descuentos_id_descuento` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `impuestos_id_impuestos` int(11) NOT NULL,
  `tp_aproveedor_id_rproveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `d_p_proveedor`
--

INSERT INTO `d_p_proveedor` (`id_dpproveedor`, `cantidad`, `precio_venta`, `total`, `descuentos_id_descuento`, `producto_id_producto`, `impuestos_id_impuestos`, `tp_aproveedor_id_rproveedor`) VALUES
(1, 1, 1000, 500, 1, 12, 1, 37),
(2, 1, 1000, 1190, 3, 11, 2, 37),
(3, 1, 23, 11.5, 1, 8, 1, 37),
(4, 1, 22456, 11228, 1, 13, 1, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_cargo_id_cargo` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `verificacion_nit` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `correo`, `tipo_cargo_id_cargo`, `sede_id_sede`, `telefono`, `direccion`, `codigo`, `verificacion_nit`, `user_id_user`) VALUES
(2, 'juan', 'juan@gmail.com', 1, 1, '31289362', 'calle 12', '193648', '1', NULL),
(3, 'fabian', '', 1, 1, '', '', '222', NULL, NULL),
(10, 'David', '', 2, 2, '', '', '4565', NULL, NULL),
(11, 'Rosa', 'rosa@gmail.com', 1, 1, '', '', '233', NULL, NULL),
(12, 'Maria perez', '', 1, 1, '', '', '200000', NULL, NULL),
(13, 'Lucia', 'david@gmail.com', 1, 1, '', '', '1234', NULL, NULL),
(14, 'David Talero', 'david@gmail.com', 1, 1, '', '', '2332', NULL, NULL),
(15, 'holman rincon', 'david@gmail.com', 1, 1, '', '', '1111', NULL, NULL),
(18, 'marta alvarez', '', 1, 1, '', '', '111', NULL, NULL),
(22, 'gabriel sanchez', 'juan@gmail.com', 1, 1, '', '', '1111', NULL, NULL),
(23, 'carlos gomez', 'carlos@gmail.com', 2, 4, '', '', '122345', NULL, NULL),
(25, 'david vargas', 'david@gmail.com', 1, 1, '', '', '12345', NULL, NULL),
(26, 'a', '', 1, 1, '', '', '78', NULL, NULL),
(27, 'walter', 'walter@gmail.com', 1, 1, '', '', '12190', NULL, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `pago_total` double NOT NULL,
  `noproductos` int(11) NOT NULL,
  `tipo_pago_id_tpago` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tiendaodomicilio` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `facturaPaga` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `pago_total`, `noproductos`, `tipo_pago_id_tpago`, `empleado_id_empleado`, `cliente_id_cliente`, `fecha`, `tiendaodomicilio`, `facturaPaga`) VALUES
(9, 56140, 5, 2, 2, 5, '2019-12-15 00:00:00', '0', 1),
(10, 22456, 9, 3, 2, 5, '2019-12-15 00:00:00', '0', 0),
(13, 141473, 11, 1, 2, 5, '2019-12-21 00:00:00', '0', 1),
(15, 269472, 24, 1, 2, 5, '2019-12-22 00:00:00', '0', 0),
(16, 44912, 4, 3, 2, 5, '2019-12-22 00:00:00', '0', 1),
(17, 22456, 2, 1, 2, 5, '2019-12-22 00:00:00', '0', 1),
(18, 20000, 2, 1, 2, 5, '2019-12-22 00:00:00', '0', 1),
(19, 32456, 3, 1, 2, 5, '2019-12-22 00:00:00', '0', 1),
(20, 74937, 5, 1, 2, 5, '2019-12-22 00:00:00', '0', 1),
(21, 39950, 3, 1, 2, 5, '2019-12-22 00:00:00', '0', 1),
(22, 57443, 4, 1, 2, 5, '2019-12-22 00:00:00', '0', 1),
(23, 56140, 5, 2, 2, 5, '2019-12-22 00:00:00', '0', 1),
(24, 57443, 4, 1, 2, 5, '2019-12-22 00:00:00', '0', 1),
(25, 22456, 2, 3, 2, 5, '2019-12-22 00:00:00', '0', 1),
(26, 51178, 4, 1, 2, 5, '2019-12-25 00:00:00', '0', 1),
(27, 11228, 1, 1, 2, 5, '2019-12-27 00:00:00', '0', 1),
(28, 22456, 1, 3, 2, 5, '2019-12-27 00:00:00', '0', 1),
(29, 11228, 1, 3, 2, 5, '2019-12-27 00:00:00', '0', 1),
(30, 11228, 1, 3, 2, 5, '2019-12-27 00:00:00', '0', 0),
(31, 209922, 7, 1, 2, 1, '2019-12-28 00:00:00', '0', 0),
(32, 57443, 4, 1, 2, 1, '2019-12-28 00:00:00', '0', 1),
(33, 11228, 1, 1, 2, 5, '2020-01-01 00:00:00', '0', 1),
(34, 22456, 2, 1, 2, 5, '2020-01-01 00:00:00', '0', 1),
(35, 11228, 1, 1, 2, 5, '2020-01-02 00:00:00', '0', 1),
(36, 11228, 1, 1, 2, 5, '2020-01-02 00:00:00', '0', 1),
(37, 17494, 1, 1, 2, 5, '2020-01-05 00:00:00', '0', 1),
(38, 11228, 1, 1, 2, 5, '2020-01-06 00:00:00', '0', 1),
(39, 11228, 1, 4, 2, 5, '2020-01-12 00:00:00', '0', 0),
(40, 11228, 1, 4, 2, 5, '2020-01-12 00:00:00', '0', 0),
(41, 11228, 1, 4, 2, 5, '2020-01-12 00:00:00', '0', 0),
(42, 0, 0, 1, 2, 5, '2020-01-19 00:00:00', '0', 1),
(43, 22456, 2, 4, 2, 5, '2020-01-19 00:00:00', '0', 1),
(44, 11228, 1, 4, 2, 5, '2020-03-03 00:00:00', '0', 0),
(46, 39950, 3, 1, 2, 5, '2020-03-06 00:00:00', '0', 1),
(47, 0, 0, 1, 2, 5, '2020-03-06 00:00:00', '0', 0),
(48, 17494, 1, 2, 2, 5, '2020-03-06 00:00:00', '0', 1),
(49, 17494, 1, 1, 2, 5, '2020-03-06 00:00:00', '0', 1),
(50, 17494, 1, 1, 2, 5, '2020-03-06 00:00:00', '0', 0),
(51, 17494, 1, 2, 2, 5, '2020-03-06 00:00:00', '0', 1),
(52, 17494, 1, 1, 2, 5, '2020-03-06 00:00:00', '0', 1),
(53, 34988, 2, 1, 2, 5, '2020-03-06 00:00:00', '0', 1),
(54, 12, 1, 2, 2, 5, '2020-03-06 00:00:00', '0', 1),
(55, 17494, 1, 1, 2, 5, '2020-03-07 00:00:00', '0', 0),
(56, 87468, 5, 4, 2, 5, '2020-03-07 00:00:00', '0', 0),
(57, 87468, 5, 1, 2, 5, '2020-03-07 00:00:00', '0', 1),
(58, 0, 0, 2, 2, 5, '2020-03-08 00:00:00', '0', 0),
(59, 69974, 4, 2, 2, 5, '2020-03-08 00:00:00', '0', 1),
(60, 115000, 1, 3, 2, 5, '2020-03-08 00:00:00', '0', 1),
(61, 115000, 1, 3, 2, 5, '2020-03-08 00:00:00', '0', 1),
(62, 17522, 3, 1, 2, 5, '2020-03-08 00:00:00', '0', 1),
(63, 23, 1, 2, 2, 5, '2020-03-08 00:00:00', '0', 1),
(64, 23, 1, 4, 2, 5, '2020-03-08 00:00:00', '0', 0),
(65, 115012, 2, 3, 2, 5, '2020-03-08 00:00:00', '0', 0),
(66, 11228, 1, 1, 2, 5, '2020-03-10 00:00:00', '0', 1),
(67, 224836, 44, 1, 2, 5, '2020-03-10 00:00:00', '0', 1),
(68, 0, 0, 3, 2, 5, '2020-03-10 00:00:00', '0', 0),
(69, 12, 1, 3, 2, 5, '2020-03-10 00:00:00', '0', 1),
(70, 301968, 32, 3, 2, 5, '2020-03-10 00:00:00', '0', 0),
(71, 100000, 10, 1, 2, 5, '2020-03-12 00:00:00', '0', 1),
(72, 61228, 6, 1, 2, 5, '2020-03-12 00:00:00', '0', 1),
(73, 72456, 7, 1, 2, 5, '2020-03-12 00:00:00', '0', 1),
(74, 11228, 1, 2, 2, 5, '2020-03-13 00:00:00', '0', 1),
(75, 11228, 1, 1, 2, 5, '2020-03-13 00:00:00', '0', 1),
(76, 11228, 1, 2, 2, 5, '2020-03-13 00:00:00', '0', 1),
(77, 0, 0, 1, 2, 5, '2020-03-13 00:00:00', '0', 0),
(78, 11228, 1, 1, 2, 5, '2020-03-13 00:00:00', '0', 1),
(79, 11228, 1, 1, 2, 5, '2020-03-13 00:00:00', '0', 1),
(80, 11228, 1, 1, 2, 5, '2020-03-13 00:00:00', '0', 1),
(81, 11228, 1, 2, 2, 5, '2020-03-13 00:00:00', '0', 1),
(82, 11228, 1, 4, 2, 5, '2020-03-13 00:00:00', '0', 0),
(83, 11228, 1, 1, 2, 5, '2020-03-13 00:00:00', '0', 0),
(84, 11228, 1, 4, 2, 5, '2020-03-13 00:00:00', '0', 0),
(85, 11228, 1, 4, 2, 5, '2020-03-13 00:00:00', '0', 0),
(86, 11228, 1, 1, 2, 5, '2020-03-13 00:00:00', '0', 0),
(87, 11228, 1, 2, 2, 5, '2020-03-13 00:00:00', '0', 1),
(88, 11228, 1, 4, 2, 5, '2020-03-13 00:00:00', '0', 0),
(89, 11228, 1, 1, 2, 5, '2020-03-14 00:00:00', '0', 1),
(90, 11228, 1, 4, 2, 5, '2020-03-14 00:00:00', '0', 1),
(91, 11228, 1, 3, 2, 5, '2020-03-15 00:00:00', '0', 1),
(92, 21228, 2, 1, 2, 5, '2020-03-15 00:00:00', '0', 1),
(93, 10000, 1, 2, 2, 5, '2020-03-15 00:00:00', '0', 1),
(94, 10000, 1, 4, 2, 5, '2020-03-15 00:00:00', '0', 1),
(95, 10000, 1, 3, 2, 5, '2020-03-15 00:00:00', '0', 1),
(96, 0, 0, 1, 2, 5, '2020-03-17 00:00:00', '0', 0),
(97, 17494, 1, 1, 2, 5, '2020-03-17 00:00:00', '0', 0),
(98, 11228, 1, 1, 2, 5, '2020-03-19 00:00:00', '0', 1),
(99, 91228, 9, 1, 2, 5, '2020-03-19 00:00:00', '0', 1),
(100, 91228, 9, 1, 2, 5, '2020-03-19 00:00:00', '0', 1),
(101, 91228, 9, 1, 2, 5, '2020-03-19 00:00:00', '0', 1),
(102, 91228, 9, 1, 2, 5, '2020-03-19 00:00:00', '0', 1),
(103, 0, 0, 1, 2, 5, '2020-03-19 00:00:00', '0', 0),
(104, 91228, 9, 2, 2, 5, '2020-03-19 00:00:00', '0', 1),
(105, 91228, 9, 1, 2, 5, '2020-03-20 00:00:00', '0', 1),
(106, 11228, 1, 1, 2, 5, '2020-03-20 00:00:00', '0', 0),
(107, 10011, 2, 2, 26, 5, '2020-03-18 00:00:00', '1', 0),
(202, 10000, 1, 2, 2, 5, '2020-03-29 00:00:00', '0', 1),
(203, 10000, 1, 1, 2, 5, '2020-03-30 00:00:00', '0', 1),
(204, 10000, 1, 1, 2, 5, '2020-03-30 00:00:00', '0', 1),
(205, 2000, 1, 1, 3, 1, '2020-06-03 00:00:00', '0', 1),
(206, 48758, 7, 1, 2, 5, '2020-07-10 17:30:00', '0', 0),
(207, 12, 1, 1, 2, 7, '2020-07-15 21:49:00', '0', 0),
(208, 0, 0, 1, 2, 7, '2020-07-23 22:41:00', '0', 0),
(209, 12, 1, 1, 2, 7, '2020-07-23 22:41:00', '0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `id_impuestos` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`id_impuestos`, `nombre`, `valor`) VALUES
(1, 'otros', 0),
(2, 'iva', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre`) VALUES
(1, 'Usuarios'),
(2, 'Proveedores'),
(3, 'Clientes'),
(4, 'Caja'),
(5, 'Inventario'),
(6, 'Nomina'),
(7, 'PedidosDevolucion'),
(8, 'Facturacion'),
(9, 'PagosCobros'),
(10, 'Reportes'),
(11, 'Sedes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `m_stock`
--

CREATE TABLE `m_stock` (
  `id_mstock` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `stock_id_stock` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `sede_id_sede2` int(11) NOT NULL,
  `t_movimiento_id_tmovimiento` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `m_stock`
--

INSERT INTO `m_stock` (`id_mstock`, `fecha`, `stock_id_stock`, `sede_id_sede`, `sede_id_sede2`, `t_movimiento_id_tmovimiento`, `id_empleado`) VALUES
(19, '2019-09-09 00:00:00', 4, 3, 3, 1, 2),
(20, '2019-09-02 00:00:00', 2, 3, 3, 2, 2),
(21, '2019-09-10 00:00:00', 8, 3, 3, 1, 2),
(22, '2019-09-10 00:00:00', 9, 3, 3, 1, 2),
(27, '2019-09-19 00:00:00', 2, 1, 1, 1, 2),
(28, '2019-11-05 00:00:00', 2, 1, 1, 1, 2),
(29, '2020-07-23 23:12:43', 9, 2, 4, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('juangomez3701@gmail.com', '8b1015d1cf4b43e5045f80ee16d599781dbb7f78111840bd8c06c77b11441972', '2019-11-04 15:12:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `plu` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `ean` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `stock_minimo` double NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `imagen` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria_id_categoria` int(11) NOT NULL,
  `impuestos_id_impuestos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `plu`, `ean`, `nombre`, `precio`, `stock_minimo`, `fecha_registro`, `imagen`, `categoria_id_categoria`, `impuestos_id_impuestos`) VALUES
(2, '1562', '271', 'Coliflor', 23, 4, '2020-01-01', '', 1, 1),
(3, '234', '123', 'Manzana', 22456, 100, '2020-01-01', '', 1, 1),
(4, '5674', '234', 'Pera', 34987, 2, '2020-01-01', '', 1, 1),
(5, '1234', '124', 'maracuya', 20000, 3, '2020-01-01', '', 3, 1),
(6, '12333', '1290', 'plato 1', 1000000, 11, '2020-02-01', '', 1, 1),
(7, '1', '1', 'a', 1, 2, '2020-03-01', '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_empresa` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_proveedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `verificacion_nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_empresa`, `nombre_proveedor`, `direccion`, `telefono`, `correo`, `documento`, `verificacion_nit`) VALUES
(1, 'AA', 'Arturo Alarcón', 'Calle 33 #44', '432234234', 'aa@gmail.com', '33', '6'),
(15, 'Paraiso', 'Daniel Rodriguez', 'carrera 24 ', '32211123', 'daniel@gmail.com', '3133131312', ''),
(16, 'La canasta', 'David Cardozo', 'Carrera 23', '333222', 'david@gmail.com', '12345678965', '2'),
(21, 'Mercados alksoto', 'Jaime Vargas', 'carrera 6', '311231332', 'jaime@gmail.com', '123456789', '2'),
(22, 'Mercados JP', 'Juan Pérez', 'Carrera 16', '9999', 'jp@gmail.com', '144443', '2'),
(25, 'Frutas.com', 'Holman Jair Rincón', 'Calle 22 #33-22 Medellín', '3224442242', 'holmanfr@gmail.com', '777778989', '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteinventarios`
--

CREATE TABLE `reporteinventarios` (
  `id_rInventarios` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `noProductos` double NOT NULL,
  `total` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reporteinventarios`
--

INSERT INTO `reporteinventarios` (`id_rInventarios`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`) VALUES
(45, '2020-07-05', '2020-07-15', '2020-07-26', 0, 0),
(32, '2020-01-01', '2020-04-15', '2020-04-15', 0, 0),
(30, '2020-01-01', '2020-04-09', '2020-04-08', 0, 0),
(34, '2020-01-16', '2020-05-16', '2020-05-16', 0, 0),
(35, '2020-01-01', '2020-05-17', '2020-05-16', 0, 0),
(36, '2020-02-22', '2020-05-25', '2020-05-24', 0, 0),
(37, '2020-01-01', '2020-05-25', '2020-05-24', 0, 0),
(39, '2020-03-01', '2020-05-25', '2020-05-24', 0, 0),
(41, '2020-01-27', '2020-05-27', '2020-05-27', 0, 0),
(43, '2020-06-28', '2020-07-25', '2020-07-25', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteinventarios2`
--

CREATE TABLE `reporteinventarios2` (
  `id_rInventarios` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `noProductos` double NOT NULL,
  `total` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reporteinventarios2`
--

INSERT INTO `reporteinventarios2` (`id_rInventarios`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`) VALUES
(4, '2020-03-17', '2020-05-17', '2020-05-17', 0, 0),
(5, '2020-05-01', '2020-05-17', '2020-05-17', 0, 0),
(6, '2020-01-01', '2020-05-17', '2020-05-17', 0, 0),
(9, '2020-06-28', '2020-08-06', '2020-07-25', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportepc`
--

CREATE TABLE `reportepc` (
  `id_rpc` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepc`
--

INSERT INTO `reportepc` (`id_rpc`, `fechaInicial`, `fechaFinal`, `fechaActual`) VALUES
(1, '2019-01-01', '2020-06-07', '2020-06-07'),
(3, '2020-06-06', '2020-06-08', '2020-06-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportepc2`
--

CREATE TABLE `reportepc2` (
  `id_rpc` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepc2`
--

INSERT INTO `reportepc2` (`id_rpc`, `fechaInicial`, `fechaFinal`, `fechaActual`) VALUES
(1, '2020-01-01', '2020-06-07', '2020-06-06'),
(2, '2020-02-20', '2020-06-13', '2020-06-13'),
(5, '2020-06-12', '2020-06-13', '2020-06-13'),
(7, '2020-06-28', '2020-08-01', '2020-07-26'),
(8, '2020-06-28', '2020-07-25', '2020-07-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportepedidos`
--

CREATE TABLE `reportepedidos` (
  `id_rPedidos` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `noProductos` double NOT NULL,
  `total` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepedidos`
--

INSERT INTO `reportepedidos` (`id_rPedidos`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`) VALUES
(4, '2020-01-01', '2020-05-23', '2020-05-23', 0, 0),
(5, '2020-04-01', '2020-05-24', '2020-05-23', 0, 0),
(7, '2020-01-28', '2020-05-28', '2020-05-28', 0, 0),
(8, '2020-05-28', '2020-05-28', '2020-05-28', 0, 0),
(12, '2020-07-05', '2020-07-10', '2020-07-26', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportepedidos2`
--

CREATE TABLE `reportepedidos2` (
  `id_rPedidos` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `noProductos` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepedidos2`
--

INSERT INTO `reportepedidos2` (`id_rPedidos`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`) VALUES
(2, '2020-01-01', '2020-05-28', '2020-05-28', 0, 0),
(3, '2020-05-01', '2020-05-28', '2020-05-28', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteventas`
--

CREATE TABLE `reporteventas` (
  `id_rVentas` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `noProductos` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reporteventas`
--

INSERT INTO `reporteventas` (`id_rVentas`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`) VALUES
(15, '2019-01-01', '2019-12-31', '2020-02-09', 0, 0),
(16, '2019-01-01', '2019-12-31', '2020-02-09', 0, 0),
(19, '2019-01-01', '2020-04-01', '2020-04-02', 0, 0),
(21, '2019-03-01', '2020-06-05', '2020-06-04', 0, 0),
(22, '2020-06-20', '2020-06-21', '2020-06-21', 0, 0),
(23, '2020-06-28', '2020-07-17', '2020-07-26', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL,
  `nombre_sede` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `nombre_sede`, `ciudad`, `descripcion`, `direccion`, `telefono`) VALUES
(1, 'La canasta', 'Sogamoso', 'sede principal', '', 0),
(2, 'Paraiso', 'Duitama', 'Central', '', 0),
(3, 'Centro ara', 'Duitama', 'ara', '', 0),
(4, 'Magdalena paraiso', 'Sogamoso', '5', '', 0),
(5, 'Sogamoso Norte', 'Sogamoso', 'Central', 'Carrera 18', 3117788892),
(6, 'Supermercado la 11', 'Tunja', 'Mayorista', 'Carrera 11 ', 3213121321);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `disponibilidad` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `producto_dados_baja` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `disponibilidad`, `producto_id_producto`, `sede_id_sede`, `proveedor_id_proveedor`, `cantidad`, `fecha_registro`, `empleado_id_empleado`, `producto_dados_baja`, `fecha_vencimiento`) VALUES
(2, '1', 2, 3, 1, 24, '2020-01-01', 0, 0, '0000-00-00'),
(4, '0', 3, 2, 16, 12, '2020-01-22', 0, 0, '0000-00-00'),
(8, '1', 2, 1, 1, 9, '2020-02-11', 0, 0, '0000-00-00'),
(9, '1', 3, 2, 1, 14, '2020-03-02', 0, 0, '0000-00-00'),
(10, '1', 5, 1, 1, 0, '2020-04-29', 0, 0, '0000-00-00'),
(11, '1', 4, 1, 1, 0, '2020-05-01', 0, 0, '0000-00-00'),
(12, '1', 3, 1, 15, 72, '2020-05-06', 0, 0, '0000-00-00'),
(13, '1', 3, 1, 1, 9, '2020-04-03', 0, 0, '0000-00-00'),
(14, '1', 5, 1, 1, 10, '2020-04-25', 0, 0, '0000-00-00'),
(15, '1', 3, 3, 16, 1, NULL, 0, 0, '0000-00-00'),
(16, '1', 3, 4, 1, 1, NULL, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cargo`
--

CREATE TABLE `tipo_cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_cargo`
--

INSERT INTO `tipo_cargo` (`id_cargo`, `nombre`, `descripcion`, `fecha`) VALUES
(1, 'Gerente', 'gerencia', '2020/03/23'),
(2, 'cajero', 'caja', '2020/03/23'),
(3, 'Vendedor', 'vendedor', '2019/10/24'),
(4, 'patinador', 'patinador', '2019/10/24'),
(20, 'coordinador', 'ninguna', '2019/10/24'),
(23, 'Servicios Generales', 'Servicios', '2020/03/23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_tpago` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id_tpago`, `nombre`, `descripcion`) VALUES
(1, 'Efectivo', 'pago efectivo'),
(2, 'Datafono', 'pago electrÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â Ã'),
(3, 'Pasarela de pago', 'pasarale de pago'),
(4, 'Pago a cuotas', 'cartera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_sede`
--

CREATE TABLE `tipo_sede` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tp_aproveedor`
--

CREATE TABLE `tp_aproveedor` (
  `id_rproveedor` int(11) NOT NULL,
  `noproductos` int(11) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `pago_inicial` double NOT NULL,
  `porcentaje_venta` double NOT NULL,
  `pago_total` double NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `tipo_pago_id_tpago` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tp_aproveedor`
--

INSERT INTO `tp_aproveedor` (`id_rproveedor`, `noproductos`, `fecha_solicitud`, `fecha_entrega`, `pago_inicial`, `porcentaje_venta`, `pago_total`, `proveedor_id_proveedor`, `tipo_pago_id_tpago`, `empleado_id_empleado`) VALUES
(32, 8, '2020-04-04 00:00:00', '2020-04-04 00:00:00', 0, 0, 0, 16, 1, 2),
(37, 4, '2020-05-25 00:00:00', '2020-05-29 00:00:00', 0, 0, 12929.5, 15, 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_movimiento`
--

CREATE TABLE `t_movimiento` (
  `id_tmovimiento` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `t_movimiento`
--

INSERT INTO `t_movimiento` (`id_tmovimiento`, `descripcion`) VALUES
(1, 'Realizado'),
(2, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_p_cliente`
--

CREATE TABLE `t_p_cliente` (
  `id_remision` int(11) NOT NULL,
  `noproductos` int(11) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `pago_inicial` double NOT NULL,
  `porcentaje_venta` double NOT NULL,
  `pago_total` double NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `tipo_pago_id_tpago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `t_p_cliente`
--

INSERT INTO `t_p_cliente` (`id_remision`, `noproductos`, `fecha_solicitud`, `fecha_entrega`, `pago_inicial`, `porcentaje_venta`, `pago_total`, `cliente_id_cliente`, `empleado_id_empleado`, `tipo_pago_id_tpago`) VALUES
(74, 1, '2020-01-01 00:00:00', '2020-04-04 00:00:00', 0, 0, 0, 7, 2, 1),
(75, 1, '2020-02-08 00:00:00', '2020-04-04 00:00:00', 0, 0, 500, 7, 2, 1),
(76, 1, '2020-03-15 00:00:00', '2020-04-04 00:00:00', 0, 0, 250, 5, 2, 1),
(77, 2, '2020-04-07 00:00:00', '2020-04-08 00:00:00', 0, 0, 500, 5, 2, 1),
(78, 10, '2020-05-02 00:00:00', '2020-04-09 00:00:00', 0, 0, 9000, 5, 2, 1),
(81, 3, '2020-05-25 00:00:00', '2020-05-28 00:00:00', 0, 0, 28733, 7, 14, 1),
(82, 5, '2020-07-05 21:42:00', '2020-07-04 00:00:00', 0, 0, 20024.5, 1, 2, 1),
(83, 5, '2020-07-11 23:45:00', '2020-07-16 00:00:00', 0, 0, 21250.5, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_p_proveedor`
--

CREATE TABLE `t_p_proveedor` (
  `id_tpproveedor` int(11) NOT NULL,
  `noproductos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_cargo_id_cargo` int(11) DEFAULT NULL,
  `sede_id_sede` int(11) DEFAULT NULL,
  `superusuario` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `tipo_cargo_id_cargo`, `sede_id_sede`, `superusuario`) VALUES
(9, 'juan', 'juan@gmail.com', '$2y$10$MdSnZTIALoa1ZRG.8GUwfeljEf6UT0OA5pTFYaSyE3UV7c3iXRx3K', 'w0423Xuf2RIzy2r9lADOVW6L7WtWabfosxT3CF5ecVcWP5uiDZIuZSMOpmCF', '2019-11-06 11:38:48', '2020-09-09 22:15:09', 1, 1, 1),
(10, 'Holman', 'holman@gmail.com', '$2y$10$gvCFGDii3ApTQpdA/5ls5e/XdWDZnl0PSOWcco8/g6QIlRcgMb4PW', 'p2VQIyleDzdGCxQ3pq6WAMqJGqEr2cJi2k1bMArjL11dMZllckNuWih29pzE', '2019-11-06 13:02:24', '2020-05-18 20:12:44', 2, 3, 0),
(11, 'david', 'david@gmail.com', '$2y$10$jGfbqbDQW7YBJjSp/z60eOQ0RwO2Ve9pqitUW2HhvekjAQAug4ph6', 'Qmzh7ZC9WtZ9exZtFD72UiVHutdemAkzTASCgIN8fib7zEb9zAt3hW6igJ1a', '2019-11-09 06:15:10', '2019-11-09 06:21:27', 4, 3, 0),
(12, 'karem', 'karem@gmail.com', '$2y$10$eplCtdNOyH/f9Try1PbMEu3fqa608Z1gAeaQRF6JgGMbFxTGiaXBa', NULL, '2020-07-10 15:48:31', '2020-07-10 15:48:31', 1, 1, 0),
(13, 'nmnm', 'mananna@gmail.com', '$2y$10$fYp7H/flh7gC0hD.39hgDuZ2f2s39863pnIsSMx3/g5IX19AqpP7W', NULL, '2020-07-10 15:51:28', '2020-07-10 15:51:28', 1, 1, 0),
(14, 'walter', 'walter@gmail.com', '$2y$10$YdETvioLv0VB7nOkv9N7/Oba21LJUZPcYSU9l8pqozFBuPMmMrrSC', NULL, '2020-07-10 22:03:32', '2020-07-10 22:03:32', 1, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo_modulo`
--
ALTER TABLE `cargo_modulo`
  ADD PRIMARY KEY (`id_cargoModulo`),
  ADD KEY `id_modulo` (`id_modulo`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoria_stock_especiales`
--
ALTER TABLE `categoria_stock_especiales`
  ADD PRIMARY KEY (`id_categoriaStock`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `c_inventario`
--
ALTER TABLE `c_inventario`
  ADD PRIMARY KEY (`id_corte`),
  ADD KEY `c_inventario_p_tiempo_fk` (`p_tiempo_id_tiempo`),
  ADD KEY `c_inventario_sede_fk` (`sede_id_sede`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id_descuento`),
  ADD KEY `descuentos_sede_fk` (`sede_id_sede`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detallef`),
  ADD KEY `detalle_factura_descuentos_fk` (`descuentos_id_descuento`),
  ADD KEY `detalle_factura_factura_fk` (`factura_id_factura`),
  ADD KEY `detalle_factura_impuestos_fk` (`impuestos_id_impuestos`),
  ADD KEY `detalle_factura_producto_fk` (`producto_id_producto`);

--
-- Indices de la tabla `detalle_pagos`
--
ALTER TABLE `detalle_pagos`
  ADD PRIMARY KEY (`id_dpagos`),
  ADD KEY `empleado_id_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `tipo_pago_fk` (`tipo_pago`),
  ADD KEY `id_cuentas_fk` (`id_cuentas`);

--
-- Indices de la tabla `d_corte`
--
ALTER TABLE `d_corte`
  ADD PRIMARY KEY (`id_dcorte`),
  ADD KEY `d_corte_c_inventario_fk` (`c_inventario_id_corte`),
  ADD KEY `d_corte_producto_fk` (`producto_id_producto`);

--
-- Indices de la tabla `d_p_cliente`
--
ALTER TABLE `d_p_cliente`
  ADD PRIMARY KEY (`id_dpcliente`),
  ADD KEY `d_p_cliente_descuentos_fk` (`descuentos_id_descuento`),
  ADD KEY `d_p_cliente_impuestos_fk` (`impuestos_id_impuestos`),
  ADD KEY `d_p_cliente_producto_fk` (`producto_id_producto`),
  ADD KEY `d_p_cliente_t_p_cliente_fk` (`t_p_cliente_id_remision`);

--
-- Indices de la tabla `d_p_proveedor`
--
ALTER TABLE `d_p_proveedor`
  ADD PRIMARY KEY (`id_dpproveedor`),
  ADD KEY `d_p_proveedor_descuentos_fk` (`descuentos_id_descuento`),
  ADD KEY `d_p_proveedor_impuestos_fk` (`impuestos_id_impuestos`),
  ADD KEY `d_p_proveedor_producto_fk` (`producto_id_producto`),
  ADD KEY `d_p_proveedor_tp_aproveedor_fk` (`tp_aproveedor_id_rproveedor`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `empleado_sede_fk` (`sede_id_sede`),
  ADD KEY `empleado_tipo_cargo_fk` (`tipo_cargo_id_cargo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `factura_cliente_fk` (`cliente_id_cliente`),
  ADD KEY `factura_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `factura_tipo_pago_fk` (`tipo_pago_id_tpago`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id_impuestos`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `m_stock`
--
ALTER TABLE `m_stock`
  ADD PRIMARY KEY (`id_mstock`),
  ADD KEY `m_stock_sede_fk` (`sede_id_sede`),
  ADD KEY `m_stock_sede_fkv1` (`sede_id_sede2`),
  ADD KEY `m_stock_stock_fk` (`stock_id_stock`),
  ADD KEY `m_stock_t_movimiento_fk` (`t_movimiento_id_tmovimiento`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `producto_categoria_fk` (`categoria_id_categoria`),
  ADD KEY `producto_impuestos_fk` (`impuestos_id_impuestos`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `reporteinventarios`
--
ALTER TABLE `reporteinventarios`
  ADD PRIMARY KEY (`id_rInventarios`);

--
-- Indices de la tabla `reporteinventarios2`
--
ALTER TABLE `reporteinventarios2`
  ADD PRIMARY KEY (`id_rInventarios`);

--
-- Indices de la tabla `reportepc`
--
ALTER TABLE `reportepc`
  ADD PRIMARY KEY (`id_rpc`);

--
-- Indices de la tabla `reportepc2`
--
ALTER TABLE `reportepc2`
  ADD PRIMARY KEY (`id_rpc`);

--
-- Indices de la tabla `reportepedidos`
--
ALTER TABLE `reportepedidos`
  ADD PRIMARY KEY (`id_rPedidos`);

--
-- Indices de la tabla `reportepedidos2`
--
ALTER TABLE `reportepedidos2`
  ADD PRIMARY KEY (`id_rPedidos`);

--
-- Indices de la tabla `reporteventas`
--
ALTER TABLE `reporteventas`
  ADD PRIMARY KEY (`id_rVentas`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `stock_producto_fk` (`producto_id_producto`),
  ADD KEY `stock_proveedor_fk` (`proveedor_id_proveedor`),
  ADD KEY `stock_sede_fk` (`sede_id_sede`);

--
-- Indices de la tabla `tipo_cargo`
--
ALTER TABLE `tipo_cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_tpago`);

--
-- Indices de la tabla `tipo_sede`
--
ALTER TABLE `tipo_sede`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `tp_aproveedor`
--
ALTER TABLE `tp_aproveedor`
  ADD PRIMARY KEY (`id_rproveedor`),
  ADD KEY `tp_aproveedor_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `tp_aproveedor_proveedor_fk` (`proveedor_id_proveedor`),
  ADD KEY `tp_aproveedor_tipo_pago_fk` (`tipo_pago_id_tpago`);

--
-- Indices de la tabla `t_movimiento`
--
ALTER TABLE `t_movimiento`
  ADD PRIMARY KEY (`id_tmovimiento`);

--
-- Indices de la tabla `t_p_cliente`
--
ALTER TABLE `t_p_cliente`
  ADD PRIMARY KEY (`id_remision`),
  ADD KEY `t_p_cliente_cliente_fk` (`cliente_id_cliente`),
  ADD KEY `t_p_cliente_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `t_p_cliente_tipo_pago_fk` (`tipo_pago_id_tpago`);

--
-- Indices de la tabla `t_p_proveedor`
--
ALTER TABLE `t_p_proveedor`
  ADD PRIMARY KEY (`id_tpproveedor`),
  ADD KEY `t_p_proveedor_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `t_p_proveedor_proveedor_fk` (`proveedor_id_proveedor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `tipo_cargo_id_cargo` (`tipo_cargo_id_cargo`),
  ADD KEY `sede_id_sede` (`sede_id_sede`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo_modulo`
--
ALTER TABLE `cargo_modulo`
  MODIFY `id_cargoModulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_stock_especiales`
--
ALTER TABLE `categoria_stock_especiales`
  MODIFY `id_categoriaStock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `c_inventario`
--
ALTER TABLE `c_inventario`
  MODIFY `id_corte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id_descuento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detallef` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `detalle_pagos`
--
ALTER TABLE `detalle_pagos`
  MODIFY `id_dpagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `d_corte`
--
ALTER TABLE `d_corte`
  MODIFY `id_dcorte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `d_p_cliente`
--
ALTER TABLE `d_p_cliente`
  MODIFY `id_dpcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `d_p_proveedor`
--
ALTER TABLE `d_p_proveedor`
  MODIFY `id_dpproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id_impuestos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `m_stock`
--
ALTER TABLE `m_stock`
  MODIFY `id_mstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `reporteinventarios`
--
ALTER TABLE `reporteinventarios`
  MODIFY `id_rInventarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `reporteinventarios2`
--
ALTER TABLE `reporteinventarios2`
  MODIFY `id_rInventarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reportepc`
--
ALTER TABLE `reportepc`
  MODIFY `id_rpc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reportepc2`
--
ALTER TABLE `reportepc2`
  MODIFY `id_rpc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reportepedidos`
--
ALTER TABLE `reportepedidos`
  MODIFY `id_rPedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reportepedidos2`
--
ALTER TABLE `reportepedidos2`
  MODIFY `id_rPedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reporteventas`
--
ALTER TABLE `reporteventas`
  MODIFY `id_rVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipo_cargo`
--
ALTER TABLE `tipo_cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id_tpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_sede`
--
ALTER TABLE `tipo_sede`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tp_aproveedor`
--
ALTER TABLE `tp_aproveedor`
  MODIFY `id_rproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `t_movimiento`
--
ALTER TABLE `t_movimiento`
  MODIFY `id_tmovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_p_cliente`
--
ALTER TABLE `t_p_cliente`
  MODIFY `id_remision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `t_p_proveedor`
--
ALTER TABLE `t_p_proveedor`
  MODIFY `id_tpproveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargo_modulo`
--
ALTER TABLE `cargo_modulo`
  ADD CONSTRAINT `cargo_modulo_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`),
  ADD CONSTRAINT `cargo_modulo_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `tipo_cargo` (`id_cargo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
