-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2020 a las 06:06:01
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_logistica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`) VALUES
(1, 'AUDIFONOS'),
(2, 'LAPTOP'),
(3, 'CELULAR'),
(11, 'CPU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL,
  `ape_pat` text DEFAULT NULL,
  `ape_mat` text DEFAULT NULL,
  `nombres` text DEFAULT NULL,
  `num_documento` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idempleado`, `ape_pat`, `ape_mat`, `nombres`, `num_documento`) VALUES
(1, 'melendez', 'vasquez', 'ed', '48315005');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'OPERATIVO'),
(2, 'MALOGRADO'),
(3, 'REPARACION INTERNA'),
(4, 'REPARACION GARANTIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `descripcion`) VALUES
(1, 'JABRA'),
(2, 'GENIUS'),
(15, 'LG'),
(17, 'HP'),
(18, 'CYBERTEL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id`, `idcategoria`, `idmarca`, `descripcion`, `imagen`) VALUES
(71, 11, 18, 'jtw300press', 'vistas/img/modelos/jtw300press/681.jpg'),
(73, 1, 1, 'biz 1500', 'vistas/img/modelos/jabra300/586.jpg'),
(74, 1, 2, 'g400a', 'vistas/img/modelos/g400a/969.jpg'),
(75, 11, 17, 'pabilon200x', 'vistas/img/modelos/pabilon200x/666.jpg'),
(76, 3, 15, 'lg s10', 'vistas/img/modelos/lg s10/178.jpg'),
(77, 2, 17, 'laptop001', 'vistas/img/modelos/default/anonymous.png'),
(78, 2, 17, 'lapp002-xg', 'vistas/img/modelos/default/anonymous.png'),
(79, 1, 2, 'GE0100', 'vistas/img/modelos/default/anonymous.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT 0,
  `idproducto` int(11) DEFAULT NULL,
  `idempleado` varchar(50) DEFAULT NULL,
  `fecha_prestamo` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_devolucion` timestamp NULL DEFAULT NULL,
  `observacion_prestamo` text DEFAULT NULL,
  `observacion_devolucion` text DEFAULT NULL,
  `estado_prestamo` enum('PENDIENTE','FINALIZADO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id`, `idusuario`, `idproducto`, `idempleado`, `fecha_prestamo`, `fecha_devolucion`, `observacion_prestamo`, `observacion_devolucion`, `estado_prestamo`) VALUES
(163, 1, 54, 'pedro', '2020-09-08 01:58:07', '2020-09-20 02:20:07', 'sasasassasasasas', 'todo bien', 'FINALIZADO'),
(164, 1, 47, 'pedro', '2020-09-08 01:58:03', '2020-09-07 02:24:01', 'audifono operativo cable usb operativo,se escucha bien', 'se devuelve roto el cable, descuento de 100 soles ', 'FINALIZADO'),
(165, 1, 46, 'sergio', '2020-09-08 01:57:55', NULL, 'audifono con entrada usb, se escucha solo lado derecho', NULL, 'PENDIENTE'),
(166, 1, 55, 'sergio', '2020-09-08 03:02:16', '2020-09-07 03:02:16', 'CELULAR OPERATIVO CON CARGADOR', 'BIEN PERRO', 'FINALIZADO'),
(167, 1, 54, 'jorge', '2020-09-08 02:03:30', NULL, 'preste ok', NULL, 'PENDIENTE'),
(168, 1, 53, 'jorge', '2020-09-08 02:03:33', NULL, 'todo beeen', NULL, 'PENDIENTE'),
(169, 1, 52, 'jorge', '2020-09-08 02:55:34', '2020-09-12 02:55:34', 'posiblemente se corrgio el problema', 'conforme', 'FINALIZADO'),
(170, 1, 50, 'carlos', '2020-09-08 02:33:33', '2020-09-06 02:33:33', 'ok', 'todo bien', 'FINALIZADO'),
(171, 1, 56, 'sergio', '2020-09-12 04:41:42', '2020-09-12 04:41:42', 'prestamo de lap 1', 'devolvio con pantalla rota, descuento de 100 soles en 2 partes', 'FINALIZADO'),
(172, 1, 58, 'sergio', '2020-09-08 03:00:06', NULL, 'prestamo de lap 2', NULL, 'PENDIENTE'),
(173, 1, 55, 'carmen', '2020-09-10 04:59:36', '2020-09-14 04:59:36', 'operativo', 'devolvio conforme', 'FINALIZADO'),
(174, 1, 52, 'carmen', '2020-09-10 03:25:14', '2020-09-10 03:25:14', 'operativo con audifono jabra buen estado', 'devolvio conforme', 'FINALIZADO'),
(175, 1, 60, 'juana valdivia mendoza', '2020-09-10 04:34:32', '2020-09-10 04:34:32', 'operativo', 'devolvio bien', 'FINALIZADO'),
(176, 1, 60, 'roxana albites gutierrez', '2020-09-12 04:38:33', NULL, 'ok', NULL, 'PENDIENTE'),
(177, 1, 59, 'roxana albites gutierrez', '2020-09-12 04:38:33', NULL, 'ok', NULL, 'PENDIENTE'),
(178, 1, 55, 'leoncio prado', '2020-09-12 04:42:59', '2020-09-12 04:42:59', 'ok', 'devolvio okj', 'FINALIZADO'),
(179, 1, 52, 'leoncio prado', '2020-09-12 04:43:24', '2020-09-19 04:43:24', 'ok', 'devolviendo ok', 'FINALIZADO'),
(180, 1, 50, 'leoncio prado', '2020-09-12 04:39:30', NULL, 'ok', NULL, 'PENDIENTE'),
(181, 1, 57, 'leoncio prado', '2020-09-12 04:39:30', NULL, 'ok', NULL, 'PENDIENTE'),
(182, 1, 62, 'rosa merino', '2020-09-15 00:07:40', NULL, 'perfecto', NULL, 'PENDIENTE'),
(183, 1, 63, 'kike', '2020-09-15 23:58:30', NULL, 'ok', NULL, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `idmodelo` int(11) DEFAULT NULL,
  `cod_producto` varchar(50) DEFAULT NULL,
  `idestado` int(11) DEFAULT NULL,
  `estado_prestamo` enum('DISPONIBLE','OCUPADO') DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `idmodelo`, `cod_producto`, `idestado`, `estado_prestamo`, `fecha`) VALUES
(37, 73, 'JA0015', 4, 'DISPONIBLE', '2020-09-07 02:09:37'),
(38, 73, 'JA0004', 1, 'DISPONIBLE', '2020-09-04 23:31:52'),
(40, 73, 'JA0002', 1, 'DISPONIBLE', '2020-09-04 23:39:55'),
(41, 73, 'JA0005', 1, 'DISPONIBLE', '2020-09-04 23:31:54'),
(43, 73, 'JA0010', 3, 'DISPONIBLE', '2020-09-04 23:32:01'),
(44, 73, 'JA0009', 3, 'DISPONIBLE', '2020-09-04 23:31:36'),
(45, 73, 'JA0008', 3, 'DISPONIBLE', '2020-09-04 23:31:58'),
(46, 73, 'JA0014', 4, 'OCUPADO', '2020-09-07 02:22:40'),
(47, 73, 'JA0013', 4, 'DISPONIBLE', '2020-09-07 02:24:01'),
(48, 73, 'JA0006', 3, 'DISPONIBLE', '2020-09-06 16:40:39'),
(50, 73, 'JA0011', 4, 'OCUPADO', '2020-09-12 04:39:30'),
(52, 73, 'JA0007', 3, 'DISPONIBLE', '2020-09-12 04:43:24'),
(53, 73, 'JA0003', 2, 'OCUPADO', '2020-09-08 02:00:38'),
(54, 73, 'JA0001', 1, 'DISPONIBLE', '2020-09-12 05:24:36'),
(55, 76, 'LG010001', 1, 'DISPONIBLE', '2020-09-12 04:43:00'),
(56, 77, 'lap010002', 1, 'DISPONIBLE', '2020-09-12 04:41:42'),
(57, 78, 'lap20002ge', 1, 'OCUPADO', '2020-09-12 04:39:30'),
(58, 77, 'lap01003', 1, 'OCUPADO', '2020-09-08 03:00:06'),
(59, 77, 'lap01004ge', 1, 'OCUPADO', '2020-09-12 04:38:33'),
(60, 79, 'ge200x10', 1, 'OCUPADO', '2020-09-12 04:38:33'),
(61, 73, 'PC-0001', 1, 'OCUPADO', '2020-09-12 05:03:19'),
(62, 73, 'JA0001', 4, 'OCUPADO', '2020-09-15 00:07:39'),
(63, 73, 'PC-00012', 1, 'OCUPADO', '2020-09-15 23:58:29'),
(64, 73, 'PC01-00019', 3, 'DISPONIBLE', '2020-09-12 05:09:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `usuario` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `perfil` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'sergio jara mendoza', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/369.png', 1, '2020-09-15 22:53:44', NULL),
(8, 'genesis suluco', 'genesisg', '$2a$07$asxx54ahjppf45sd87a5augm/y.uaufyq79j6hVzed3saNwzFKo2a', 'Especial', 'vistas/img/usuarios/genesisg/382.jpg', 1, '2020-09-15 22:21:44', NULL),
(9, 'carlos caceda', 'ccaceda', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Visitante', '', 1, '2020-09-15 22:54:07', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idempleado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`) USING HASH;

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__categoria` (`idcategoria`),
  ADD KEY `FK__marca` (`idmarca`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__usuarios` (`idusuario`),
  ADD KEY `FK_prestamo_producto` (`idproducto`),
  ADD KEY `FK_prestamo_empleado` (`idempleado`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_producto_modelo` (`idmodelo`),
  ADD KEY `FK_producto_estado` (`idestado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `FK__categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK__marca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`id`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `FK__usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `FK_prestamo_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_producto_estado` FOREIGN KEY (`idestado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `FK_producto_modelo` FOREIGN KEY (`idmodelo`) REFERENCES `modelo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
