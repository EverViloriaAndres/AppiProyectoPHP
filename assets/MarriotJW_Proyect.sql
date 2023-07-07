-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-07-2023 a las 10:39:00
-- Versión del servidor: 8.0.33-0ubuntu0.22.04.2
-- Versión de PHP: 8.1.2-1ubuntu2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `MarriotJW_Proyect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `num_serial` int NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `describcion` varchar(200) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `enPosecion` varchar(10) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`num_serial`, `nombre`, `describcion`, `valor`, `enPosecion`) VALUES
(1, 'camara', 'Camara de seguridad del patio trasero, en perfecto estado.', '500000.00', 'si'),
(2, 'Portatil HP', 'HD 500GB, Intel i7-10, RAM 8GB DDR4, 16Pulgadas, Camara integra 1080p.', '1700000.00', 'no'),
(3, 'SSS Crucial', 'SSD ME MVNM PCI_E 1.5GB/SGS.', '500000.00', 'si'),
(4, 'Impresora lenovo', 'Color ROJO VICHE, ANALOGICA, A BLANCO Y NEGRO,  estado regular', '500000.00', 'si'),
(5, 'Diadema', 'Sony, azul, inalambrica 10/10', '200000.00', 'si'),
(6, 'Mouse HP', 'Optico, negro, inalambrico, sin detalles fisicos:10/10', '150000.00', 'si'),
(7, 'Teclado Lenovo', 'Dijital inalambrico, negro, 10/10', '95000.00', 'no'),
(8, 'Pantalla DELL', '32\" negra 10/10 60Mhz', '253000.00', 'si'),
(10, 'Silla de ruedas', 'Color Negro, 10/10', '1158000.00', 'si'),
(11, 'PC ASUS', 'PC de escritorio: cpu Icore I7 Ram 8Gb HD 1T SSD 1T', '2500000.00', 'si'),
(12, 'Extintor Flick', 'Marrca Flick vigente 10/10', '351000.00', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones`
--

