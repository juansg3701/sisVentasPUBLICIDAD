-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-10-2020 a las 05:00:36
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nemkwLilG3`
--
CREATE DATABASE IF NOT EXISTS `nemkwLilG3` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `nemkwLilG3`;

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
(26, 1, 1),
(27, 1, 3),
(28, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera`
--

CREATE TABLE `cartera` (
  `id_cartera` int(11) NOT NULL,
  `cuotas_totales` int(11) NOT NULL,
  `cuotas_restantes` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` date NOT NULL,
  `atraso` tinyint(1) NOT NULL,
  `factura_id_factura` int(11) DEFAULT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cartera`
--

INSERT INTO `cartera` (`id_cartera`, `cuotas_totales`, `cuotas_restantes`, `cliente_id_cliente`, `empleado_id_empleado`, `total`, `fecha`, `atraso`, `factura_id_factura`, `sede_id_sede`) VALUES
(12, 12, 0, 7, 2, 0, '2019-12-18', 0, 43, 0),
(13, 12, 4, 5, 2, 10444, '2020-01-16', 0, 43, 0),
(14, 5, -1, 7, 2, 0, '2020-01-19', 0, 43, 0),
(15, 5, 4, 7, 2, 19766, '2019-12-19', 0, 43, 0),
(16, 5, 3, 7, 2, 0, '2019-12-18', 0, 43, 0),
(17, 3, 3, 5, 2, 22456, '2020-01-19', 0, 43, 0),
(18, 5, 5, 5, 2, 22456, '2020-03-03', 0, 43, 0),
(19, 5, 5, 5, 2, 11228, '2020-03-03', 0, 44, 0),
(23, 5, 2, 7, 2, 0, '2020-03-03', 0, 43, 0),
(31, 12, 12, 5, 2, 11228, '2020-03-05', 0, 44, 0),
(32, 4, 4, 5, 2, 11228, '2020-03-05', 0, 44, 0),
(33, 3, 3, 5, 2, 11228, '2020-03-05', 0, 44, 0),
(34, 3, 3, 5, 2, 11228, '2020-03-05', 0, 44, 0),
(35, 24, 24, 5, 2, 11228, '2020-03-05', 0, 44, 0),
(36, 1234567890, 1234567890, 5, 2, 11228, '2020-03-05', 0, 44, 0),
(37, 56, 56, 5, 2, 11228, '2020-03-05', 0, 44, 0),
(38, 2, 1, 5, 2, 87456, '2020-03-07', 0, 56, 0),
(40, 4, 2, 5, 2, 8, '2020-03-08', 0, 64, 0),
(41, 2, 0, 5, 2, 0, '2020-03-13', 0, 82, 0),
(42, 2, 0, 5, 2, 0, '2020-03-13', 0, 83, 0),
(43, 2, 0, 5, 2, 0, '2020-03-13', 0, 84, 0),
(44, 2, 0, 5, 2, 0, '2020-03-13', 0, 85, 0),
(45, 2, 0, 5, 2, 0, '2020-03-13', 0, 86, 0),
(46, 2, 0, 5, 2, 0, '2020-03-13', 0, 87, 0),
(47, 2, 0, 5, 2, 0, '2020-03-13', 0, 88, 0),
(48, 2, 0, 5, 2, 0, '2020-03-14', 0, 89, 0),
(49, 2, 0, 5, 2, 0, '2020-03-14', 0, 90, 0),
(50, 2, 1, 5, 2, 100, '2020-03-15', 1, 91, 0),
(51, 2, 0, 5, 2, 0, '2020-03-15', 0, 94, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `empleado_id_empleado`, `sede_id_sede`, `fecha`) VALUES
(1, 'Alimentos', 'verduras', 1, 1, '2020-10-01'),
(2, 'Ropa', 'Deportiva', 29, 2, '2020-05-03'),
(3, 'Accesorios', 'ropa', 1, 1, '2020-08-12'),
(5, 'Calzado', 'Infantil', 1, 1, '2020-10-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_stock_especiales`
--

CREATE TABLE `categoria_stock_especiales` (
  `id_categoriaStock` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria_stock_especiales`
--

INSERT INTO `categoria_stock_especiales` (`id_categoriaStock`, `nombre`, `descripcion`, `sede_id_sede`, `empleado_id_empleado`, `fecha`) VALUES
(1, 'Halloween', '31 octubre', 1, 1, '2020-10-24'),
(2, 'Navidad', '25 diciembre', 1, 1, '2020-10-24'),
(3, 'Día del niñoeeeefff', 'aaaaaaeeeffff', 1, 1, '2020-10-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `verificacion_nit` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_empresa` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cartera_activa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user_id_user` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `direccion`, `telefono`, `correo`, `documento`, `verificacion_nit`, `nombre_empresa`, `cartera_activa`, `user_id_user`, `empleado_id_empleado`, `fecha`) VALUES
(1, 'e', 'e', '4', 'e@gmail.com', '55', '22', 'a', '1', 0, 0, '0000-00-00'),
(5, 'Andres', '', '312289734527', 'Andres@gmail.com', '3', '', '', '1', 0, 0, '0000-00-00'),
(7, 'holman', 'calle 12', '12314', 'h@gmail.com', '2131234', '123', 'canasta', '1', 0, 0, '0000-00-00'),
(23, 'Diana Torres', 'Avenida 24', '3223332212', 'dt@gmail.com', '487654321', '7', NULL, '0', 0, 0, '0000-00-00'),
(24, 'Gabriel Suarez', 'Carrera 23', '1312321132', 'daniel@gmail.com', '1312312132', '7', NULL, '0', 0, 0, '0000-00-00'),
(25, 'Holman Rincon', 'Carrera 45', '2331212132', 'holman@gmail.com', '3223223322', '8', NULL, '0', 0, 0, '0000-00-00'),
(26, 'Carlos Camargo', 'Calle 11', '12131321', 'carlos@hotmail.com', '32233232', '8', NULL, '0', 0, 0, '0000-00-00'),
(27, 'Juan Sanchez', 'calle 22', '13212321', 'h@gmail.com', '2132133123', '9', NULL, '0', 0, 0, '0000-00-00'),
(28, 'b', 'b', '1', 'b@gmail.com', '22', '', NULL, '0', 0, 0, '0000-00-00'),
(29, 'c', 'c', '1', 'c@gmail.com', '123', '6', NULL, '0', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_inventario`
--

CREATE TABLE `c_inventario` (
  `id_corte` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `noproductos` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor_total` double DEFAULT NULL,
  `p_tiempo_id_tiempo` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `c_inventario`
--

INSERT INTO `c_inventario` (`id_corte`, `fecha`, `noproductos`, `valor_total`, `p_tiempo_id_tiempo`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(101, '2019-11-05 00:00:00', NULL, NULL, 1, 1, 0),
(102, '2019-11-05 00:00:00', NULL, NULL, 1, 1, 0),
(103, '2019-11-05 00:00:00', NULL, NULL, 1, 2, 0),
(104, '2019-11-05 00:00:00', NULL, NULL, 1, 1, 0),
(105, '2019-11-18 00:00:00', NULL, NULL, 1, 1, 0),
(106, '2019-11-18 00:00:00', NULL, NULL, 1, 1, 0),
(107, '2019-11-19 00:00:00', NULL, NULL, 1, 1, 0),
(108, '2019-11-19 00:00:00', NULL, NULL, 1, 1, 0),
(109, '2019-11-19 00:00:00', NULL, NULL, 1, 1, 0),
(110, '2019-11-19 00:00:00', NULL, NULL, 1, 1, 0),
(111, '2019-11-19 00:00:00', NULL, NULL, 1, 1, 0),
(112, '2019-11-19 00:00:00', NULL, NULL, 1, 1, 0),
(113, '2019-11-19 00:00:00', NULL, NULL, 1, 4, 0),
(114, '2019-11-20 00:00:00', NULL, NULL, 1, 1, 0),
(115, '2019-11-20 00:00:00', NULL, NULL, 1, 1, 0),
(116, '2019-11-20 00:00:00', NULL, NULL, 1, 1, 0),
(117, '2019-11-20 00:00:00', NULL, NULL, 1, 1, 0),
(118, '2019-11-20 00:00:00', NULL, NULL, 1, 1, 0),
(119, '2019-11-20 00:00:00', NULL, NULL, 1, 1, 0),
(120, '2020-07-05 21:43:21', NULL, NULL, 1, 1, 0),
(121, '2020-07-13 23:13:39', NULL, NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cartera`
--

CREATE TABLE `detalle_cartera` (
  `id_dCartera` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor_abono` double NOT NULL,
  `valor_total` double NOT NULL,
  `valor_restante` double NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `id_cartera` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_cartera`
--

INSERT INTO `detalle_cartera` (`id_dCartera`, `fecha`, `valor_abono`, `valor_total`, `valor_restante`, `empleado_id_empleado`, `tipo_pago`, `id_cartera`, `sede_id_sede`) VALUES
(56, '2019-12-18', 12, 0, 0, 2, 1, 12, 0),
(57, '2019-12-19', 12, 0, 0, 2, 1, 12, 0),
(58, '2020-01-19', 233, 11039, 10806, 2, 1, 13, 0),
(59, '2020-01-19', 1223, 0, 0, 2, 1, 12, 0),
(60, '2020-01-19', 23, 0, 0, 2, 1, 12, 0),
(62, '2020-01-19', 5000, 20000, 15000, 2, 1, 16, 0),
(63, '2020-03-03', 234, 20000, 19766, 2, 1, 15, 0),
(64, '2020-03-03', 10000, 20000, 10000, 2, 1, 14, 0),
(65, '2020-03-03', 10000, 20000, 0, 2, 1, 14, 0),
(66, '2020-03-03', 1, 20000, 0, 2, 1, 14, 0),
(67, '2020-03-03', 1, 20000, 0, 2, 1, 14, 0),
(68, '2020-03-04', 15000, 20000, 0, 2, 1, 16, 0),
(69, '2020-03-05', 1, 2, 1, 2, 1, 23, 0),
(70, '2020-03-05', 123, 2, 0, 2, 1, 23, 0),
(71, '2020-03-05', 123, 2, 0, 2, 1, 23, 0),
(72, '2020-03-07', 12, 87468, 87456, 2, 1, 38, 0),
(74, '2020-03-08', 5, 23, 18, 2, 1, 40, 0),
(75, '2020-03-08', 10, 23, 8, 2, 1, 40, 0),
(76, '2020-03-10', 123, 11039, 10683, 2, 1, 13, 0),
(77, '2020-03-10', 98, 11039, 10585, 2, 1, 13, 0),
(78, '2020-03-10', 76, 11039, 10509, 2, 2, 13, 0),
(79, '2020-03-10', 65, 11039, 10444, 2, 3, 13, 0),
(80, '2020-03-13', 100, 200, 100, 2, 1, 41, 0),
(81, '2020-03-13', 100, 200, 0, 2, 1, 41, 0),
(82, '2020-03-13', 100, 200, 100, 2, 1, 42, 0),
(83, '2020-03-13', 100, 200, 0, 2, 1, 42, 0),
(84, '2020-03-13', 100, 200, 0, 2, 1, 43, 0),
(85, '2020-03-13', 100, 200, 100, 2, 1, 44, 0),
(86, '2020-03-13', 100, 200, 0, 2, 1, 44, 0),
(87, '2020-03-13', 100, 200, 100, 2, 1, 45, 0),
(88, '2020-03-13', 100, 200, 0, 2, 1, 45, 0),
(89, '2020-03-13', 100, 200, 100, 2, 1, 46, 0),
(90, '2020-03-13', 100, 200, 0, 2, 1, 46, 0),
(91, '2020-03-13', 100, 200, 100, 2, 1, 47, 0),
(92, '2020-03-13', 100, 200, 0, 2, 1, 47, 0),
(93, '2020-03-14', 100, 200, 100, 2, 1, 48, 0),
(94, '2020-03-14', 100, 200, 0, 2, 1, 48, 0),
(95, '2020-03-14', 100, 200, 100, 2, 1, 49, 0),
(96, '2020-03-14', 100, 200, 0, 2, 1, 49, 0),
(97, '2020-03-15', 500, 10000, 9500, 2, 1, 51, 0),
(98, '2020-03-15', 9500, 10000, 0, 2, 2, 51, 0),
(99, '2020-08-27', 100, 200, 100, 28, 1, 50, 0);

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
  `total` double DEFAULT NULL,
  `total_impuesto` double NOT NULL,
  `total_descuento` double NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detallef`, `cantidad`, `precio_venta`, `factura_id_factura`, `producto_id_producto`, `total`, `total_impuesto`, `total_descuento`, `empleado_id_empleado`, `sede_id_sede`, `fecha`) VALUES
(47, 3, 22456, 26, 12, 33684, 0, 0, 0, 0, '0000-00-00'),
(48, 1, 34987, 26, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(49, 1, 22456, 27, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(50, 1, 22456, 28, 12, 22456, 0, 0, 0, 0, '0000-00-00'),
(51, 1, 22456, 29, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(52, 1, 22456, 30, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(53, 2, 34987, 31, 11, 34987, 0, 0, 0, 0, '0000-00-00'),
(54, 5, 34987, 31, 11, 174935, 0, 0, 0, 0, '0000-00-00'),
(55, 1, 22456, 33, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(56, 2, 22456, 34, 12, 22456, 0, 0, 0, 0, '0000-00-00'),
(57, 1, 22456, 35, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(58, 1, 22456, 36, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(59, 2, 22456, 32, 12, 22456, 0, 0, 0, 0, '0000-00-00'),
(60, 2, 34987, 32, 11, 34987, 0, 0, 0, 0, '0000-00-00'),
(61, 1, 22456, 38, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(62, 1, 22456, 39, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(63, 1, 22456, 40, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(64, 1, 22456, 41, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(65, 2, 22456, 43, 12, 22456, 0, 0, 0, 0, '0000-00-00'),
(66, 1, 22456, 44, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(67, 1, 34987, 46, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(68, 1, 22456, 46, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(69, 1, 22456, 46, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(70, 1, 34987, 37, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(71, 1, 34987, 48, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(72, 1, 34987, 49, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(73, 1, 34987, 50, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(74, 1, 34987, 51, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(75, 1, 34987, 52, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(76, 1, 34987, 53, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(77, 1, 34987, 53, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(78, 1, 23, 54, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(79, 1, 34987, 55, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(80, 5, 34987, 56, 11, 87468, 0, 0, 0, 0, '0000-00-00'),
(81, 5, 34987, 57, 11, 87468, 0, 0, 0, 0, '0000-00-00'),
(82, 4, 34987, 59, 11, 69974, 0, 0, 0, 0, '0000-00-00'),
(83, 1, 230000, 60, 8, 115000, 0, 0, 0, 0, '0000-00-00'),
(84, 1, 230000, 61, 8, 115000, 0, 0, 0, 0, '0000-00-00'),
(85, 1, 23, 62, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(86, 1, 34987, 62, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(87, 1, 23, 62, 8, 16, 0, 0, 0, 0, '0000-00-00'),
(88, 1, 23, 63, 8, 23, 0, 0, 0, 0, '0000-00-00'),
(89, 1, 23, 64, 8, 23, 0, 0, 0, 0, '0000-00-00'),
(90, 1, 23, 65, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(91, 1, 230000, 65, 8, 115000, 0, 0, 0, 0, '0000-00-00'),
(92, 1, 23, 69, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(93, 1, 1, 70, 8, 1, 0, 0, 0, 0, '0000-00-00'),
(94, 1, 4, 70, 8, 4, 0, 0, 0, 0, '0000-00-00'),
(95, 1, 22456, 70, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(96, 1, 23, 70, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(97, 2, 22456, 70, 12, 22456, 0, 0, 0, 0, '0000-00-00'),
(98, 2, 23, 70, 8, 23, 0, 0, 0, 0, '0000-00-00'),
(99, 23, 22456, 70, 12, 258244, 0, 0, 0, 0, '0000-00-00'),
(100, 20, 22456, 67, 12, 224560, 0, 0, 0, 0, '0000-00-00'),
(101, 24, 23, 67, 8, 276, 0, 0, 0, 0, '0000-00-00'),
(102, 1, 22456, 66, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(103, 1, 20000, 70, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(104, 10, 20000, 71, 10, 100000, 0, 0, 0, 0, '0000-00-00'),
(105, 1, 22456, 72, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(106, 5, 20000, 72, 10, 50000, 0, 0, 0, 0, '0000-00-00'),
(107, 5, 20000, 73, 10, 50000, 0, 0, 0, 0, '0000-00-00'),
(108, 1, 22456, 73, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(109, 1, 22456, 73, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(110, 1, 22456, 74, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(111, 1, 22456, 75, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(112, 1, 22456, 76, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(113, 1, 22456, 78, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(114, 1, 22456, 79, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(115, 1, 22456, 80, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(116, 1, 22456, 81, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(117, 1, 22456, 82, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(118, 1, 22456, 83, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(119, 1, 22456, 84, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(120, 1, 22456, 85, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(121, 1, 22456, 86, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(122, 1, 22456, 87, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(123, 1, 22456, 88, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(124, 1, 22456, 89, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(125, 1, 22456, 90, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(126, 1, 22456, 91, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(127, 1, 22456, 92, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(128, 1, 20000, 92, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(129, 1, 20000, 93, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(130, 1, 20000, 94, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(131, 1, 20000, 95, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(132, 1, 34987, 97, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(133, 1, 22456, 98, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(134, 1, 22456, 99, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(135, 8, 20000, 99, 10, 80000, 0, 0, 0, 0, '0000-00-00'),
(136, 1, 22456, 100, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(137, 8, 20000, 100, 10, 80000, 0, 0, 0, 0, '0000-00-00'),
(138, 1, 22456, 101, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(139, 8, 20000, 101, 10, 80000, 0, 0, 0, 0, '0000-00-00'),
(140, 1, 22456, 102, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(141, 8, 20000, 102, 10, 80000, 0, 0, 0, 0, '0000-00-00'),
(145, 1, 22456, 104, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(146, 8, 20000, 104, 10, 80000, 0, 0, 0, 0, '0000-00-00'),
(147, 1, 22456, 105, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(148, 1, 20000, 105, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(150, 7, 20000, 105, 10, 70000, 0, 0, 0, 0, '0000-00-00'),
(153, 1, 22456, 106, 12, 11228, 0, 0, 0, 0, '0000-00-00'),
(154, 1, 20000, 107, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(155, 1, 20000, 202, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(156, 1, 20000, 203, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(157, 1, 20000, 204, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(158, 1, 2000, 205, 12, 2000, 0, 0, 0, 0, '0000-00-00'),
(159, 1, 22456, 206, 13, 11228, 0, 0, 0, 0, '0000-00-00'),
(160, 1, 34987, 206, 11, 17494, 0, 0, 0, 0, '0000-00-00'),
(161, 1, 23, 206, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(162, 1, 23, 206, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(163, 1, 20000, 206, 14, 10000, 0, 0, 0, 0, '0000-00-00'),
(164, 1, 23, 206, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(165, 1, 20000, 206, 10, 10000, 0, 0, 0, 0, '0000-00-00'),
(166, 1, 23, 207, 8, 12, 0, 0, 0, 0, '0000-00-00'),
(167, 1, 23, 209, 8, 12, 0, 0, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_corte`
--

CREATE TABLE `d_corte` (
  `id_dcorte` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `c_inventario_id_corte` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `producto_id_producto` int(11) DEFAULT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `d_corte`
--

INSERT INTO `d_corte` (`id_dcorte`, `cantidad`, `c_inventario_id_corte`, `fecha`, `producto_id_producto`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(22, 1, 101, '2019-11-05 00:00:00', 5, 0, 0),
(23, 1, 101, '2019-11-05 00:00:00', 3, 0, 0),
(24, 5, 102, '2019-11-05 00:00:00', 2, 0, 0),
(25, 1, 102, '2019-11-05 00:00:00', 5, 0, 0),
(26, 4, 103, '2019-11-05 00:00:00', 2, 0, 0),
(27, 1, 119, '2019-11-20 00:00:00', 3, 0, 0),
(28, 1, 120, '2020-07-05 21:43:49', 2, 0, 0),
(29, 1, 120, '2020-07-13 23:12:53', 2, 0, 0),
(30, 1, 120, '2020-07-13 23:13:16', 5, 0, 0),
(31, 1, 121, '2020-07-13 23:13:53', 3, 0, 0),
(32, 4, 121, '2020-07-23 23:12:05', 3, 0, 0);

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
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `d_p_cliente`
--

INSERT INTO `d_p_cliente` (`id_dpcliente`, `cantidad`, `precio_venta`, `total`, `t_p_cliente_id_remision`, `producto_id_producto`, `empleado_id_empleado`, `sede_id_sede`, `fecha`) VALUES
(80, 1, 1000, 500, 75, 8, 0, 0, '0000-00-00'),
(81, 1, 500, 250, 76, 8, 0, 0, '0000-00-00'),
(82, 2, 500, 500, 77, 8, 0, 0, '0000-00-00'),
(83, 10, 1000, 10000, 78, 8, 0, 0, '0000-00-00'),
(85, 1, 22456, 11228, 81, 12, 0, 0, '0000-00-00'),
(86, 1, 34987, 17493.5, 81, 11, 0, 0, '0000-00-00'),
(87, 1, 23, 11.5, 81, 8, 0, 0, '0000-00-00'),
(88, 1, 23, 11.5, 82, 8, 0, 0, '0000-00-00'),
(89, 1, 20000, 10000, 82, 10, 0, 0, '0000-00-00'),
(90, 1, 23, 11.5, 82, 8, 0, 0, '0000-00-00'),
(91, 1, 23, 11.5, 82, 8, 0, 0, '0000-00-00'),
(92, 1, 20000, 10000, 82, 10, 0, 0, '0000-00-00'),
(93, 1, 23, 11.5, 83, 8, 0, 0, '0000-00-00'),
(94, 1, 22456, 11228, 83, 13, 0, 0, '0000-00-00'),
(95, 1, 23, 11.5, 83, 8, 0, 0, '0000-00-00'),
(96, 1, 23, 11.5, 83, 8, 0, 0, '0000-00-00'),
(97, 1, 20000, 10000, 83, 14, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_p_proveedor`
--

CREATE TABLE `d_p_proveedor` (
  `id_dpproveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `total` double DEFAULT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `tp_aproveedor_id_rproveedor` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `d_p_proveedor`
--

INSERT INTO `d_p_proveedor` (`id_dpproveedor`, `cantidad`, `precio_venta`, `total`, `producto_id_producto`, `tp_aproveedor_id_rproveedor`, `empleado_id_empleado`, `sede_id_sede`, `fecha`) VALUES
(1, 1, 1000, 500, 12, 37, 0, 0, 0),
(2, 1, 1000, 1190, 11, 37, 0, 0, 0),
(3, 1, 23, 11.5, 8, 37, 0, 0, 0),
(4, 1, 22456, 11228, 13, 37, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_cargo_id_cargo` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `telefono` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user_id_user` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `documento` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `correo`, `tipo_cargo_id_cargo`, `sede_id_sede`, `telefono`, `direccion`, `codigo`, `user_id_user`, `fecha`, `documento`) VALUES
(1, 'juan12', 'juan@gmail.com', 1, 1, '31289362', 'calle 12', '193648', 9, '2020-10-01', ''),
(29, 'Juliana12', 'jualiana@gmail.com', 1, 2, '131231', 'calle 12', '089231980', 20, '2020-10-18', '1231234');

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
  `tiendaodomicilio` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre`) VALUES
(1, 'Permisos'),
(2, 'Cuentas'),
(3, 'Proveedores'),
(4, 'Devoluciones'),
(5, 'Sedes'),
(6, 'Inventario'),
(7, 'Pedidos'),
(8, 'Reportes');

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
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`) VALUES
('juangomez3701@gmail.com', '8b1015d1cf4b43e5045f80ee16d599781dbb7f78111840bd8c06c77b11441972');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `plu` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ean` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `stock_minimo` double NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `imagen` varchar(2000) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria_id_categoria` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `plu`, `ean`, `nombre`, `precio`, `stock_minimo`, `fecha_registro`, `imagen`, `categoria_id_categoria`, `empleado_id_empleado`, `sede_id_sede`) VALUES
(2, '1562', '271', 'Coliflor', 23, 4, '2020-01-01', '', 1, 1, 1),
(3, '234', '123', 'Manzana', 22456, 100, '2020-01-01', '', 1, 1, 1),
(4, '5674', '234', 'Pera', 34987, 2, '2020-01-01', '', 1, 1, 1),
(5, '1234', '124', 'maracuya', 20000, 3, '2020-01-01', '', 3, 1, 1),
(6, '12333', '1290', 'plato 1', 1000000, 11, '2020-02-01', '', 1, 1, 1),
(7, '1', '1', 'a', 1, 2, '2020-03-01', '1.jpeg', 1, 1, 1),
(8, '788', '99', 'qq', 123, 1, NULL, '3.2.jpeg', 1, 1, 1),
(9, '1722', '7829', 'Piña', 1500, 80, NULL, 'manzana2.png', 1, 1, 1),
(16, '6738388', '3223553', 'Mora', 200, 200, '2020-10-23', 'pendon.jpg', 1, 1, 1),
(17, '2334532', '532322', 'Limón', 33323, 2332, '2020-10-23', 'Pizza.png', 1, 1, 1),
(18, '777766', '6667886', 'Sandía', 12221, 213321, '2020-10-23', NULL, 1, 29, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_empresa` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_proveedor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `verificacion_nit` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_empresa`, `nombre_proveedor`, `direccion`, `telefono`, `correo`, `documento`, `verificacion_nit`, `empleado_id_empleado`, `fecha`) VALUES
(1, 'AA', 'Arturo Alarcón', 'Calle 33 #44', '432234234', 'aa@gmail.com', '33', '6', 0, '0000-00-00'),
(15, 'Paraiso', 'Daniel Rodriguez', 'carrera 24 ', '32211123', 'daniel@gmail.com', '3133131312', '', 0, '0000-00-00'),
(16, 'La canasta', 'David Cardozo', 'Carrera 23', '333222', 'david@gmail.com', '12345678965', '2', 0, '0000-00-00'),
(21, 'Mercados alksoto', 'Jaime Vargas', 'carrera 6', '311231332', 'jaime@gmail.com', '123456789', '2', 0, '0000-00-00'),
(22, 'Mercados JP', 'Juan Pérez', 'Carrera 16', '9999', 'jp@gmail.com', '144443', '2', 0, '0000-00-00'),
(25, 'Frutas.com', 'Holman Jair Rincón', 'Calle 22 #33-22 Medellín', '3224442242', 'holmanfr@gmail.com', '777778989', '7', 0, '0000-00-00');

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
  `total` double NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reporteinventarios`
--

INSERT INTO `reporteinventarios` (`id_rInventarios`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(45, '2020-07-05', '2020-07-15', '2020-07-26', 0, 0, 0, 0),
(32, '2020-01-01', '2020-04-15', '2020-04-15', 0, 0, 0, 0),
(30, '2020-01-01', '2020-04-09', '2020-04-08', 0, 0, 0, 0),
(34, '2020-01-16', '2020-05-16', '2020-05-16', 0, 0, 0, 0),
(35, '2020-01-01', '2020-05-17', '2020-05-16', 0, 0, 0, 0),
(36, '2020-02-22', '2020-05-25', '2020-05-24', 0, 0, 0, 0),
(37, '2020-01-01', '2020-05-25', '2020-05-24', 0, 0, 0, 0),
(39, '2020-03-01', '2020-05-25', '2020-05-24', 0, 0, 0, 0),
(41, '2020-01-27', '2020-05-27', '2020-05-27', 0, 0, 0, 0),
(43, '2020-06-28', '2020-07-25', '2020-07-25', 0, 0, 0, 0);

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
  `total` double NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reporteinventarios2`
--

INSERT INTO `reporteinventarios2` (`id_rInventarios`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(4, '2020-03-17', '2020-05-17', '2020-05-17', 0, 0, 0, 0),
(5, '2020-05-01', '2020-05-17', '2020-05-17', 0, 0, 0, 0),
(6, '2020-01-01', '2020-05-17', '2020-05-17', 0, 0, 0, 0),
(9, '2020-06-28', '2020-08-06', '2020-07-25', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportepc`
--

CREATE TABLE `reportepc` (
  `id_rpc` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepc`
--

INSERT INTO `reportepc` (`id_rpc`, `fechaInicial`, `fechaFinal`, `fechaActual`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(1, '2019-01-01', '2020-06-07', '2020-06-07', 0, 0),
(3, '2020-06-06', '2020-06-08', '2020-06-08', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportepc2`
--

CREATE TABLE `reportepc2` (
  `id_rpc` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepc2`
--

INSERT INTO `reportepc2` (`id_rpc`, `fechaInicial`, `fechaFinal`, `fechaActual`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(1, '2020-01-01', '2020-06-07', '2020-06-06', 0, 0),
(2, '2020-02-20', '2020-06-13', '2020-06-13', 0, 0),
(5, '2020-06-12', '2020-06-13', '2020-06-13', 0, 0),
(7, '2020-06-28', '2020-08-01', '2020-07-26', 0, 0),
(8, '2020-06-28', '2020-07-25', '2020-07-26', 0, 0);

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
  `total` double NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepedidos`
--

INSERT INTO `reportepedidos` (`id_rPedidos`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(4, '2020-01-01', '2020-05-23', '2020-05-23', 0, 0, 0, 0),
(5, '2020-04-01', '2020-05-24', '2020-05-23', 0, 0, 0, 0),
(7, '2020-01-28', '2020-05-28', '2020-05-28', 0, 0, 0, 0),
(8, '2020-05-28', '2020-05-28', '2020-05-28', 0, 0, 0, 0),
(12, '2020-07-05', '2020-07-10', '2020-07-26', 0, 0, 0, 0);

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
  `total` double NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportepedidos2`
--

INSERT INTO `reportepedidos2` (`id_rPedidos`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(2, '2020-01-01', '2020-05-28', '2020-05-28', 0, 0, 0, 0),
(3, '2020-05-01', '2020-05-28', '2020-05-28', 0, 0, 0, 0);

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
  `total` double NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reporteventas`
--

INSERT INTO `reporteventas` (`id_rVentas`, `fechaInicial`, `fechaFinal`, `fechaActual`, `noProductos`, `total`, `sede_id_sede`, `empleado_id_empleado`) VALUES
(15, '2019-01-01', '2019-12-31', '2020-02-09', 0, 0, 0, 0),
(16, '2019-01-01', '2019-12-31', '2020-02-09', 0, 0, 0, 0),
(19, '2019-01-01', '2020-04-01', '2020-04-02', 0, 0, 0, 0),
(21, '2019-03-01', '2020-06-05', '2020-06-04', 0, 0, 0, 0),
(22, '2020-06-20', '2020-06-21', '2020-06-21', 0, 0, 0, 0),
(23, '2020-06-28', '2020-07-17', '2020-07-26', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL,
  `nombre_sede` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` bigint(15) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `nombre_sede`, `ciudad`, `descripcion`, `direccion`, `telefono`, `empleado_id_empleado`, `fecha`) VALUES
(1, 'La canasta', 'Sogamoso', 'sede principal', '', 0, 0, '0000-00-00'),
(2, 'Paraiso', 'Duitama', 'Central', '', 0, 0, '0000-00-00'),
(3, 'Centro ara', 'Duitama', 'ara', '', 0, 0, '0000-00-00'),
(4, 'Magdalena paraiso', 'Sogamoso', '5', '', 0, 0, '0000-00-00'),
(5, 'Sogamoso Norte', 'Sogamoso', 'Central', 'Carrera 18', 3117788892, 0, '0000-00-00'),
(6, 'Supermercado la 11', 'Tunja', 'Mayorista', 'Carrera 11 ', 3213121321, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `disponibilidad` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
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
(2, '1', 2, 3, 1, 24, '2020-01-01', 1, 0, '0000-00-00'),
(4, '0', 3, 2, 16, 12, '2020-01-22', 1, 0, '0000-00-00'),
(8, '1', 2, 1, 1, 9, '2020-02-11', 1, 0, '0000-00-00'),
(9, '1', 3, 2, 1, 14, '2020-03-02', 1, 0, '0000-00-00'),
(10, NULL, 5, 1, 1, 0, NULL, 1, 0, '2020-10-24'),
(11, '1', 4, 1, 1, 0, '2020-05-01', 1, 0, '0000-00-00'),
(12, '1', 3, 1, 15, 72, '2020-05-06', 1, 0, '0000-00-00'),
(13, '1', 3, 1, 1, 9, '2020-04-03', 1, 0, '0000-00-00'),
(14, NULL, 5, 1, 1, 10, '2020-10-23', 29, 1, '2020-10-18'),
(15, '1', 3, 3, 16, 1, NULL, 29, 0, '0000-00-00'),
(16, '1', 3, 4, 1, 1, NULL, 1, 0, '2020-10-20'),
(17, '1', 2, 1, 1, 2, NULL, 1, 1, '2020-10-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cargo`
--

CREATE TABLE `tipo_cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_cargo`
--

INSERT INTO `tipo_cargo` (`id_cargo`, `nombre`, `descripcion`, `fecha`, `empleado_id_empleado`) VALUES
(1, 'Gerente', 'gerencia', '2020/03/23', 9),
(2, 'cajero', 'caja', '2020/03/23', 9),
(3, 'Vendedor', 'vendedor', '2019/10/24', 9),
(4, 'patinador', 'patinador', '2019/10/24', 9),
(27, 'Prueba', 'Prueba', '2020/10/18', 9),
(29, 'subgerente', '---', '2020/10/18', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_tpago` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
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
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
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
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tp_aproveedor`
--

INSERT INTO `tp_aproveedor` (`id_rproveedor`, `noproductos`, `fecha_solicitud`, `fecha_entrega`, `pago_inicial`, `porcentaje_venta`, `pago_total`, `proveedor_id_proveedor`, `tipo_pago_id_tpago`, `empleado_id_empleado`, `sede_id_sede`) VALUES
(32, 8, '2020-04-04 00:00:00', '2020-04-04 00:00:00', 0, 0, 0, 16, 1, 2, 0),
(37, 4, '2020-05-25 00:00:00', '2020-05-29 00:00:00', 0, 0, 12929.5, 15, 1, 15, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_movimiento`
--

CREATE TABLE `t_movimiento` (
  `id_tmovimiento` int(11) NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
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
  `tipo_pago_id_tpago` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `t_p_cliente`
--

INSERT INTO `t_p_cliente` (`id_remision`, `noproductos`, `fecha_solicitud`, `fecha_entrega`, `pago_inicial`, `porcentaje_venta`, `pago_total`, `cliente_id_cliente`, `empleado_id_empleado`, `tipo_pago_id_tpago`, `sede_id_sede`) VALUES
(74, 1, '2020-01-01 00:00:00', '2020-04-04 00:00:00', 0, 0, 0, 7, 2, 1, 0),
(75, 1, '2020-02-08 00:00:00', '2020-04-04 00:00:00', 0, 0, 500, 7, 2, 1, 0),
(76, 1, '2020-03-15 00:00:00', '2020-04-04 00:00:00', 0, 0, 250, 5, 2, 1, 0),
(77, 2, '2020-04-07 00:00:00', '2020-04-08 00:00:00', 0, 0, 500, 5, 2, 1, 0),
(78, 10, '2020-05-02 00:00:00', '2020-04-09 00:00:00', 0, 0, 9000, 5, 2, 1, 0),
(81, 3, '2020-05-25 00:00:00', '2020-05-28 00:00:00', 0, 0, 28733, 7, 14, 1, 0),
(82, 5, '2020-07-05 21:42:00', '2020-07-04 00:00:00', 0, 0, 20024.5, 1, 2, 1, 0),
(83, 5, '2020-07-11 23:45:00', '2020-07-16 00:00:00', 0, 0, 21250.5, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_p_proveedor`
--

CREATE TABLE `t_p_proveedor` (
  `id_tpproveedor` int(11) NOT NULL,
  `noproductos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
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
(9, 'juan12', 'juan@gmail.com', '$2y$10$MdSnZTIALoa1ZRG.8GUwfeljEf6UT0OA5pTFYaSyE3UV7c3iXRx3K', 'xvMPZMebUXNJDlDYIzhIyrAl8yRowl4Dtt5kYfgpdTFV0nOmaMlJXOhi1L2G', '2019-11-06 11:38:48', '2020-10-24 00:36:25', 1, 1, 1),
(20, 'Juliana', 'jualiana@gmail.com', '$2y$10$Ufrdm5A4ZWQMTpaDnPn5AuruPHfsH/fjXXIY9O0TFjY1JwtrostMm', NULL, '2020-10-19 00:56:07', '2020-10-19 00:56:07', 1, 2, 0);

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
-- Indices de la tabla `cartera`
--
ALTER TABLE `cartera`
  ADD PRIMARY KEY (`id_cartera`),
  ADD KEY `empleado_id_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `cartera_cliente_fk` (`cliente_id_cliente`),
  ADD KEY `cartera_factura_fk` (`factura_id_factura`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`),
  ADD KEY `sede_id_sede` (`sede_id_sede`);

--
-- Indices de la tabla `categoria_stock_especiales`
--
ALTER TABLE `categoria_stock_especiales`
  ADD PRIMARY KEY (`id_categoriaStock`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`),
  ADD KEY `sede_id_sede` (`sede_id_sede`);

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
-- Indices de la tabla `detalle_cartera`
--
ALTER TABLE `detalle_cartera`
  ADD PRIMARY KEY (`id_dCartera`),
  ADD KEY `empleado_id_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `tipo_pago_fk` (`tipo_pago`),
  ADD KEY `id_cartera_fk` (`id_cartera`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detallef`),
  ADD KEY `detalle_factura_factura_fk` (`factura_id_factura`),
  ADD KEY `detalle_factura_producto_fk` (`producto_id_producto`);

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
  ADD KEY `d_p_cliente_producto_fk` (`producto_id_producto`),
  ADD KEY `d_p_cliente_t_p_cliente_fk` (`t_p_cliente_id_remision`);

--
-- Indices de la tabla `d_p_proveedor`
--
ALTER TABLE `d_p_proveedor`
  ADD PRIMARY KEY (`id_dpproveedor`),
  ADD KEY `d_p_proveedor_producto_fk` (`producto_id_producto`),
  ADD KEY `d_p_proveedor_tp_aproveedor_fk` (`tp_aproveedor_id_rproveedor`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `empleado_sede_fk` (`sede_id_sede`),
  ADD KEY `empleado_tipo_cargo_fk` (`tipo_cargo_id_cargo`),
  ADD KEY `user_id_user` (`user_id_user`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `factura_cliente_fk` (`cliente_id_cliente`),
  ADD KEY `factura_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `factura_tipo_pago_fk` (`tipo_pago_id_tpago`);

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
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`),
  ADD KEY `sede_id_sede` (`sede_id_sede`);

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
  ADD KEY `stock_sede_fk` (`sede_id_sede`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`);

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
  MODIFY `id_cargoModulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `cartera`
--
ALTER TABLE `cartera`
  MODIFY `id_cartera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria_stock_especiales`
--
ALTER TABLE `categoria_stock_especiales`
  MODIFY `id_categoriaStock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de la tabla `detalle_cartera`
--
ALTER TABLE `detalle_cartera`
  MODIFY `id_dCartera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detallef` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

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
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT de la tabla `m_stock`
--
ALTER TABLE `m_stock`
  MODIFY `id_mstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tipo_cargo`
--
ALTER TABLE `tipo_cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
