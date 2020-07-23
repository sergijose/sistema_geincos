-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla bd_logistica.categoria: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `descripcion`) VALUES
	(1, 'AUDIFONO'),
	(2, 'LAPTOP'),
	(3, 'CELULAR'),
	(6, 'PERRO');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Volcando datos para la tabla bd_logistica.empleado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` (`idempleado`, `ape_pat`, `ape_mat`, `nombres`, `num_documento`) VALUES
	(1, 'melendez', 'vasquez', 'ed', '48315005');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando datos para la tabla bd_logistica.estado: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` (`id`, `descripcion`) VALUES
	(1, 'OPERATIVO'),
	(2, 'MALOGRADO'),
	(3, 'REPARACION INTERNA'),
	(4, 'REPARACION GARANTIA');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;

-- Volcando datos para la tabla bd_logistica.marca: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` (`id`, `descripcion`) VALUES
	(1, 'JABRA'),
	(2, 'GENIUS'),
	(6, 'SAMSUNG');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;

-- Volcando datos para la tabla bd_logistica.modelo: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `modelo` DISABLE KEYS */;
INSERT INTO `modelo` (`id`, `idcategoria`, `idmarca`, `descripcion`, `imagen`) VALUES
	(1, 1, 1, 'ja300x', NULL),
	(3, 2, 2, 'samsum45xd', NULL),
	(17, 1, 2, 'ge400a', 'vistas/img/modelos/ge400a/883.jpg');
/*!40000 ALTER TABLE `modelo` ENABLE KEYS */;

-- Volcando datos para la tabla bd_logistica.prestamo: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
INSERT INTO `prestamo` (`id`, `idusuario`, `idproducto`, `idempleado`, `fecha_prestamo`, `fecha_devolucion`, `comentario`, `disponible`) VALUES
	(1, 1, 3, 1, '2020-07-07 22:45:02', '0000-00-00 00:00:00', NULL, 'DISPONIBLE'),
	(2, 3, 5, 1, '2020-07-07 22:46:48', NULL, NULL, 'DISPONIBLE'),
	(3, 2, 6, 1, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;

-- Volcando datos para la tabla bd_logistica.producto: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id`, `idmodelo`, `cod_producto`, `idestado`, `disponible`) VALUES
	(3, 1, 'JA00001', 1, 'DISPONIBLE'),
	(4, 1, 'JA00002', 1, 'DISPONIBLE'),
	(5, 1, 'JA00003', 1, 'DISPONIBLE'),
	(6, 3, '999888', 1, 'DISPONIBLE');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando datos para la tabla bd_logistica.usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
	(1, 'sergio josel jara mendoza', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'admin', NULL, 1, '2020-07-22 19:27:11', NULL),
	(2, 'diana valverde', 'diana', 'diana', 'registradora', NULL, 1, NULL, NULL),
	(3, 'jesus rivas', 'jesus', 'jesus', 'registradora', NULL, 1, NULL, NULL),
	(4, 'genesis suluco', 'genesisg', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '', 1, '2020-07-20 20:08:42', NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