CREATE TABLE `capacitaciones` (
  `id_capacitacion` int NOT NULL,
  `cc_persona_tutor_Fk` int NOT NULL,
  `tema_capacitacion` varchar(20) NOT NULL,
  `fecha_capacitacion` datetime NOT NULL,
  `numero_horas` int NOT NULL,
  `modalidad` varchar(15) DEFAULT NULL,
  `lugarFK` int NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `capacitaciones`
--

INSERT INTO `capacitaciones` (`id_capacitacion`, `cc_persona_tutor_Fk`, `tema_capacitacion`, `fecha_capacitacion`, `numero_horas`, `modalidad`, `lugarFK`, `observacion`, `fechaRegistroSystem`) VALUES
(1, 1073199276, 'SSTT', '2023-07-06 23:13:43', 2, 'Presencial', 8, 'Se dicta con normalidad.', '2023-07-06 23:13:43'),
(2, 1003071505, 'Java', '2023-07-06 23:34:43', 6, 'Presencial', 8, 'Se dicta con normalidad', '2023-07-06 23:42:49'),
(3, 13486765, 'Primeros auxilios', '2023-07-07 00:00:00', 3, 'Presencial', 15, 'Se dicto para aprovechar el ambiente', '2023-07-07 01:16:59'),
(4, 1003071505, 'Talanqueras', '2023-07-06 00:00:00', 1, 'Virtual', 14, 'Todo Sin Novedad', '2023-07-07 01:19:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlSupervisor`
--

CREATE TABLE `controlSupervisor` (
  `id_registroSession` int NOT NULL,
  `cc_persona_SupFK` int NOT NULL,
  `dia_Login` datetime NOT NULL,
  `fechaHORA_IN` datetime NOT NULL,
  `fechaHORA_OUT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correpondenciaEntregada`
--

CREATE TABLE `correpondenciaEntregada` (
  `id` int NOT NULL,
  `idCorrespondenciaFK` int NOT NULL,
  `entregadaA` varchar(50) DEFAULT NULL,
  `area_entrega` varchar(20) DEFAULT NULL,
  `fechaEntrega` datetime NOT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correspondecnia`
--

CREATE TABLE `correspondecnia` (
  `id_correspondencia` int NOT NULL,
  `fecha_llegada` datetime NOT NULL,
  `empresa_transportadora` varchar(30) NOT NULL,
  `destinatario` varchar(20) NOT NULL,
  `remitente` varchar(20) NOT NULL,
  `guarda_recibe_FK` int NOT NULL,
  `Observaciones` varchar(300) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion_guarda_evento`
--

CREATE TABLE `cotizacion_guarda_evento` (
  `id_cotizacion` int NOT NULL,
  `nombre_guarda_adicional` varchar(30) NOT NULL,
  `cc_guarda_adicional` int NOT NULL,
  `evento_FK` int NOT NULL,
  `valor_cotizado` decimal(10,0) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `danios`
--

CREATE TABLE `danios` (
  `id_danio` int NOT NULL,
  `lugarFK` int NOT NULL,
  `nomObjAfectado` varchar(30) NOT NULL,
  `causa` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `informante` varchar(30) NOT NULL,
  `fechaSuceso` datetime NOT NULL,
  `observacion` varchar(300) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `danios`
--

INSERT INTO `danios` (`id_danio`, `lugarFK`, `nomObjAfectado`, `causa`, `estado`, `informante`, `fechaSuceso`, `observacion`, `fechaRegistroSystem`) VALUES
(1, 7, 'Cerradura', 'MANIPULACION INCORRECTA', 'Programada', 'Ama de LLaves.', '2023-07-07 00:00:00', 'Se programa para reparacion', '2023-07-04 11:20:08'),
(2, 10, 'Cajilla', 'MANIPULACION INCORRECTA', 'Programada', 'Ama de LLaves.', '2023-07-06 00:00:00', 'Se programa para reparacion', '2023-07-07 10:21:52'),
(4, 7, 'Cajilla de seguridad', 'Golpe del huesped', 'Dañado', 'Huesped', '2023-07-07 00:00:00', 'El huesped infomra que la golpeo sin querer y que se hara responsable de los gastos', '2023-07-07 10:22:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `tipo`) VALUES
(1, 'Servientrega', 'Transportadora'),
(2, 'Deprisa', 'Transportadora'),
(3, 'Inter Rapidicimo', 'Transportadora'),
(4, 'DHL', 'Transportadora'),
(5, 'FedEx', 'Transportadora'),
(6, 'Alpha', 'Contratista'),
(7, 'Postobon', 'Proveedor'),
(8, 'TranseOp', 'Proveedor'),
(9, 'Securyta', 'Contratista'),
(10, 'Bamcolombia', 'Proveedor'),
(11, 'Rappi', 'Proveedor'),
(12, 'EventsCol', 'Contratista'),
(13, 'ColSecurity', 'Proveedor'),
(14, 'SegurosBolivar', 'Contratista'),
(15, 'ISOPTIC', 'Contratista'),
(16, 'TKE', 'Contratista'),
(17, 'TRANSBANK', 'Contratista'),
(18, 'HOBART', 'Contratista'),
(19, 'IIA RECIDUOS ORGANICOS ', 'Contratista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enviados_empresas`
--

CREATE TABLE `enviados_empresas` (
  `id_registro` int NOT NULL,
  `nombre_persona_enviada` varchar(20) DEFAULT NULL,
  `apellido_persona_enviada` varchar(20) DEFAULT NULL,
  `area_destino` varchar(20) DEFAULT NULL,
  `fecha_start` datetime NOT NULL,
  `fecha_end` datetime DEFAULT NULL,
  `empresa_FK` int NOT NULL,
  `autorizado_por_FK` int NOT NULL,
  `guardaEn_turno_FK` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_reuniones`
--

CREATE TABLE `eventos_reuniones` (
  `id_evento` int NOT NULL,
  `nombre_evento` varchar(30) NOT NULL,
  `tipo_evento` varchar(30) NOT NULL,
  `empresa_montajeFK` int DEFAULT NULL,
  `fecha_montaje_evento` datetime DEFAULT NULL,
  `fecha_inicio_evento` datetime NOT NULL,
  `fecha_fin_evento` datetime DEFAULT NULL,
  `lugarFK` int NOT NULL,
  `vendedor_salon` varchar(30) NOT NULL,
  `duenio_evento` varchar(30) NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `eventos_reuniones`
--
DELIMITER $$
CREATE TRIGGER `trigger_fechaMontajeNull` BEFORE INSERT ON `eventos_reuniones` FOR EACH ROW BEGIN
    IF (NEW.empresa_montajeFK IS NULL) THEN
        SET NEW.fecha_montaje_evento = NULL;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `investigacion`
--

CREATE TABLE `investigacion` (
  `id` int NOT NULL,
  `motivo` varchar(30) DEFAULT NULL,
  `quienSolicita` varchar(50) DEFAULT NULL,
  `quienAutoriza_FK` int NOT NULL,
  `lugarFK` int NOT NULL,
  `investigadoPor` varchar(50) DEFAULT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime DEFAULT NULL,
  `finalizada` varchar(2) DEFAULT NULL,
  `aprehension` varchar(2) NOT NULL,
  `observaciones_resultado` varchar(300) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ;

--
-- Volcado de datos para la tabla `investigacion`
--

INSERT INTO `investigacion` (`id`, `motivo`, `quienSolicita`, `quienAutoriza_FK`, `lugarFK`, `investigadoPor`, `inicio`, `fin`, `finalizada`, `aprehension`, `observaciones_resultado`, `fechaRegistroSystem`) VALUES
(1, 'MaletinExtraño', 'Supervisora del toboso', 1073199276, 15, 'Seguridad.', '2023-07-02 16:22:56', '2023-07-04 16:22:55', 'SI', 'NO', 'Se encontro un malentin extraño en el sonato, se investiga quien lo dejo.\r\nLa investigacion arroja que fue un cliente que lo olvido mientras discutia con una mujer...', '2023-07-05 16:22:55'),
(2, 'Investigacion 5', 'Ever Viloria', 1003071505, 15, 'Seguridad.', '2023-07-02 16:22:56', '2023-07-04 16:22:55', 'SI', 'NO', 'Investigacion de prueba, se tirara', '2023-07-05 16:55:06'),
(4, 'Investigacion 666', 'Viloria Ever', 1003071505, 11, 'Secuirity.', '2023-07-01 16:22:56', '2023-07-07 16:22:55', 'SI', 'NO', 'Investigacion de prueba, se tirara, si huvo capturado', '2023-07-05 17:15:36'),
(7, 'El cacho', 'Pascual', 1003071505, 15, 'Seguridad CAM', '2023-06-27 00:00:00', '2023-07-05 00:00:00', 'Si', 'No', 'A pascual le dijeron que vieron a ofelia y al macho, en la enfermeria. quiere revisar las camaras pa ve si es cachona: La investigacion Lo confirma, Ehs CACHONA LA MALPARIDA', '2023-07-05 19:42:52'),
(14, 'HURTO', 'gerente', 1003071505, 13, 'Alpha', '2023-07-06 00:00:00', '2023-07-06 14:38:49', 'NO', 'NO', 'Se investiga un el hurto del obj reportado por la victima Nidia Guti el 2023-07-05', '2023-07-06 00:36:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `investigacion_reporteHurto`
--

CREATE TABLE `investigacion_reporteHurto` (
  `id` int NOT NULL,
  `reporteHurto_FK` int NOT NULL,
  `investigacion_FK` int NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `investigacion_reporteHurto`
--

INSERT INTO `investigacion_reporteHurto` (`id`, `reporteHurto_FK`, `investigacion_FK`, `fechaRegistroSystem`) VALUES
(4, 1, 14, '2023-07-06 17:54:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int NOT NULL,
  `usr` varchar(50) NOT NULL,
  `passw` varchar(30) NOT NULL,
  `cc_personaFK` int NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `usr`, `passw`, `cc_personaFK`, `fechaRegistroSystem`) VALUES
(1, 'eViloria520', 'CasiBueno3000', 1003071505, '2023-06-30 06:33:59'),
(2, 'eViloria1997', 'ElBotsito300', 1073199276, '2023-06-30 06:33:59'),
(3, 'Vecindad@chavo8.com', 'DonBarriga', 7465789, '2023-07-04 10:59:59'),
(4, 'Miguelcervantes@quijote.com', 'DulcineaDeltoboso', 13486765, '2023-07-04 10:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `id` int NOT NULL,
  `tipoLugar` varchar(20) NOT NULL,
  `padre` varchar(30) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id`, `tipoLugar`, `padre`, `nombre`) VALUES
(1, 'Principal', NULL, 'H201'),
(2, 'Principal', NULL, 'H202'),
(3, 'Principal', NULL, 'H203'),
(4, 'Principal', NULL, 'H204'),
(5, 'Principal', NULL, 'H205'),
(6, 'Principal', NULL, 'H206'),
(7, 'Principal', NULL, 'H207'),
(8, 'Principal', NULL, 'H208'),
(9, 'Principal', NULL, 'H209'),
(10, 'Principal', NULL, 'H210'),
(11, 'Principal', NULL, 'H211'),
(12, 'Principal', NULL, 'Sotano1'),
(13, 'Principal', NULL, 'Sotano2'),
(14, 'Principal', NULL, 'Sotano3'),
(15, 'Principal', NULL, 'Enfermeria');

--
-- Disparadores `lugares`
--
DELIMITER $$
CREATE TRIGGER `set_colum_padre_null` BEFORE INSERT ON `lugares` FOR EACH ROW BEGIN
IF (UPPER(new.tipoLugar = 'PRINCIPAL')) THEN
SET new.padre = NULL;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoIN`
--

CREATE TABLE `movimientoIN` (
  `id_movimiento` int NOT NULL,
  `guardaTurno` int NOT NULL,
  `personaDevuelve` varchar(50) NOT NULL,
  `ccPersonaDevuelve` int NOT NULL,
  `serialActivo` int NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `fechaIngreso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movimientoIN`
--

INSERT INTO `movimientoIN` (`id_movimiento`, `guardaTurno`, `personaDevuelve`, `ccPersonaDevuelve`, `serialActivo`, `observacion`, `fechaIngreso`) VALUES
(1, 7465789, 'Daniel muñoz', 14646515, 3, 'El activo lo devuelve el hermano de la persona que retiro, debido a que no pudo traerlo en persona', '2023-06-30 04:21:52'),
(2, 7465789, 'Maria  nieves', 1003071555, 1, 'El activo lo devuelve la EX-NOVIA de la persona que retiro, por un favor(Estas son pruebas)', '2023-06-30 05:29:51'),
(3, 12345678, 'Sr Daniel Rojas', 102340, 10, 'Ya se realizo el mantenimiento,(cambio de sillas y llantas)', '2023-07-04 04:06:31'),
(4, 32568948, 'Sr David Vilbao', 1031357, 4, 'Regresa la impresora con tintas nuvas y mantenimiento de limpieza y en los rodillos', '2023-07-04 03:32:09'),
(5, 12345678, 'Sr lilia Bustamante', 302155, 12, 'Regresa el extintor con el contenido renovado', '2023-07-04 03:38:04'),
(6, 7465789, 'Sr juan venavidez', 1203241, 11, 'Termino trabajo en casa, y devuelve el activo, sin novedad.', '2023-07-04 03:40:16');

--
-- Disparadores `movimientoIN`
--
DELIMITER $$
CREATE TRIGGER `activoEntra` AFTER INSERT ON `movimientoIN` FOR EACH ROW BEGIN 
 UPDATE  activos set enPosecion='si' WHERE num_serial = new.serialActivo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `corrigeErrorHumanoIn` BEFORE UPDATE ON `movimientoIN` FOR EACH ROW BEGIN 
 UPDATE  activos set enPosecion='no' WHERE num_serial = old.serialActivo;
 UPDATE  activos set enPosecion='si' WHERE num_serial = new.serialActivo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoOUT`
--

CREATE TABLE `movimientoOUT` (
  `id_movimiento` int NOT NULL,
  `autorizadoPOR` int NOT NULL,
  `guardaTurno` int NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `personaRetira` varchar(30) NOT NULL,
  `ccPersonaRetita` int NOT NULL,
  `areaPersonaRetira` varchar(20) DEFAULT NULL,
  `serialActivo` int NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `fechaRetiro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movimientoOUT`
--

INSERT INTO `movimientoOUT` (`id_movimiento`, `autorizadoPOR`, `guardaTurno`, `motivo`, `personaRetira`, `ccPersonaRetita`, `areaPersonaRetira`, `serialActivo`, `observacion`, `fechaRetiro`) VALUES
(1, 1003071505, 32568948, 'Se retira activo para trabajo del empleado en CASA por 6 meses.', 'Julian Benavides', 1548794, 'Sguridad.', 2, 'Retiro Con normalidad..', '2023-06-29 19:19:08'),
(2, 1073199276, 32568948, 'Se retira activo para trabajo del empleado en casa', 'Rocinante el rapido', 123456486, 'carga', 1, 'Retiro Con normalidad.', '2023-06-29 19:19:08'),
(3, 1003071505, 32568948, 'Mantenimiento', 'Luis diaz El monje', 13546854, 'mantenimiento', 4, 'Se retira para agregar tintas y cambiar el rodillo', '2023-06-29 22:27:53'),
(4, 1003071505, 32568948, 'Mantenimiento', 'Tecnico Crucial', 897546, 'mantenimiento', 3, 'Se retira formatear', '2023-06-30 03:50:56'),
(5, 1003071505, 12345678, 'Mantenimiento', 'James_Y_aldemar', 65488, 'chambones', 11, 'Lo hacemos para provar  el movimiento IN', '2023-07-03 09:42:16'),
(6, 13486765, 7465789, 'Limpieza y Relleno', 'Rafael Nuñez', 1354644, 'Mantenimiento', 12, 'Se saca para limpiar y cambiar relleno porque ya esta por vencer la fecha..', '2023-07-03 14:50:33'),
(7, 13486765, 12345678, 'Mantenimiento', 'Oracio gomez', 3254, 'Mantenimiento', 7, 'Se saca para mantenimiento, tiene teclas duras.', '2023-07-03 21:51:15'),
(8, 13486765, 12345678, 'Recargar', 'Jaime  portillo', 354890, 'Mantenimiento', 1, 'Camara se descargo, se lleva a cambiar la pila que es interna', '2023-07-03 22:27:25'),
(10, 13486765, 12345678, 'Mantenimiento', 'Tecnico Rojas', 12346565, 'Mantenimiento', 10, 'Se le van a cambiar las llantas y los cojines', '2023-07-04 01:17:03');

--
-- Disparadores `movimientoOUT`
--
DELIMITER $$
CREATE TRIGGER `activoSale` AFTER INSERT ON `movimientoOUT` FOR EACH ROW BEGIN 
 UPDATE  activos set enPosecion='no' WHERE num_serial = new.serialActivo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `corrigeErrorHumano` BEFORE UPDATE ON `movimientoOUT` FOR EACH ROW BEGIN 
 UPDATE  activos set enPosecion='si' WHERE num_serial = old.serialActivo;
 UPDATE  activos set enPosecion='no' WHERE num_serial = new.serialActivo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedadesDiarias`
--

CREATE TABLE `novedadesDiarias` (
  `id` int NOT NULL,
  `novedad` varchar(30) DEFAULT NULL,
  `lugarFK` int NOT NULL,
  `accionar` varchar(30) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `fechaSuceso` datetime NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `novedadesDiarias`
--

INSERT INTO `novedadesDiarias` (`id`, `novedad`, `lugarFK`, `accionar`, `observaciones`, `fechaSuceso`, `fechaRegistroSystem`) VALUES
(1, 'RACK  PUERTA ABIERTA', 12, 'SE REALIZA CIERRE', 'SE EVIDENCIA CUARTO RACK ABIERTO JUNTO CON EL ARMARIO METALICO DE MANEJO DE TALANQUERAS, SE INFORMA AL SEÑOR ELKIN DE LA EMPRESA ISPTIC', '2023-04-06 11:36:44', '2023-07-04 11:36:44'),
(2, 'Basura Habitacion', 2, 'Se informa al ama llaves', 'El huesped, nos informa que habian paquetes en la cama, se le informa al ama de llaves para que proceda.', '2023-07-04 13:34:16', '2023-07-04 13:34:16'),
(3, 'Talanquera Falla', 12, 'Se informa mantenimiento', 'Guarda de turno, informa que la talanquera no funcionaba, se le llama a mantenimiento y corrigen la falla.', '2023-07-04 13:34:16', '2023-07-04 13:34:16'),
(4, 'Animales dentro', 13, 'Se llama A flora y fauna', 'Por la puestra del sotano 2, ingresaron dos mapaches agresivos. se informa a flora y fauna, y vienen a retirarlos.', '2023-07-04 13:43:17', '2023-07-04 13:43:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obj`
--

CREATE TABLE `obj` (
  `id` int NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `contenido` varchar(200) DEFAULT NULL,
  `valor` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `obj`
--

INSERT INTO `obj` (`id`, `nombre`, `marca`, `contenido`, `valor`) VALUES
(1, 'Iphone 14', 'Apple', 'SSD 1TB, SIM TIGO.', '2500000.000'),
(9, 'Morrarl', 'Totto', 'Billetera con documentos, y un mp4, y un par de libretas', '700000.000'),
(10, 'Memoria USB', 'Kingstone', '1TB, documentos sensibes', '200000.000'),
(11, 'Cargador', 'Xiaomi', 'Cargador rojo', '60000.000'),
(12, 'Libro Medicina', 'OpenWord', 'Libro de medicina rojo de franja blanca vertival', '160000.000'),
(13, 'Reloj', 'Cassio', 'Reloj plateado marca casio en perfecto estado', '300000.000'),
(14, 'Portatil', 'Lenovo', 'Portatil rojo lenovo, en perfectas condiciones, esta en un forro rojo.', '1800000.000'),
(15, 'Casco', 'Sclp', 'Casco de motocicleta verde con negro', '1000000.000'),
(16, 'Cadena', 'Plata', 'Cadena de plata trenzada con dijen de cruz', '250000.000'),
(17, 'Mause', 'Assus', 'Mause gamer inalambrico  de color negro y luces led', '150000.000'),
(18, 'billetera', 'velez', 'documentos, $350000 en efectivo, tarjetas y llave de acceso a la oficina', '1000000.000'),
(19, 'Obj1', 'De juguete', 'Haciendo pruebas', NULL),
(20, 'Obj2', 'De juguete', 'Haciendo pruebas', NULL),
(21, 'Obj3', 'De juguete', 'Haciendo pruebas', NULL),
(22, 'Obj4', 'De juguete', 'Haciendo pruebas', NULL),
(23, 'Obj', 'De juguete', 'Haciendo pruebas', NULL),
(24, 'Gafas', 'Vittorio', '...', '450000.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objEntregado`
--

CREATE TABLE `objEntregado` (
  `id` int NOT NULL,
  `objetoFK` int NOT NULL,
  `entrgadoPor_FK` int NOT NULL,
  `entregadoA` varchar(50) NOT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `fechaSuceso` datetime NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `objEntregado`
--

INSERT INTO `objEntregado` (`id`, `objetoFK`, `entrgadoPor_FK`, `entregadoA`, `observaciones`, `fechaSuceso`, `fechaRegistroSystem`) VALUES
(2, 10, 3012648, 'El Bebe Viloria', 'Se encontro en el baño', '2023-07-05 01:29:29', '2023-07-05 01:34:45'),
(3, 11, 32568948, 'Juan Hernandez.....', 'Estaba debajo del sauna, se le entrego al dueño juan hernandez', '2023-07-05 01:52:18', '2023-07-05 01:52:18'),
(4, 1, 13486765, 'Karol Estupiñan', 'El celular se encontro cerca de la piscina, se le entrega a la dueña en persona', '2023-07-05 00:00:00', '2023-07-05 03:58:33'),
(5, 24, 1003071505, 'Eugenis yanes', 'Las gafas se le entregan al dueño ne persona, estaban en la camilla', '2023-07-05 00:00:00', '2023-07-05 08:12:52'),
(6, 17, 1073199276, 'Florinda mesa', 'Se encontro el mouse en la talanquera, se le entrega en persona el dueño', '2023-07-05 00:00:00', '2023-07-05 08:15:41'),
(7, 19, 1234590, 'Borrar', 'Se entrega el objeto, falso reporte de robo, se evidencia en camara, que se le callo enntarndo al sauna', '2023-07-05 00:00:00', '2023-07-05 10:51:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocupacion_from_recepcion`
--

CREATE TABLE `ocupacion_from_recepcion` (
  `id` int NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `numCheckIn` int DEFAULT NULL,
  `numCheckOut` int DEFAULT NULL,
  `ocupacion` int DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  `vip` int DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ocupacion_from_recepcion`
--

INSERT INTO `ocupacion_from_recepcion` (`id`, `fechaRegistro`, `numCheckIn`, `numCheckOut`, `ocupacion`, `porcentaje`, `vip`, `fechaRegistroSystem`) VALUES
(1, '2023-05-02 11:31:13', 55, 33, 169, 57.2, 2, '2023-07-04 11:31:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_interno`
--

CREATE TABLE `personal_interno` (
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `cc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personal_interno`
--

INSERT INTO `personal_interno` (`nombre`, `apellido`, `cargo`, `cc`) VALUES
('ADRIANA', 'TRUJILLO', 'RECEPCIONISTA', 1234590),
('GERARDO', 'CASTILLO', 'RECEPCIONISTA', 3012648),
('Edgar ', 'Vivar', 'Guarda', 7465789),
('JESICA', 'LENIS', 'RECEPCIONISTA', 10323454),
('Ruben', 'Aguire', 'Guarda', 12345678),
('Dulcinea', 'Del Toboso', 'Supervisor', 13486765),
('Quijote', 'De La Mancha', 'Guarda', 32568948),
('Carlos', 'VillaGran', 'Supervisor', 103245685),
('Ever', 'Viloria', 'Gerente', 1003071505),
('Erick', 'Viloria', 'Gerente', 1073199276);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntoDe_pago`
--

CREATE TABLE `puntoDe_pago` (
  `id` int NOT NULL,
  `base_diaria` decimal(10,3) DEFAULT NULL,
  `efectivo` decimal(10,3) DEFAULT NULL,
  `targ_credito` decimal(10,3) DEFAULT NULL,
  `targ_debito` decimal(10,3) DEFAULT NULL,
  `total_venta` decimal(10,3) DEFAULT NULL,
  `cc_cajero_persona_FK` int NOT NULL,
  `observacion` varchar(300) DEFAULT NULL,
  `fecha_pago` datetime NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteExtravio`
--

CREATE TABLE `reporteExtravio` (
  `idReporte` int NOT NULL,
  `objExtraviadoFK` int NOT NULL,
  `lugarFK` int NOT NULL,
  `victimaFK` int NOT NULL,
  `quienReporta` varchar(50) NOT NULL,
  `fechaSuceso` datetime NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `reporteExtravio`
--

INSERT INTO `reporteExtravio` (`idReporte`, `objExtraviadoFK`, `lugarFK`, `victimaFK`, `quienReporta`, `fechaSuceso`, `fechaRegistroSystem`) VALUES
(1, 1, 4, 10034568, 'Victima.', '2023-07-05 00:41:50', '2023-07-04 11:26:31'),
(2, 9, 13, 10324578, 'Victima', '2023-07-05 01:18:53', '2023-07-05 01:18:53'),
(3, 10, 3, 1003071504, 'Victima', '2023-07-05 01:27:51', '2023-07-05 01:27:51'),
(4, 11, 10, 1245978, 'Victima', '2023-07-05 01:27:51', '2023-07-05 01:27:51'),
(5, 15, 1, 575453, 'Victima', '2023-07-05 06:41:22', '2023-07-05 06:41:22'),
(6, 16, 1, 575453, 'Victima', '2023-07-05 06:41:22', '2023-07-05 06:41:22'),
(7, 18, 1, 575453, 'Victima', '2023-07-05 06:41:22', '2023-07-05 06:41:22'),
(8, 12, 5, 194570, 'Victima', '2023-07-05 06:45:54', '2023-07-05 06:45:54'),
(9, 17, 6, 103534, 'Victima.', '2023-07-05 06:48:51', '2023-07-05 06:48:51'),
(10, 24, 15, 12345678, 'La victima', '2023-07-03 00:00:00', '2023-07-05 08:10:18'),
(11, 17, 12, 1035188, 'La victima', '2023-07-05 00:00:00', '2023-07-05 08:14:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteHurto`
--

CREATE TABLE `reporteHurto` (
  `idReporte` int NOT NULL,
  `objExtraviadoFK` int NOT NULL,
  `lugarFK` int NOT NULL,
  `victimaFK` int NOT NULL,
  `modalidadRobo` varchar(20) NOT NULL,
  `fechaSuceso` datetime NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `reporteHurto`
--

INSERT INTO `reporteHurto` (`idReporte`, `objExtraviadoFK`, `lugarFK`, `victimaFK`, `modalidadRobo`, `fechaSuceso`, `fechaRegistroSystem`) VALUES
(1, 13, 13, 103534, 'Cosquilleo', '2023-07-05 00:00:00', '2023-07-05 10:02:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_arqueo`
--

CREATE TABLE `reporte_arqueo` (
  `id_registro` int NOT NULL,
  `fecha_arqueo` datetime NOT NULL,
  `lugarFK` int NOT NULL,
  `guardaFK` int NOT NULL,
  `num_M` int NOT NULL,
  `num_C` int NOT NULL,
  `num_B` int NOT NULL,
  `total` int NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `reporte_arqueo`
--

INSERT INTO `reporte_arqueo` (`id_registro`, `fecha_arqueo`, `lugarFK`, `guardaFK`, `num_M`, `num_C`, `num_B`, `total`, `observacion`, `fechaRegistroSystem`) VALUES
(1, '2023-07-04 11:27:47', 12, 7465789, 15, 16, 56, 87, 'Sin novedad', '2023-07-04 11:27:47'),
(2, '2023-07-04 11:27:47', 13, 7465789, 32, 10, 25, 67, 'Sin novedad', '2023-07-04 11:27:47'),
(3, '2023-07-04 11:27:47', 14, 7465789, 54, 26, 19, 99, 'Sin novedad', '2023-07-04 11:27:47'),
(4, '2023-07-06 00:00:00', 12, 12345678, 242, 242, 353, 837, 'Sin novedad', '2023-07-06 22:33:46'),
(5, '2023-07-06 00:00:00', 13, 7465789, 31, 16, 92, 139, 'Sin novedad', '2023-07-06 22:35:00'),
(6, '2023-07-05 00:00:00', 14, 32568948, 25, 0, 25, 50, 'Sin Novedad', '2023-07-06 22:45:27'),
(7, '2023-07-05 00:00:00', 12, 32568948, 25, 0, 25, 50, 'Sin novedad', '2023-07-06 22:47:20');

--
-- Disparadores `reporte_arqueo`
--
DELIMITER $$
CREATE TRIGGER `calculaTotal_Arqueo` BEFORE INSERT ON `reporte_arqueo` FOR EACH ROW BEGIN
  SET NEW.total = NEW.num_M + NEW.num_B + NEW.num_C;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimiento_casual`
--

CREATE TABLE `requerimiento_casual` (
  `id_requerimiento` int NOT NULL,
  `requerimiento` varchar(30) NOT NULL,
  `lugarFK` int NOT NULL,
  `quien_informa` varchar(50) NOT NULL,
  `area_requerimiento` varchar(15) DEFAULT NULL,
  `accion` varchar(100) NOT NULL,
  `observacion` varchar(300) DEFAULT NULL,
  `fecha_requerimiento` datetime NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `requerimiento_casual`
--

INSERT INTO `requerimiento_casual` (`id_requerimiento`, `requerimiento`, `lugarFK`, `quien_informa`, `area_requerimiento`, `accion`, `observacion`, `fecha_requerimiento`, `fechaRegistroSystem`) VALUES
(1, 'Primera Prueba', 12, 'Informante Prueba', 'Area prueba', 'Provando', 'Requeriemiento de rueba', '2023-07-06 19:23:37', '2023-07-06 19:23:37'),
(2, 'Limpieza', 3, 'Huesped', 'Liempieza', 'Se procedo a resolver el requerimeinto', 'Huesped Solicita una limpieza enxtra con productos especiales, debido a una condicion de salud', '2023-07-06 19:36:42', '2023-07-06 19:36:42'),
(3, 'Rquest de prueba', 1, 'Ever Vilora', NULL, 'Provar', 'Provando Request UPDATE DEL CLIENTE', '2023-07-05 00:00:00', '2023-07-06 20:14:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicioSXL`
--

CREATE TABLE `servicioSXL` (
  `id` int NOT NULL,
  `lugarFK` int NOT NULL,
  `nombreHuesped` varchar(30) NOT NULL,
  `personaRecepcionFK` int NOT NULL,
  `inicio_servicio` datetime NOT NULL,
  `fin_servicio` datetime DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadoresSXL`
--

CREATE TABLE `trabajadoresSXL` (
  `cc` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `genero` enum('H','M') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `trabajadoresSXL`
--

INSERT INTO `trabajadoresSXL` (`cc`, `nombre`, `apellido`, `genero`) VALUES
(29675534, 'MARTHA VIVIANA', 'EUSSE RODRIGUEZ', 'M'),
(1001046841, 'PAULA ', 'FAJARDO', 'M'),
(1001345749, 'JEIMMY', 'ROMERO', 'M'),
(1014284327, 'LORENA', 'INFANTE', 'M'),
(1019153063, 'VIVIANA', 'ORDOSGOITIA PINZON', 'M'),
(1020757734, 'HELENE ', 'MEDINA', 'M'),
(1032487015, 'CAMILA ANDREA', 'QUIÑONES CASTILLO', 'M'),
(1076666681, 'LAURA', 'MAHECHA', 'M'),
(1126710909, 'MARIA', 'VERDI', 'M'),
(1143362233, 'MARIA', 'MIRANDA', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadoresSxl_ServicioSEXL`
--

CREATE TABLE `trabajadoresSxl_ServicioSEXL` (
  `id_registro` int NOT NULL,
  `trabajadorSXL_FK` int NOT NULL,
  `id_servicioSXL_FK` int NOT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `victima`
--

CREATE TABLE `victima` (
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cc` int NOT NULL,
  `cargo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `victima`
--

INSERT INTO `victima` (`nombre`, `apellido`, `cc`, `cargo`) VALUES
('Nidia', 'Guti', 103534, 'Huesped'),
('Nicolas', 'Zuarez', 194570, 'Huesped'),
('Espiridion', 'Cascajo', 575453, 'Huesped'),
('Diana', 'Gonzales', 1024879, 'Huesped'),
('Florinda', 'Meza', 1035188, 'Huesped'),
('Juan ', 'Hernandez', 1245978, 'Huesped'),
('Reneh', 'Higuita', 1355353, 'Huesped'),
('Pridencio', 'Benites', 2313545, 'Hues'),
('Karla', 'Stupiñan', 10034568, 'Huesped'),
('Daniela', 'Bustamante', 10324578, 'Huesped'),
('Eugenis ', 'Yanes', 12345678, 'Profesor'),
('Jesus ', 'Viloria', 1003071504, 'Huesped');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitasEspeciales`
--

CREATE TABLE `visitasEspeciales` (
  `id_Visita` int NOT NULL,
  `nombreVisitante` varchar(30) NOT NULL,
  `ocupacionVisitante` varchar(30) NOT NULL,
  `nacionalidad` varchar(30) DEFAULT NULL,
  `motivoVisita` varchar(30) DEFAULT NULL,
  `lugarFK` int NOT NULL,
  `fechaIn` datetime NOT NULL,
  `fechaOut` datetime DEFAULT NULL,
  `Observacion` varchar(200) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `visitasEspeciales`
--

INSERT INTO `visitasEspeciales` (`id_Visita`, `nombreVisitante`, `ocupacionVisitante`, `nacionalidad`, `motivoVisita`, `lugarFK`, `fechaIn`, `fechaOut`, `Observacion`, `fechaRegistroSystem`) VALUES
(1, 'Dady Yankee', 'Cantante', 'Puerto Rico', 'Hospedaje', 3, '2023-07-01 11:42:05', '2023-07-04 11:42:05', 'Todo trascurre con normalidad', '2023-07-04 11:42:05'),
(2, 'Rihanna', 'Cantante', 'barbadense', 'Evento', 5, '2023-07-06 05:33:59', '2023-07-06 15:33:59', 'Llego para una reunion ccon su equipo de trabajo, se fue el mimo dia', '2023-07-06 15:33:59'),
(4, 'David Ospina', 'Futbolista', 'Colombia', 'Hospedaje', 5, '2023-07-06 00:00:00', NULL, 'Llego junto a quintero, a la misma habitacion', '2023-07-06 16:21:10'),
(5, 'Jhon Leyend', 'Cantante', 'EEUU', 'Hospedaje', 11, '2023-07-06 02:33:59', '2023-07-06 16:49:06', 'Nos pide tranquilidad, cero prensa, cero aficionados', '2023-07-06 16:24:12'),
(6, 'Radamel Falcao', 'Futbolista', 'Colombia', 'Hospedaje', 5, '2023-07-06 00:00:00', NULL, 'Llego junto a quintero, a la misma habitacion', '2023-07-06 16:29:30'),
(7, 'James Rodriguez', 'Futbolista', 'Colombia', 'Hospedaje', 5, '2023-07-06 00:00:00', NULL, 'Llego junto a quintero, a la misma habitacion', '2023-07-06 16:30:16'),
(8, 'Juan fernando quintero', 'Futbolista', 'Colimbia', 'Hoespedaje', 5, '2023-07-06 00:00:00', NULL, '...', '2023-07-06 16:31:20'),
(14, 'Ever Viloria', 'Gerente General', 'Colombia', 'Hospedaje', 8, '2023-07-06 00:00:00', NULL, 'No molestar', '2023-07-06 16:56:36'),
(15, 'Cristiano Ronaldo', 'Futbolista', 'Portugal', 'Hospedaje', 9, '2023-07-06 00:00:00', NULL, '...', '2023-07-06 16:58:01'),
(16, 'Ramona Negrete', 'Ama de casa', 'Colombia', 'Hospedaje', 6, '2023-07-06 00:00:00', '2023-07-06 17:13:33', '...', '2023-07-06 17:13:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas_enfermeria`
--

CREATE TABLE `visitas_enfermeria` (
  `id_suceso` int NOT NULL,
  `nombre_paciente` varchar(20) NOT NULL,
  `apellido_paciente` varchar(20) NOT NULL,
  `area_paciente` varchar(20) DEFAULT NULL,
  `motivo_visita` varchar(50) NOT NULL,
  `lugarFK` int DEFAULT NULL,
  `accionar` varchar(30) NOT NULL,
  `fecha_visita` datetime NOT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `fechaRegistroSystem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `visitas_enfermeria`
--

INSERT INTO `visitas_enfermeria` (`id_suceso`, `nombre_paciente`, `apellido_paciente`, `area_paciente`, `motivo_visita`, `lugarFK`, `accionar`, `fecha_visita`, `observaciones`, `fechaRegistroSystem`) VALUES
(1, 'Isa maria', 'Lopez', 'Huesped', 'Desmayo', 7, 'Primeros Auxilios', '2023-07-04 11:39:57', 'Huesped se desmaya en su habitacion por exceso de alcohol, se atiende y todo fluye sin mayor complicacion, Paciente dado de alta.', '2023-07-04 11:39:57'),
(2, 'Laura', 'Guerrero', 'Huesped', 'Desmayo', 14, 'Primeros Auxilios', '2023-07-06 07:02:54', 'Pasiente se desmaya en el baño, se atiende noral sin mas novedad.', '2023-07-06 07:02:54'),
(3, 'Gina', 'Korano', 'Huesped', 'Diarrea', 7, 'Primeros Auxilios', '2023-07-06 00:00:00', 'Paciente dice que algo le callo mal, acude a enfermeria para desintoxicarse', '2023-07-06 08:20:47'),
(4, 'Sharon', 'Viloria', 'Hueped', 'Diarrea', 11, 'Se suministra pañal', '2023-07-06 14:44:18', 'Acude a enfermeria por pañales y se le da un pediality para la desidratacion', '2023-07-06 13:17:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`num_serial`);

--
-- Indices de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD PRIMARY KEY (`id_capacitacion`),
  ADD KEY `cc_persona_tutor_Fk` (`cc_persona_tutor_Fk`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- Indices de la tabla `controlSupervisor`
--
ALTER TABLE `controlSupervisor`
  ADD PRIMARY KEY (`id_registroSession`),
  ADD KEY `cc_persona_SupFK` (`cc_persona_SupFK`);

--
-- Indices de la tabla `correpondenciaEntregada`
--
ALTER TABLE `correpondenciaEntregada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCorrespondenciaFK` (`idCorrespondenciaFK`);

--
-- Indices de la tabla `correspondecnia`
--
ALTER TABLE `correspondecnia`
  ADD PRIMARY KEY (`id_correspondencia`),
  ADD KEY `guarda_recibe_FK` (`guarda_recibe_FK`);

--
-- Indices de la tabla `cotizacion_guarda_evento`
--
ALTER TABLE `cotizacion_guarda_evento`
  ADD PRIMARY KEY (`id_cotizacion`),
  ADD KEY `evento_FK` (`evento_FK`);

--
-- Indices de la tabla `danios`
--
ALTER TABLE `danios`
  ADD PRIMARY KEY (`id_danio`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `enviados_empresas`
--
ALTER TABLE `enviados_empresas`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `empresa_FK` (`empresa_FK`),
  ADD KEY `autorizado_por_FK` (`autorizado_por_FK`),
  ADD KEY `guardaEn_turno_FK` (`guardaEn_turno_FK`);

--
-- Indices de la tabla `eventos_reuniones`
--
ALTER TABLE `eventos_reuniones`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `empresa_montajeFK` (`empresa_montajeFK`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- Indices de la tabla `investigacion`
--
ALTER TABLE `investigacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lugarFK` (`lugarFK`),
  ADD KEY `quienAutoriza_FK` (`quienAutoriza_FK`);

--
-- Indices de la tabla `investigacion_reporteHurto`
--
ALTER TABLE `investigacion_reporteHurto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investigacion_FK` (`investigacion_FK`),
  ADD KEY `reporteHurto_FK` (`reporteHurto_FK`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usr` (`usr`),
  ADD KEY `cc_personaFK` (`cc_personaFK`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `index_id` (`id`),
  ADD KEY `index_nombre` (`nombre`);

--
-- Indices de la tabla `movimientoIN`
--
ALTER TABLE `movimientoIN`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `guardaTurno` (`guardaTurno`),
  ADD KEY `serialActivo` (`serialActivo`);

--
-- Indices de la tabla `movimientoOUT`
--
ALTER TABLE `movimientoOUT`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `autorizadoPOR` (`autorizadoPOR`),
  ADD KEY `guardaTurno` (`guardaTurno`),
  ADD KEY `serialActivo` (`serialActivo`);

--
-- Indices de la tabla `novedadesDiarias`
--
ALTER TABLE `novedadesDiarias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- Indices de la tabla `obj`
--
ALTER TABLE `obj`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objEntregado`
--
ALTER TABLE `objEntregado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objetoFK` (`objetoFK`),
  ADD KEY `entrgadoPor_FK` (`entrgadoPor_FK`);

--
-- Indices de la tabla `ocupacion_from_recepcion`
--
ALTER TABLE `ocupacion_from_recepcion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_interno`
--
ALTER TABLE `personal_interno`
  ADD PRIMARY KEY (`cc`),
  ADD KEY `index_nombre` (`nombre`),
  ADD KEY `index_cc` (`cc`);

--
-- Indices de la tabla `puntoDe_pago`
--
ALTER TABLE `puntoDe_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cc_cajero_persona_FK` (`cc_cajero_persona_FK`);

--
-- Indices de la tabla `reporteExtravio`
--
ALTER TABLE `reporteExtravio`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `objExtraviadoFK` (`objExtraviadoFK`),
  ADD KEY `lugarFK` (`lugarFK`),
  ADD KEY `victimaFK` (`victimaFK`);

--
-- Indices de la tabla `reporteHurto`
--
ALTER TABLE `reporteHurto`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `objExtraviadoFK` (`objExtraviadoFK`),
  ADD KEY `lugarFK` (`lugarFK`),
  ADD KEY `victimaFK` (`victimaFK`);

--
-- Indices de la tabla `reporte_arqueo`
--
ALTER TABLE `reporte_arqueo`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `guardaFK` (`guardaFK`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- Indices de la tabla `requerimiento_casual`
--
ALTER TABLE `requerimiento_casual`
  ADD PRIMARY KEY (`id_requerimiento`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- Indices de la tabla `servicioSXL`
--
ALTER TABLE `servicioSXL`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lugarFK` (`lugarFK`),
  ADD KEY `personaRecepcionFK` (`personaRecepcionFK`);

--
-- Indices de la tabla `trabajadoresSXL`
--
ALTER TABLE `trabajadoresSXL`
  ADD PRIMARY KEY (`cc`);

--
-- Indices de la tabla `trabajadoresSxl_ServicioSEXL`
--
ALTER TABLE `trabajadoresSxl_ServicioSEXL`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `trabajadorSXL_FK` (`trabajadorSXL_FK`),
  ADD KEY `id_servicioSXL_FK` (`id_servicioSXL_FK`);

--
-- Indices de la tabla `victima`
--
ALTER TABLE `victima`
  ADD PRIMARY KEY (`cc`);

--
-- Indices de la tabla `visitasEspeciales`
--
ALTER TABLE `visitasEspeciales`
  ADD PRIMARY KEY (`id_Visita`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- Indices de la tabla `visitas_enfermeria`
--
ALTER TABLE `visitas_enfermeria`
  ADD PRIMARY KEY (`id_suceso`),
  ADD KEY `lugarFK` (`lugarFK`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  MODIFY `id_capacitacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `controlSupervisor`
--
ALTER TABLE `controlSupervisor`
  MODIFY `id_registroSession` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correpondenciaEntregada`
--
ALTER TABLE `correpondenciaEntregada`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correspondecnia`
--
ALTER TABLE `correspondecnia`
  MODIFY `id_correspondencia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cotizacion_guarda_evento`
--
ALTER TABLE `cotizacion_guarda_evento`
  MODIFY `id_cotizacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `danios`
--
ALTER TABLE `danios`
  MODIFY `id_danio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `enviados_empresas`
--
ALTER TABLE `enviados_empresas`
  MODIFY `id_registro` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos_reuniones`
--
ALTER TABLE `eventos_reuniones`
  MODIFY `id_evento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `investigacion`
--
ALTER TABLE `investigacion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `investigacion_reporteHurto`
--
ALTER TABLE `investigacion_reporteHurto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `movimientoIN`
--
ALTER TABLE `movimientoIN`
  MODIFY `id_movimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `movimientoOUT`
--
ALTER TABLE `movimientoOUT`
  MODIFY `id_movimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `novedadesDiarias`
--
ALTER TABLE `novedadesDiarias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `obj`
--
ALTER TABLE `obj`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `objEntregado`
--
ALTER TABLE `objEntregado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ocupacion_from_recepcion`
--
ALTER TABLE `ocupacion_from_recepcion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `puntoDe_pago`
--
ALTER TABLE `puntoDe_pago`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporteExtravio`
--
ALTER TABLE `reporteExtravio`
  MODIFY `idReporte` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reporteHurto`
--
ALTER TABLE `reporteHurto`
  MODIFY `idReporte` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reporte_arqueo`
--
ALTER TABLE `reporte_arqueo`
  MODIFY `id_registro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `requerimiento_casual`
--
ALTER TABLE `requerimiento_casual`
  MODIFY `id_requerimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicioSXL`
--
ALTER TABLE `servicioSXL`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajadoresSxl_ServicioSEXL`
--
ALTER TABLE `trabajadoresSxl_ServicioSEXL`
  MODIFY `id_registro` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `visitasEspeciales`
--
ALTER TABLE `visitasEspeciales`
  MODIFY `id_Visita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `visitas_enfermeria`
--
ALTER TABLE `visitas_enfermeria`
  MODIFY `id_suceso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD CONSTRAINT `capacitaciones_ibfk_1` FOREIGN KEY (`cc_persona_tutor_Fk`) REFERENCES `personal_interno` (`cc`),
  ADD CONSTRAINT `capacitaciones_ibfk_2` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);

--
-- Filtros para la tabla `controlSupervisor`
--
ALTER TABLE `controlSupervisor`
  ADD CONSTRAINT `controlSupervisor_ibfk_1` FOREIGN KEY (`cc_persona_SupFK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `correpondenciaEntregada`
--
ALTER TABLE `correpondenciaEntregada`
  ADD CONSTRAINT `correpondenciaEntregada_ibfk_1` FOREIGN KEY (`idCorrespondenciaFK`) REFERENCES `correspondecnia` (`id_correspondencia`);

--
-- Filtros para la tabla `correspondecnia`
--
ALTER TABLE `correspondecnia`
  ADD CONSTRAINT `correspondecnia_ibfk_1` FOREIGN KEY (`guarda_recibe_FK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `cotizacion_guarda_evento`
--
ALTER TABLE `cotizacion_guarda_evento`
  ADD CONSTRAINT `cotizacion_guarda_evento_ibfk_1` FOREIGN KEY (`evento_FK`) REFERENCES `eventos_reuniones` (`id_evento`);

--
-- Filtros para la tabla `danios`
--
ALTER TABLE `danios`
  ADD CONSTRAINT `danios_ibfk_1` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);

--
-- Filtros para la tabla `enviados_empresas`
--
ALTER TABLE `enviados_empresas`
  ADD CONSTRAINT `enviados_empresas_ibfk_1` FOREIGN KEY (`empresa_FK`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `enviados_empresas_ibfk_2` FOREIGN KEY (`autorizado_por_FK`) REFERENCES `personal_interno` (`cc`),
  ADD CONSTRAINT `enviados_empresas_ibfk_3` FOREIGN KEY (`guardaEn_turno_FK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `eventos_reuniones`
--
ALTER TABLE `eventos_reuniones`
  ADD CONSTRAINT `eventos_reuniones_ibfk_1` FOREIGN KEY (`empresa_montajeFK`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `eventos_reuniones_ibfk_2` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);

--
-- Filtros para la tabla `investigacion`
--
ALTER TABLE `investigacion`
  ADD CONSTRAINT `investigacion_ibfk_1` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `investigacion_ibfk_2` FOREIGN KEY (`quienAutoriza_FK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `investigacion_reporteHurto`
--
ALTER TABLE `investigacion_reporteHurto`
  ADD CONSTRAINT `investigacion_reporteHurto_ibfk_1` FOREIGN KEY (`investigacion_FK`) REFERENCES `investigacion` (`id`),
  ADD CONSTRAINT `investigacion_reporteHurto_ibfk_2` FOREIGN KEY (`reporteHurto_FK`) REFERENCES `reporteHurto` (`idReporte`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`cc_personaFK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `movimientoIN`
--
ALTER TABLE `movimientoIN`
  ADD CONSTRAINT `movimientoIN_ibfk_1` FOREIGN KEY (`guardaTurno`) REFERENCES `personal_interno` (`cc`),
  ADD CONSTRAINT `movimientoIN_ibfk_2` FOREIGN KEY (`serialActivo`) REFERENCES `activos` (`num_serial`);

--
-- Filtros para la tabla `movimientoOUT`
--
ALTER TABLE `movimientoOUT`
  ADD CONSTRAINT `movimientoOUT_ibfk_1` FOREIGN KEY (`autorizadoPOR`) REFERENCES `personal_interno` (`cc`),
  ADD CONSTRAINT `movimientoOUT_ibfk_2` FOREIGN KEY (`guardaTurno`) REFERENCES `personal_interno` (`cc`),
  ADD CONSTRAINT `movimientoOUT_ibfk_3` FOREIGN KEY (`serialActivo`) REFERENCES `activos` (`num_serial`);

--
-- Filtros para la tabla `novedadesDiarias`
--
ALTER TABLE `novedadesDiarias`
  ADD CONSTRAINT `novedadesDiarias_ibfk_1` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);

--
-- Filtros para la tabla `objEntregado`
--
ALTER TABLE `objEntregado`
  ADD CONSTRAINT `objEntregado_ibfk_1` FOREIGN KEY (`objetoFK`) REFERENCES `obj` (`id`),
  ADD CONSTRAINT `objEntregado_ibfk_2` FOREIGN KEY (`entrgadoPor_FK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `puntoDe_pago`
--
ALTER TABLE `puntoDe_pago`
  ADD CONSTRAINT `puntoDe_pago_ibfk_1` FOREIGN KEY (`cc_cajero_persona_FK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `reporteExtravio`
--
ALTER TABLE `reporteExtravio`
  ADD CONSTRAINT `reporteExtravio_ibfk_1` FOREIGN KEY (`objExtraviadoFK`) REFERENCES `obj` (`id`),
  ADD CONSTRAINT `reporteExtravio_ibfk_2` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `reporteExtravio_ibfk_3` FOREIGN KEY (`victimaFK`) REFERENCES `victima` (`cc`);

--
-- Filtros para la tabla `reporteHurto`
--
ALTER TABLE `reporteHurto`
  ADD CONSTRAINT `reporteHurto_ibfk_1` FOREIGN KEY (`objExtraviadoFK`) REFERENCES `obj` (`id`),
  ADD CONSTRAINT `reporteHurto_ibfk_2` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `reporteHurto_ibfk_3` FOREIGN KEY (`victimaFK`) REFERENCES `victima` (`cc`);

--
-- Filtros para la tabla `reporte_arqueo`
--
ALTER TABLE `reporte_arqueo`
  ADD CONSTRAINT `reporte_arqueo_ibfk_1` FOREIGN KEY (`guardaFK`) REFERENCES `personal_interno` (`cc`),
  ADD CONSTRAINT `reporte_arqueo_ibfk_2` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);

--
-- Filtros para la tabla `requerimiento_casual`
--
ALTER TABLE `requerimiento_casual`
  ADD CONSTRAINT `requerimiento_casual_ibfk_1` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);

--
-- Filtros para la tabla `servicioSXL`
--
ALTER TABLE `servicioSXL`
  ADD CONSTRAINT `servicioSXL_ibfk_1` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `servicioSXL_ibfk_2` FOREIGN KEY (`personaRecepcionFK`) REFERENCES `personal_interno` (`cc`);

--
-- Filtros para la tabla `trabajadoresSxl_ServicioSEXL`
--
ALTER TABLE `trabajadoresSxl_ServicioSEXL`
  ADD CONSTRAINT `trabajadoresSxl_ServicioSEXL_ibfk_1` FOREIGN KEY (`trabajadorSXL_FK`) REFERENCES `trabajadoresSXL` (`cc`),
  ADD CONSTRAINT `trabajadoresSxl_ServicioSEXL_ibfk_2` FOREIGN KEY (`id_servicioSXL_FK`) REFERENCES `servicioSXL` (`id`);

--
-- Filtros para la tabla `visitasEspeciales`
--
ALTER TABLE `visitasEspeciales`
  ADD CONSTRAINT `visitasEspeciales_ibfk_1` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);

--
-- Filtros para la tabla `visitas_enfermeria`
--
ALTER TABLE `visitas_enfermeria`
  ADD CONSTRAINT `visitas_enfermeria_ibfk_1` FOREIGN KEY (`lugarFK`) REFERENCES `lugares` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
