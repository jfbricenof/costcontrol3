-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-07-2019 a las 22:23:01
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `movilcen_COSTCONTROL`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE `Actividad` (
  `id_actividad` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `costo` float(12,4) NOT NULL DEFAULT '0.0000',
  `presupuesto` float(12,4) NOT NULL DEFAULT '0.0000',
  `observacion` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`id_actividad`, `nombre`, `costo`, `presupuesto`, `observacion`) VALUES
(7, 'FACHADA', 0.0000, 32000000.0000, 'FACHADA PRINCIPAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ccostos`
--

CREATE TABLE `Ccostos` (
  `id_ccostos` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Ccostos`
--

INSERT INTO `Ccostos` (`id_ccostos`, `nombre`, `direccion`, `responsable`, `tel`) VALUES
(5, 'Centro de Negocios', 'Cra. 17 N. 11-10', 'Julian Briceño', '3182228380');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleDevolucion`
--

CREATE TABLE `DetalleDevolucion` (
  `id_DetalleDevolucion` int(11) NOT NULL,
  `id_devolucion` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `cant_material` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `precio_unit` decimal(10,4) NOT NULL,
  `subtotal` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `DetalleDevolucion`
--
DELIMITER $$
CREATE TRIGGER `t_insert_devolucion` AFTER INSERT ON `DetalleDevolucion` FOR EACH ROW BEGIN
 	UPDATE Material set cantidad = cantidad - NEW.cant_material WHERE id_material = NEW.id_material;
 	UPDATE Actividad set costo = costo - NEW.subtotal WHERE id_actividad = NEW.id_actividad;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleEntrada`
--

CREATE TABLE `DetalleEntrada` (
  `id_DetalleEntrada` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_DetalleOrden` int(11) NOT NULL,
  `cant_material` int(11) DEFAULT NULL,
  `precio_unit_DetalleOrden` float(12,4) NOT NULL,
  `subtotal` float(12,4) DEFAULT NULL,
  `id_actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `DetalleEntrada`
--
DELIMITER $$
CREATE TRIGGER `t_insert_entradas` AFTER INSERT ON `DetalleEntrada` FOR EACH ROW BEGIN
 	DECLARE v_id_material INT(11);
 	DECLARE v_fecha DATE;
 	DECLARE v_saldo_k INT(11);
 	SET v_saldo_k = 0;
 	SELECT id_material INTO v_id_material FROM DetalleOrden WHERE id_DetalleOrden = NEW.id_DetalleOrden;
 	SELECT fecha INTO v_fecha FROM Entrada WHERE id_entrada = NEW.id_entrada;
 	UPDATE Material set cantidad = cantidad + NEW.cant_material, precio = NEW.precio_unit_DetalleOrden WHERE id_material = v_id_material;
 	UPDATE Actividad set costo = costo + NEW.subtotal WHERE id_actividad = NEW.id_actividad;

 	SELECT IFNULL(saldo, 0) INTO v_saldo_k FROM kardex WHERE id_material = v_id_material ORDER BY id DESC LIMIT 1;
 	INSERT INTO kardex (id_material,fecha,tipo,cantidad,saldo,documento) VALUES (v_id_material,v_fecha,'Entrada',NEW.cant_material,v_saldo_k + NEW.cant_material,NEW.id_entrada);
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleOrden`
--

CREATE TABLE `DetalleOrden` (
  `id_DetalleOrden` int(11) NOT NULL,
  `id_OrdenCompra` int(11) NOT NULL,
  `id_material` int(11) DEFAULT NULL,
  `cant_material` int(11) DEFAULT NULL,
  `precio_unit` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `estado` enum('Finalizada','Pendiente') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `DetalleOrden`
--

INSERT INTO `DetalleOrden` (`id_DetalleOrden`, `id_OrdenCompra`, `id_material`, `cant_material`, `precio_unit`, `subtotal`, `estado`) VALUES
(39, 23, 1, 20, '18000.00', '360000.00', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleOrdenServicio`
--

CREATE TABLE `DetalleOrdenServicio` (
  `id_DetalleOrdenServicio` int(11) NOT NULL,
  `id_OrdenServicio` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `cant_servicio` int(11) DEFAULT NULL,
  `precio_unit` float(12,2) DEFAULT NULL,
  `subtotal` float(12,2) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `DetalleOrdenServicio`
--

INSERT INTO `DetalleOrdenServicio` (`id_DetalleOrdenServicio`, `id_OrdenServicio`, `id_servicio`, `cant_servicio`, `precio_unit`, `subtotal`, `id_actividad`) VALUES
(3, 2, 5, 1, 12333.00, 12333.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleReintegro`
--

CREATE TABLE `DetalleReintegro` (
  `id_DetalleReintegro` int(11) NOT NULL,
  `id_reintegro` int(11) NOT NULL,
  `id_material` int(11) DEFAULT NULL,
  `cant_material` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `DetalleReintegro`
--
DELIMITER $$
CREATE TRIGGER `t_insert_reintegros` AFTER INSERT ON `DetalleReintegro` FOR EACH ROW BEGIN
 	UPDATE Material set cantidad = cantidad + NEW.cant_material WHERE id_material = NEW.id_material;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleSalida`
--

CREATE TABLE `DetalleSalida` (
  `id_DetalleSalida` int(11) NOT NULL,
  `id_salida` int(11) NOT NULL,
  `id_material` int(11) DEFAULT NULL,
  `cant_material` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `DetalleSalida`
--
DELIMITER $$
CREATE TRIGGER `t_insert_salidas` AFTER INSERT ON `DetalleSalida` FOR EACH ROW BEGIN
 	DECLARE v_fecha DATE;
 	DECLARE v_saldo_k INT(11);
 	SET v_saldo_k = 0;
 	SELECT fecha INTO v_fecha FROM Salida WHERE id_salida = NEW.id_salida;
 	SELECT IFNULL(saldo, 0) INTO v_saldo_k FROM kardex WHERE id_material = NEW.id_material ORDER BY id DESC LIMIT 1;
 	UPDATE Material set cantidad = cantidad - NEW.cant_material WHERE id_material = NEW.id_material;
 	INSERT INTO kardex (id_material,fecha,tipo,cantidad,saldo,documento) VALUES (NEW.id_material,v_fecha,'Salida',NEW.cant_material,v_saldo_k - NEW.cant_material,NEW.id_salida);
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Devolucion`
--

CREATE TABLE `Devolucion` (
  `id_devolucion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_provee` int(11) DEFAULT NULL,
  `observacion` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `subtotal` decimal(10,4) DEFAULT NULL,
  `id_iva` int(11) DEFAULT NULL,
  `total` decimal(10,4) DEFAULT NULL,
  `id_solicita` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empleado`
--

CREATE TABLE `Empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Empleado`
--

INSERT INTO `Empleado` (`id_empleado`, `nombre`, `apellido`, `foto`, `telefono`) VALUES
(1, 'admin', 'adminn', NULL, '333'),
(19270360, 'LUIS FERNANDO', 'ALVAREZ', NULL, '3214567');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empresa`
--

CREATE TABLE `Empresa` (
  `nit` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `departamento` varchar(30) DEFAULT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `web` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Empresa`
--

INSERT INTO `Empresa` (`nit`, `nombre`, `logo`, `pais`, `departamento`, `ciudad`, `direccion`, `telefono`, `web`) VALUES
(901031711, 'Quality Group Constructores S.A.S.', NULL, 'Colombia', 'Risaralda', 'Pereira', 'Cra 12 N. 24-06', 3211515, 'www.qualitygroup.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Entrada`
--

CREATE TABLE `Entrada` (
  `id_entrada` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_OrdenCompra` int(11) DEFAULT NULL,
  `subtotal` float(12,4) DEFAULT NULL,
  `Iva_OrdenCompra` int(11) DEFAULT NULL,
  `total` float(12,4) DEFAULT NULL,
  `remision` varchar(20) DEFAULT NULL,
  `factura` varchar(20) DEFAULT NULL,
  `observacion` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Iva`
--

CREATE TABLE `Iva` (
  `id_iva` int(11) NOT NULL,
  `nombre_iva` varchar(11) DEFAULT NULL,
  `porcentaje_iva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id` int(11) NOT NULL,
  `id_material` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` enum('Salida','Entrada') COLLATE utf8_unicode_ci DEFAULT 'Entrada',
  `cantidad` int(11) DEFAULT NULL,
  `saldo` int(11) NOT NULL DEFAULT '0',
  `documento` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Material`
--

CREATE TABLE `Material` (
  `id_material` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `unidad` varchar(10) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `precio` float(12,2) DEFAULT '0.00',
  `foto` varchar(50) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Material`
--

INSERT INTO `Material` (`id_material`, `nombre`, `unidad`, `tipo`, `precio`, `foto`, `cantidad`) VALUES
(1, 'CEMENTO BLANCOx50 Kg', 'BTO', 'AGREGADO', 22000.00, NULL, 1096);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenCompra`
--

CREATE TABLE `OrdenCompra` (
  `id_OrdenCompra` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_provee` int(11) DEFAULT NULL,
  `requisicion` varchar(20) DEFAULT NULL,
  `cond_pago` varchar(30) DEFAULT NULL,
  `observacion` mediumtext,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `id_iva` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha_requi` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `id_recibe` int(11) DEFAULT NULL,
  `id_solicita` int(11) DEFAULT NULL,
  `estado` enum('Finalizada','Pendiente') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `OrdenCompra`
--

INSERT INTO `OrdenCompra` (`id_OrdenCompra`, `fecha`, `id_provee`, `requisicion`, `cond_pago`, `observacion`, `subtotal`, `id_iva`, `total`, `fecha_requi`, `fecha_entrega`, `id_recibe`, `id_solicita`, `estado`) VALUES
(23, '2019-07-13', 7, '1', 'CONTADO', 'ENTREGAR PRONTO\n                                ', '360000.00', 0, '360000.00', '2019-07-12', '2019-07-21', 19270360, 1, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenServicio`
--

CREATE TABLE `OrdenServicio` (
  `id_OrdenServicio` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_provee` int(11) DEFAULT NULL,
  `cond_pago` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacion` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `id_iva` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_recibe` int(11) DEFAULT NULL,
  `id_solicita` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `OrdenServicio`
--

INSERT INTO `OrdenServicio` (`id_OrdenServicio`, `fecha`, `id_provee`, `cond_pago`, `observacion`, `subtotal`, `id_iva`, `total`, `fecha_fin`, `id_recibe`, `id_solicita`) VALUES
(2, '2019-07-13', 7, 'CREDITO', 'RAPIDO\n                                ', '12333.00', 0, '0.00', '2019-07-19', 19270360, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedores`
--

CREATE TABLE `Proveedores` (
  `id_provee` int(11) NOT NULL,
  `razon` varchar(30) DEFAULT NULL,
  `nit` varchar(30) DEFAULT NULL,
  `ncomercial` varchar(30) DEFAULT NULL,
  `correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `cel` varchar(20) DEFAULT NULL,
  `contacto` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Proveedores`
--

INSERT INTO `Proveedores` (`id_provee`, `razon`, `nit`, `ncomercial`, `correo`, `direccion`, `ciudad`, `tel`, `cel`, `contacto`) VALUES
(7, 'LEIDY YOHANA RAMIREZ', '901784526', 'FERRETERIA ZONA LIBRE', 'zonalibre@gmail.com', 'Cra21 n. 11-10', 'Pereira', '3245555', '3182828282', 'ALEX TABIMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reintegro`
--

CREATE TABLE `Reintegro` (
  `id_reintegro` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `contratista` varchar(20) DEFAULT NULL,
  `observacion` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Salida`
--

CREATE TABLE `Salida` (
  `id_salida` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `vale` varchar(20) DEFAULT NULL,
  `contratista` varchar(20) DEFAULT NULL,
  `observacion` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Salida`
--

INSERT INTO `Salida` (`id_salida`, `fecha`, `vale`, `contratista`, `observacion`) VALUES
(3, '2019-05-30', '123', 'gya', ''),
(4, '2019-05-30', '123', 'gya', ''),
(5, '2019-05-30', '2641', 'GGR puntual', ''),
(6, '2019-06-01', '1245', 'jorge', ''),
(7, '2019-06-28', '85585', 'JHONATAN', ''),
(8, '2019-07-12', '5225', 'JULIAN', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicio`
--

CREATE TABLE `Servicio` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `unidad` varchar(10) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `precio` float(12,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Servicio`
--

INSERT INTO `Servicio` (`id_servicio`, `nombre`, `unidad`, `tipo`, `precio`) VALUES
(5, 'FLETE DOSQUEBRADAS', 'UN', 'TRANSPORTE', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicita`
--

CREATE TABLE `solicita` (
  `id_solicita` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `tipo` enum('Ejecutivo','Almacenista','Jefe de Compras','Supervisor') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'Ejecutivo',
  `email` varchar(40) DEFAULT NULL,
  `pw` varchar(150) DEFAULT NULL,
  `estado` tinyint(5) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id_usuario`, `id_empleado`, `tipo`, `email`, `pw`, `estado`, `fecha_registro`) VALUES
(1, 1, 'Supervisor', 'admin@adm.com', '$2y$10$X9VLGkvMH.UsUkf7YmPivehE6zYmbE.dxrl4cTsfmqfyH0xQ4w3XK', 1, '2019-05-16 18:33:37'),
(13, 19270360, 'Jefe de Compras', 'luis@cc.com', '$2y$10$dKhpnn3jRG59QmoTLEXJXezMJfz6o3IajaUcfaVJkEk7m2XQJAVq.', NULL, '2019-07-13 14:32:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Actividad`
--
ALTER TABLE `Actividad`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `Ccostos`
--
ALTER TABLE `Ccostos`
  ADD PRIMARY KEY (`id_ccostos`);

--
-- Indices de la tabla `DetalleDevolucion`
--
ALTER TABLE `DetalleDevolucion`
  ADD PRIMARY KEY (`id_DetalleDevolucion`,`id_devolucion`) USING BTREE,
  ADD KEY `DetalleDevolucion_ibfk_1` (`id_devolucion`),
  ADD KEY `DetalleDevolucion_ibfk_3` (`id_actividad`),
  ADD KEY `DetalleDevolucion_ibfk_2` (`id_material`);

--
-- Indices de la tabla `DetalleEntrada`
--
ALTER TABLE `DetalleEntrada`
  ADD PRIMARY KEY (`id_DetalleEntrada`,`id_entrada`) USING BTREE,
  ADD KEY `DetalleEntrada_ibfk_3` (`id_actividad`),
  ADD KEY `DetalleEntrada_ibfk_1` (`id_entrada`),
  ADD KEY `DetalleEntrada_ibfk_2` (`id_DetalleOrden`);

--
-- Indices de la tabla `DetalleOrden`
--
ALTER TABLE `DetalleOrden`
  ADD PRIMARY KEY (`id_DetalleOrden`,`id_OrdenCompra`),
  ADD KEY `DetalleOrden_ibfk_1` (`id_OrdenCompra`),
  ADD KEY `DetalleOrden_ibfk_2` (`id_material`);

--
-- Indices de la tabla `DetalleOrdenServicio`
--
ALTER TABLE `DetalleOrdenServicio`
  ADD PRIMARY KEY (`id_DetalleOrdenServicio`,`id_OrdenServicio`),
  ADD KEY `DetalleOrdenServicio_ibfk_2` (`id_servicio`),
  ADD KEY `DetalleOrdenServicio_ibfk_3` (`id_actividad`),
  ADD KEY `DetalleOrdenServicio_ibfk_1` (`id_OrdenServicio`);

--
-- Indices de la tabla `DetalleReintegro`
--
ALTER TABLE `DetalleReintegro`
  ADD PRIMARY KEY (`id_DetalleReintegro`,`id_reintegro`),
  ADD KEY `DetalleReintegro_ibfk_1` (`id_reintegro`),
  ADD KEY `DetalleReintegro_ibfk_2` (`id_material`);

--
-- Indices de la tabla `DetalleSalida`
--
ALTER TABLE `DetalleSalida`
  ADD PRIMARY KEY (`id_DetalleSalida`,`id_salida`),
  ADD KEY `DetalleSalida_ibfk_1` (`id_salida`),
  ADD KEY `DetalleSalida_ibfk_2` (`id_material`);

--
-- Indices de la tabla `Devolucion`
--
ALTER TABLE `Devolucion`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `id_Devolucion` (`id_devolucion`),
  ADD KEY `Devolucion_ibfk_1` (`id_provee`),
  ADD KEY `Devolucion_ibfk_2` (`id_iva`),
  ADD KEY `Devolucion_ibfk_3` (`id_solicita`);

--
-- Indices de la tabla `Empleado`
--
ALTER TABLE `Empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `Empresa`
--
ALTER TABLE `Empresa`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `Entrada`
--
ALTER TABLE `Entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `Entrada_ibfk_1` (`id_OrdenCompra`);

--
-- Indices de la tabla `Iva`
--
ALTER TABLE `Iva`
  ADD PRIMARY KEY (`id_iva`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material` (`id_material`);

--
-- Indices de la tabla `Material`
--
ALTER TABLE `Material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `OrdenCompra`
--
ALTER TABLE `OrdenCompra`
  ADD PRIMARY KEY (`id_OrdenCompra`),
  ADD KEY `OrdenCompra_ibfk_1` (`id_provee`),
  ADD KEY `OrdenCompra_ibfk_2` (`id_iva`),
  ADD KEY `id_recibe` (`id_recibe`),
  ADD KEY `id_solicita` (`id_solicita`);

--
-- Indices de la tabla `OrdenServicio`
--
ALTER TABLE `OrdenServicio`
  ADD PRIMARY KEY (`id_OrdenServicio`),
  ADD KEY `OrdenServicio_ibfk_2` (`id_iva`),
  ADD KEY `OrdenServicio_ibfk_1` (`id_provee`),
  ADD KEY `OrdenServicio_ibfk_3` (`id_recibe`),
  ADD KEY `OrdenServicio_ibfk_4` (`id_solicita`);

--
-- Indices de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  ADD PRIMARY KEY (`id_provee`);

--
-- Indices de la tabla `Reintegro`
--
ALTER TABLE `Reintegro`
  ADD PRIMARY KEY (`id_reintegro`);

--
-- Indices de la tabla `Salida`
--
ALTER TABLE `Salida`
  ADD PRIMARY KEY (`id_salida`);

--
-- Indices de la tabla `Servicio`
--
ALTER TABLE `Servicio`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `solicita`
--
ALTER TABLE `solicita`
  ADD PRIMARY KEY (`id_solicita`),
  ADD KEY `solicita_ibfk_1` (`id_empleado`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `Usuario_ibfk_1` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Actividad`
--
ALTER TABLE `Actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Ccostos`
--
ALTER TABLE `Ccostos`
  MODIFY `id_ccostos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `DetalleDevolucion`
--
ALTER TABLE `DetalleDevolucion`
  MODIFY `id_DetalleDevolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `DetalleEntrada`
--
ALTER TABLE `DetalleEntrada`
  MODIFY `id_DetalleEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `DetalleOrden`
--
ALTER TABLE `DetalleOrden`
  MODIFY `id_DetalleOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `DetalleOrdenServicio`
--
ALTER TABLE `DetalleOrdenServicio`
  MODIFY `id_DetalleOrdenServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `DetalleReintegro`
--
ALTER TABLE `DetalleReintegro`
  MODIFY `id_DetalleReintegro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `DetalleSalida`
--
ALTER TABLE `DetalleSalida`
  MODIFY `id_DetalleSalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `Devolucion`
--
ALTER TABLE `Devolucion`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Entrada`
--
ALTER TABLE `Entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `Iva`
--
ALTER TABLE `Iva`
  MODIFY `id_iva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `Material`
--
ALTER TABLE `Material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `OrdenCompra`
--
ALTER TABLE `OrdenCompra`
  MODIFY `id_OrdenCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `OrdenServicio`
--
ALTER TABLE `OrdenServicio`
  MODIFY `id_OrdenServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  MODIFY `id_provee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Reintegro`
--
ALTER TABLE `Reintegro`
  MODIFY `id_reintegro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `Salida`
--
ALTER TABLE `Salida`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Servicio`
--
ALTER TABLE `Servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicita`
--
ALTER TABLE `solicita`
  MODIFY `id_solicita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DetalleDevolucion`
--
ALTER TABLE `DetalleDevolucion`
  ADD CONSTRAINT `DetalleDevolucion_ibfk_1` FOREIGN KEY (`id_devolucion`) REFERENCES `Devolucion` (`id_devolucion`),
  ADD CONSTRAINT `DetalleDevolucion_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `Material` (`id_material`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DetalleDevolucion_ibfk_3` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `DetalleEntrada`
--
ALTER TABLE `DetalleEntrada`
  ADD CONSTRAINT `DetalleEntrada_ibfk_1` FOREIGN KEY (`id_entrada`) REFERENCES `Entrada` (`id_entrada`),
  ADD CONSTRAINT `DetalleEntrada_ibfk_2` FOREIGN KEY (`id_DetalleOrden`) REFERENCES `DetalleOrden` (`id_DetalleOrden`),
  ADD CONSTRAINT `DetalleEntrada_ibfk_3` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`);

--
-- Filtros para la tabla `DetalleOrden`
--
ALTER TABLE `DetalleOrden`
  ADD CONSTRAINT `DetalleOrden_ibfk_1` FOREIGN KEY (`id_OrdenCompra`) REFERENCES `OrdenCompra` (`id_OrdenCompra`),
  ADD CONSTRAINT `DetalleOrden_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `Material` (`id_material`);

--
-- Filtros para la tabla `DetalleOrdenServicio`
--
ALTER TABLE `DetalleOrdenServicio`
  ADD CONSTRAINT `DetalleOrdenServicio_ibfk_1` FOREIGN KEY (`id_OrdenServicio`) REFERENCES `OrdenServicio` (`id_OrdenServicio`),
  ADD CONSTRAINT `DetalleOrdenServicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `Servicio` (`id_servicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DetalleOrdenServicio_ibfk_3` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `DetalleReintegro`
--
ALTER TABLE `DetalleReintegro`
  ADD CONSTRAINT `DetalleReintegro_ibfk_1` FOREIGN KEY (`id_reintegro`) REFERENCES `Reintegro` (`id_reintegro`),
  ADD CONSTRAINT `DetalleReintegro_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `Material` (`id_material`);

--
-- Filtros para la tabla `DetalleSalida`
--
ALTER TABLE `DetalleSalida`
  ADD CONSTRAINT `DetalleSalida_ibfk_1` FOREIGN KEY (`id_salida`) REFERENCES `Salida` (`id_salida`),
  ADD CONSTRAINT `DetalleSalida_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `Material` (`id_material`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Devolucion`
--
ALTER TABLE `Devolucion`
  ADD CONSTRAINT `Devolucion_ibfk_1` FOREIGN KEY (`id_provee`) REFERENCES `Proveedores` (`id_provee`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Devolucion_ibfk_2` FOREIGN KEY (`id_iva`) REFERENCES `Iva` (`id_iva`),
  ADD CONSTRAINT `Devolucion_ibfk_3` FOREIGN KEY (`id_solicita`) REFERENCES `Empleado` (`id_empleado`);

--
-- Filtros para la tabla `Entrada`
--
ALTER TABLE `Entrada`
  ADD CONSTRAINT `Entrada_ibfk_1` FOREIGN KEY (`id_OrdenCompra`) REFERENCES `OrdenCompra` (`id_OrdenCompra`);

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `Material` (`id_material`);

--
-- Filtros para la tabla `OrdenCompra`
--
ALTER TABLE `OrdenCompra`
  ADD CONSTRAINT `OrdenCompra_ibfk_1` FOREIGN KEY (`id_provee`) REFERENCES `Proveedores` (`id_provee`) ON UPDATE CASCADE,
  ADD CONSTRAINT `OrdenCompra_ibfk_3` FOREIGN KEY (`id_recibe`) REFERENCES `Empleado` (`id_empleado`),
  ADD CONSTRAINT `OrdenCompra_ibfk_4` FOREIGN KEY (`id_solicita`) REFERENCES `Empleado` (`id_empleado`);

--
-- Filtros para la tabla `OrdenServicio`
--
ALTER TABLE `OrdenServicio`
  ADD CONSTRAINT `OrdenServicio_ibfk_1` FOREIGN KEY (`id_provee`) REFERENCES `Proveedores` (`id_provee`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `OrdenServicio_ibfk_4` FOREIGN KEY (`id_solicita`) REFERENCES `Empleado` (`id_empleado`);

--
-- Filtros para la tabla `solicita`
--
ALTER TABLE `solicita`
  ADD CONSTRAINT `solicita_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `Empleado` (`id_empleado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `Empleado` (`id_empleado`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
