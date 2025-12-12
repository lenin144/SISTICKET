-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2024 a las 16:38:27
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calidrap_soporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `supervisor_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `Active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `name`, `supervisor_id`, `created_at`, `Active`) VALUES
(1, 'T.I.', 2, '2021-10-04 21:31:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorycausesolution`
--

CREATE TABLE `categorycausesolution` (
  `idCategoryCauseSolution` int(11) NOT NULL,
  `idCauseSolution` int(11) DEFAULT NULL,
  `idCategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorycausesolution`
--

INSERT INTO `categorycausesolution` (`idCategoryCauseSolution`, `idCauseSolution`, `idCategory`) VALUES
(6, 2, 2),
(8, 1, 1),
(9, 3, 3),
(10, 4, 4),
(11, 5, 5),
(12, 6, 6),
(13, 7, 7),
(14, 8, 8),
(16, 10, 11),
(17, 11, 12),
(18, 12, 12),
(19, 13, 13),
(20, 14, 14),
(21, 15, 15),
(22, 16, 16),
(23, 17, 17),
(24, 18, 18),
(25, 19, 19),
(26, 20, 20),
(27, 21, 21),
(28, 22, 22),
(29, 23, 23),
(30, 24, 24),
(31, 25, 25),
(32, 26, 26),
(33, 27, 27),
(34, 28, 28),
(35, 29, 12),
(36, 30, 29),
(37, 31, 30),
(38, 32, 31),
(39, 33, 32),
(40, 34, 33),
(41, 9, 15),
(42, 35, 34),
(43, 36, 35),
(44, 37, 33),
(45, 38, 36),
(46, 39, 37),
(47, 40, 38),
(48, 41, 39),
(49, 42, 40),
(50, 43, 41),
(51, 44, 42),
(52, 45, 43),
(53, 46, 44),
(54, 47, 45),
(55, 48, 46),
(56, 49, 47),
(57, 50, 12),
(58, 51, 33),
(59, 52, 48),
(60, 53, 49),
(61, 54, 50),
(62, 55, 51),
(63, 56, 52),
(64, 57, 53),
(65, 58, 54),
(66, 59, 55),
(67, 60, 56),
(68, 62, 59),
(69, 63, 60),
(70, 64, 61),
(71, 65, 62),
(72, 66, 58),
(73, 67, 63),
(74, 69, 65),
(75, 70, 66),
(76, 71, 67),
(77, 72, 68),
(78, 73, 57),
(79, 74, 69),
(80, 75, 70),
(81, 76, 71),
(82, 77, 73),
(83, 78, 74),
(84, 79, 75),
(85, 80, 76),
(86, 81, 77),
(87, 82, 23),
(88, 83, 72),
(89, 84, 78),
(90, 85, 79),
(91, 86, 80),
(92, 87, 82),
(93, 88, 83),
(94, 89, 81),
(95, 91, 85),
(96, 92, 86),
(97, 93, 80),
(98, 94, 84),
(99, 95, 87),
(100, 97, 89),
(101, 98, 90),
(102, 99, 92),
(103, 100, 93),
(104, 101, 33),
(105, 102, 94),
(106, 103, 96),
(107, 104, 76),
(108, 105, 97),
(109, 106, 98),
(111, 107, 110),
(112, 108, 99),
(113, 110, 101),
(114, 111, 103),
(115, 112, 104),
(116, 113, 105),
(117, 114, 106),
(118, 115, 107),
(119, 116, 108),
(120, 118, 110),
(121, 119, 111),
(122, 120, 112),
(123, 121, 113),
(124, 122, 114),
(125, 123, 115),
(126, 124, 86),
(127, 125, 116),
(128, 126, 117),
(129, 127, 118),
(130, 128, 109),
(131, 129, 86),
(132, 130, 119),
(133, 131, 120),
(134, 132, 121),
(135, 133, 122),
(136, 134, 123),
(137, 135, 124),
(138, 136, 125),
(139, 137, 126),
(140, 138, 57),
(141, 139, 44),
(142, 140, 129),
(143, 141, 130),
(144, 142, 131),
(145, 143, 132),
(146, 144, 126),
(147, 145, 139),
(148, 146, 141),
(149, 147, 142),
(150, 148, 143),
(151, 149, 144),
(152, 150, 147),
(153, 151, 148),
(154, 152, 145),
(155, 153, 146),
(156, 154, 138),
(157, 155, 133),
(158, 156, 149),
(159, 157, 150),
(160, 158, 86),
(161, 159, 151),
(162, 162, 155),
(163, 163, 156),
(164, 164, 158),
(165, 165, 159),
(166, 166, 158);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causesolution`
--

CREATE TABLE `causesolution` (
  `idCauseSolution` int(11) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `causesolution`
--

INSERT INTO `causesolution` (`idCauseSolution`, `Description`, `Active`) VALUES
(1, 'Impresora configurada', 1),
(2, 'Windows Actualizado', 1),
(3, 'Instalacion antivirus ESET', 1),
(4, 'Instalacion de Office licencia Original', 1),
(5, 'Configuramos Outlook', 1),
(6, 'Herramientas instalados', 1),
(7, 'Limpieza fisica / cambio de peiza', 1),
(8, 'Instalacion de herramientas', 1),
(9, 'Compra de botellas de tinta', 1),
(10, 'Configuracion de excel', 1),
(11, 'Se configuro exitosamente', 1),
(12, 'Se cambio la opciones de uso compartido', 1),
(13, 'Configuración de la función de escaneo a una carpeta de red', 1),
(14, 'Se formateo exitosamente', 1),
(15, 'Se restablecio el equipo', 1),
(16, 'Se retiro exitosamente', 1),
(17, 'Se instalo correctamente', 1),
(18, 'Se utilizo la tecnologia Terabox', 1),
(19, 'Otros', 1),
(20, 'Se configuro correctamente el teams', 1),
(21, 'Herramienta instalado correctamente', 1),
(22, 'Se libero espacio en disco C', 1),
(23, 'Se cambio la caja de mantenimiento por uno nuevo', 1),
(24, 'Se realizo el respaldo con onedrive', 1),
(25, 'Re instalacion de office ', 1),
(26, 'Se recupero archivos con la aplicacion easeUS Data Recovery Wizard', 1),
(27, 'Actualización de driver de audio ', 1),
(28, 'Instalación de forticlient ', 1),
(29, 'Se debe utilizar el One drive para compartir archivos', 1),
(30, 'Se descargo Adobe air en su ultima version ', 1),
(31, 'Se procedio en desbloquear archivo de power point', 1),
(32, 'Cambio de equipo', 1),
(33, 'Se hizo uso de una herramienta online Tools', 1),
(34, 'Mejorar rendimiento borrar temporales, desfragmentar el disco, eliminar los elemento. En caso el dis', 1),
(35, 'Compra de toner para impresora', 1),
(36, 'Equipo se formateo y se hizo una limpieza fisica de la placa', 1),
(37, 'Renovacion de equipo', 1),
(38, 'Verificar que tiene una cuenta Local, de lo contrario crear una y trabajar sobre ella', 1),
(39, 'Se registro una cuenta de autodesk', 1),
(40, 'Renovacion de celular', 1),
(41, 'Se entrega celular y linea nueva', 1),
(42, 'Se dio accesos al BI 360', 1),
(43, 'Se actualizo correctamente el antivirus ESETNOD32', 1),
(44, 'Se instalo correctamente el pdf pro', 1),
(45, 'Se instalo adobe acrobat pdf pro', 1),
(46, 'Ms project', 1),
(47, 'Se reactivo correo', 1),
(48, 'Utilitarios instalados', 1),
(49, 'Se dio de alta en AD', 1),
(50, 'Ya se puede visualizar los archivos en red', 1),
(51, 'Se cambio de disco', 1),
(52, 'Se remplazo por una nueva bateria Dell', 1),
(53, 'Se compro un equipo', 1),
(54, 'Se restablecio la contrasena del correo', 1),
(55, 'Se actualizaron los controladores graficos', 1),
(56, 'Se compro un nuevo adaptador de red', 1),
(57, 'Se intalada un drive controlador para el microfono del teams', 1),
(58, 'Se restablecio el equipo satisfactoriamente', 1),
(59, 'Se paso de windows 11 a windows 11 satisfactoriamente', 1),
(60, 'Se asigno laptop a nuevo personal', 1),
(61, 'Se ha creado correo corporativo exitosamente', 1),
(62, 'Se agrego una licencia a la herramienta Visio', 1),
(63, 'Se inserto memoria RAM de 8GB', 1),
(64, 'Se activo la licencia de Power BI', 1),
(65, 'El mensaje debe estar en formato HTML', 1),
(66, 'Se entrego equipo movil', 1),
(67, 'Se envio respaldo de archivos', 1),
(68, 'Se realizo compra de mouse', 1),
(69, 'El disco fue cambiado exitosamente', 1),
(70, 'Se instalo un visualizador de Autocad', 1),
(71, 'Se dio de baja el correo.', 1),
(72, 'Se realizo el cambio de teclado exitosamente', 1),
(73, 'Se cambio numero de anexo exitosamente', 1),
(74, 'Se compartio archivos, el usuario puede abrirlo desde el explorador de archivos', 1),
(75, 'Se instalo correctamente el AnyConnect', 1),
(76, 'Se dio acceso al correo solicitado', 1),
(77, 'Se activaron el protocolo cliente servidor SMB y habilitamos sesion de invitador¿s no seguros - red ', 1),
(78, 'Use la tecnologia de OneDrive y Power Automate', 1),
(79, 'Se procedio a mejorar los recursos del equipo para ejecutar el sistema MSTRUCK', 1),
(80, 'Se re intalaron los driver', 1),
(81, 'Se restableció el equipo', 1),
(82, 'Se compro caja de mantenimiento para impresora epson', 1),
(83, 'Se dio acceso al servidor de oficina', 1),
(84, 'Se ha creado exitosamente los grupos de contacto', 1),
(85, 'Se conecto al servidor exitosamente', 1),
(86, 'Se configuro correctamente los altavoces y auriculares de la opcion sonido', 1),
(87, 'Se instalo la licencia original de Microsoft Office 365', 1),
(88, 'Se actualizo la Bios Correctamente', 1),
(89, 'Se realizo una limpieza a las partes internas del teclado', 1),
(90, 'Temporalmente se le reasigno una laptop usado', 1),
(91, 'Se re instalo los drivers actualizado de modelo L1455', 1),
(92, 'Abrir con el navegador edge, ir avanzado y hacer clic en ingresar de todas formas', 1),
(93, 'Se tramito la garantía, el equipo de soporte DELL procedio a formatear el equipo', 1),
(94, 'Ya puede cargar el equipo', 1),
(95, 'Para proyectar la pantalla de tu laptop a otra laptop debe dirigirse a configuracion y buscar proyec', 1),
(96, 'Se acorto la ruta', 1),
(97, 'Se instalo una licencia de Adobe Acrobat Pro', 1),
(98, 'Se procedió a instalar la licenia del Ondesk', 1),
(99, 'Se ha creado una regla para cada correo que estan en el grupo', 1),
(100, 'Se corrigio la ruta para guardar los archivos', 1),
(101, 'Se re asigno una nueva laptop', 1),
(102, 'Se asigno una nueva licencia de office', 1),
(103, 'Se agrego una licencia para el antivirus ESETNOD 32', 1),
(104, 'Se compro dos chips para la caja de mantenimiento', 1),
(105, 'Se actualizo los controladores, drivers, Windows y Bios del equipo', 1),
(106, 'Se realizo el proceso de archivado', 1),
(107, 'Se instalo un controlador de wifi', 1),
(108, 'Se compro estabilizador mouse y cable de red', 1),
(109, 'Telefono movil esta bloqueado con el MDM', 1),
(110, 'Se realizo el mantenimiento y cambio de rodillos', 1),
(111, 'Se brindo un carta poder para apersonarse en el centro de atencion de claro, y puedan desbloquear el', 1),
(112, 'Se asigno un nuevo equipo', 1),
(113, 'Revision de equipos de laboratorio', 1),
(114, 'Se hizo la configuracion desde el REGEDIT para incrementar los caracteres del explorador de archivos', 1),
(115, 'Se cambio de pantalla', 1),
(116, 'Se realizo el proceso de archivado', 1),
(117, 'Se desarrollo aplicacion web a medida', 1),
(118, 'Se dio capacitacion de herramienta sharepoint', 1),
(119, 'Reparacion de office', 1),
(120, 'Se cambio de IP a la computadora', 1),
(121, 'Se extendio el almacenamiento', 1),
(122, 'Se ha creado un nuevo usuario de nombre cuarto de control 2', 1),
(123, 'Se restablecio el equipo', 1),
(124, 'Se restablecio la contraseña del usuario', 1),
(125, 'Se compraron tambores para cada color', 1),
(126, 'Se remplazo por otro periferico', 1),
(127, 'Se asigno licencia a su cuenta corporativa', 1),
(128, 'Se desarrollo aplicacion web de vouchers', 1),
(129, 'Se restablecio clave de PIVISION', 1),
(130, 'Se realizo una limpieza interna del equipo, y se reparo la visagra', 1),
(131, 'Se ha cambiado de memoria RAM', 1),
(132, 'Se procedio a sacar el chipset y reseter la BIOS', 1),
(133, 'Para unir multiples PDFs, se utilizo la herramienta PDF TOOLS', 1),
(134, 'Se cambio el alias de la cuenta de becario por la primera letra de su nombre seguido de su apellido', 1),
(135, 'Se ha creado cuenta corporativa', 1),
(136, 'Se agrego un nuevo perfil en el Adobe acrobat pro', 1),
(137, 'Se va remplazar de Router', 1),
(138, 'Se cambio el nombre del telefono GrandStream', 1),
(139, 'Se adquirio una licencia para la herramienta MSPROJECT', 1),
(140, 'Su equipo fue configurado para imprimir en oficina de Lima', 1),
(141, 'Su equipo fue configurado para escanear en oficina de lima', 1),
(142, 'Se adquirio licencia para la herramienta arcGIS', 1),
(143, 'Quitar todos los perifericos incluido el cargador y apagar el equipo esperarar 5 minutos y volver a ', 1),
(144, 'Se hizo las configuraciones, ya cuenta con internet en la Parroquia', 1),
(145, 'No podia imprimir por atasco de papel, ya puede imprimir', 1),
(146, 'Se envio correos masivos por correspondencia de Word, Outlook y Excel', 1),
(147, 'Se realizo una limpieza de la zona del desprendimiento y se volvio a colocar la tecla N', 1),
(148, 'Se compartio informacion del equipo de Alberto Guitierrez', 1),
(149, 'Se desactivo el complemento ACROBAT del Outlook', 1),
(150, 'Se realizo la compra de soportes plegables para laptops de Arequipa', 1),
(151, 'Se tiene que tener presionado por 10 segundos la tecla asterisco', 1),
(152, 'Se cambio el toner amarillo ya que la que llevaba estaba agotado', 1),
(153, 'Se re asigno otra laptop a Robert Lescano', 1),
(154, 'Se compro monitor para que puedan visualizar las graficas en el PI VISION', 1),
(155, 'Se realizo el mantenimiento  correctivo a la impresora Epson L1455', 1),
(156, 'Se activo el periodo de prueba por 60 dias', 1),
(157, 'Se cambio de cargador con una capacidad de 65W', 1),
(158, 'Se restablecio la contraseña de a cuenta en el PIVISION', 1),
(159, 'Se quito el bloqueo del MDM con el SamFw Tool', 1),
(160, 'Se instalo una nueva version de la herramienta Intellisign OnSign', 1),
(161, 'Se conecto desde la VPN con usuario y clave', 1),
(162, 'Se procedio en agregar la extension de calidra.com.pe ', 1),
(163, 'Se instalo la herramienta AUTOCAD', 1),
(164, 'Se cambio la carcasa de laptop Dell', 1),
(165, 'Se cambio de memorio de RAM', 1),
(166, 'Se re construyo carcasa de laptop', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celulares`
--

CREATE TABLE `celulares` (
  `id` int(11) NOT NULL,
  `TELEFONO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `MONTO_TOTAL_SIN_IGV` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `MONTO_TOTAL_CON_IGV` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_DE_RECIBO` date NOT NULL,
  `MES` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PLAN` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `RESPONSABLE` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `UBICACION` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `AREA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `EQUIPO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `SISTEMA_OPERATIVO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IMEI` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `MARCA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_DE_COMPRA` date NOT NULL,
  `FECHA_DE_ACTIVACION_CHIP` date NOT NULL,
  `ESTADO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CON_O_SIN_EQUIPO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_DE_RENOVACION` date NOT NULL,
  `COBRANZAS_DIFERIDAS` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PENALIDAD` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `RECONEXION_POR_MOROSIDAD_SIN_IGV` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `RECONEXION_POR_MOROSIDAD_CON_IGV` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CAMBIO_DE_NUMERO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CAMBIO_DE_NUMERO_CON_IGV` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `celulares`
--

INSERT INTO `celulares` (`id`, `TELEFONO`, `MONTO_TOTAL_SIN_IGV`, `MONTO_TOTAL_CON_IGV`, `FECHA_DE_RECIBO`, `MES`, `PLAN`, `RESPONSABLE`, `UBICACION`, `AREA`, `EQUIPO`, `SISTEMA_OPERATIVO`, `IMEI`, `MARCA`, `FECHA_DE_COMPRA`, `FECHA_DE_ACTIVACION_CHIP`, `ESTADO`, `CON_O_SIN_EQUIPO`, `FECHA_DE_RENOVACION`, `COBRANZAS_DIFERIDAS`, `PENALIDAD`, `RECONEXION_POR_MOROSIDAD_SIN_IGV`, `RECONEXION_POR_MOROSIDAD_CON_IGV`, `CAMBIO_DE_NUMERO`, `CAMBIO_DE_NUMERO_CON_IGV`, `adjunto1`) VALUES
(2, '914498397', '55.08', '64.99', '2022-01-06', 'Enero', 'Max Negocio Ilimitado 65.00', 'cgomez', 'Lima', 'Sistemas', 'Samsung Galaxy A32', 'Android', '357467543560668', 'Samsung', '0000-00-00', '0000-00-00', 'Activo', '', '0000-00-00', '', '', '', '0', '', '', '\r'),
(3, '914498412', '55.08', '64.99', '0000-00-00', 'Enero', 'Max Negocio Ilimitado 65.00', 'Juan Carlos Huanca', 'Arequipa', 'Mantenimiento', 'Huawei P30 Lite', 'Android', '860693040299704', 'Huawei', '0000-00-00', '0000-00-00', 'Activo', '18 Meses', '0000-00-00', '', '', '', '0', '', '', '\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `numcom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `razon` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `bienservicio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `total` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci,
  `adjunto2` text COLLATE utf8_spanish_ci,
  `adjunto3` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `val` text,
  `cfg_id` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuration`
--

INSERT INTO `configuration` (`id`, `label`, `name`, `val`, `cfg_id`) VALUES
(1, 'Nombre del Sitio Web', 'website', 'Soporte Ticket', 1),
(2, 'Correo Electronico', 'email', 'soporte@calidraperu.com.pe\r\n', 1),
(3, 'URL Base', 'url_base', 'https://ticket.calidraperu.com.pe/', 1),
(4, 'Identificador', 'id_website', 'CW9tR8O5gAqA9FEKKLLLFA==', 1),
(5, 'Favicon', 'favicon', 'logo.png', 1),
(6, 'Correo Electronico SMTP', 'email_smtp', 'soporte@calidraperu.com.pe', 1),
(7, 'Contrase&ntilde;a SMTP', 'password_smtp', 'soporte2021***', 1),
(8, 'Empresa SMTP', 'name_smtp', 'CALIDRA PERU', 1),
(9, 'HOST SMTP', 'host_smtp', 'mail.calidraperu.com.pe', 1),
(10, 'PORT SMTP', 'port_smtp', '465', 1),
(11, 'Tama?o de archivo', 'size_file_MB', '10', 1),
(12, 'Telefono de contacto', 'telephone_contact', '961767644', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id` int(11) NOT NULL,
  `area` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `bienservicio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ptsoles` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ptdolares` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`id`, `area`, `usuario`, `numero`, `proveedor`, `fecha`, `bienservicio`, `categoria`, `marca`, `descripcion`, `cantidad`, `ptsoles`, `ptdolares`, `estado`, `adjunto1`) VALUES
(1, 'Gerencia', 'Juan Vargas', 'PR2206-0429', 'LOBO SISTEMAS', '2022-06-05', 'Bien', 'Laptop', 'Dell', 'Notebook Dell 2-in-1 Latitude 14 7420', '1', '', '2,286.37', '', 'Documentos/Datos/811316818.pdf'),
(2, 'Administracion', 'Mendel de la Cruz Rojas', 'PR2206-0430', 'LOBO SISTEMAS', '2022-06-05', 'Bien', 'Laptop', 'Dell', 'Dell Portatil - Dell Inspiron 15 5000 5502', '1', '', '1,034.86', '', 'Documentos/Datos/1669922275.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `danados`
--

CREATE TABLE `danados` (
  `id` int(11) NOT NULL,
  `equipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `responsable` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechare` date NOT NULL,
  `observacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci,
  `adjunto2` text COLLATE utf8_spanish_ci,
  `adjunto3` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `edad` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8mb4_spanish_ci,
  `adjunto2` text COLLATE utf8mb4_spanish_ci,
  `adjunto3` text COLLATE utf8mb4_spanish_ci,
  `departamento` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `sucursal` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `modelo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `equipo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `serial` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `so` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `procesador` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `memoria` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentbitacora`
--

CREATE TABLE `documentbitacora` (
  `iddocumentBitacora` int(11) NOT NULL,
  `idTicket` int(11) DEFAULT NULL,
  `idBitacora` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `mimeType` varchar(100) DEFAULT NULL,
  `sizeKB` int(11) DEFAULT NULL,
  `urlDocument` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentbitacora`
--

INSERT INTO `documentbitacora` (`iddocumentBitacora`, `idTicket`, `idBitacora`, `name`, `extension`, `mimeType`, `sizeKB`, `urlDocument`) VALUES
(1, 101, 19, '256191380.jpeg', NULL, NULL, 136152, 'Documentos/Bitacoras/256191380.jpeg'),
(2, 100, 20, '498570494.jpeg', NULL, NULL, 92169, 'Documentos/Bitacoras/498570494.jpeg'),
(3, 103, 29, '438189277.jpeg', NULL, NULL, 79630, 'Documentos/Bitacoras/438189277.jpeg'),
(4, 103, 30, '1045874638.jpeg', NULL, NULL, 164852, 'Documentos/Bitacoras/1045874638.jpeg'),
(5, 103, 31, '2088559163.jpeg', NULL, NULL, 95663, 'Documentos/Bitacoras/2088559163.jpeg'),
(6, 103, 33, '2138173055.jpeg', NULL, NULL, 169616, 'Documentos/Bitacoras/2138173055.jpeg'),
(7, 106, 48, '190094750.jpeg', NULL, NULL, 127752, 'Documentos/Bitacoras/190094750.jpeg'),
(8, 106, 60, '1998921917.jpeg', NULL, NULL, 122501, 'Documentos/Bitacoras/1998921917.jpeg'),
(9, 117, 121, '640782299.jpeg', NULL, NULL, 117520, 'Documentos/Bitacoras/640782299.jpeg'),
(10, 122, 139, '1754616210.jpeg', NULL, NULL, 171940, 'Documentos/Bitacoras/1754616210.jpeg'),
(11, 122, 140, '463964786.jpeg', NULL, NULL, 169003, 'Documentos/Bitacoras/463964786.jpeg'),
(12, 122, 141, '212759553.jpeg', NULL, NULL, 374222, 'Documentos/Bitacoras/212759553.jpeg'),
(13, 122, 142, '1826508780.jpeg', NULL, NULL, 115009, 'Documentos/Bitacoras/1826508780.jpeg'),
(14, 122, 143, '1079799963.jpeg', NULL, NULL, 103242, 'Documentos/Bitacoras/1079799963.jpeg'),
(15, 122, 144, '121022528.PNG', NULL, NULL, 132799, 'Documentos/Bitacoras/121022528.PNG'),
(16, 123, 148, '1821957340.png', NULL, NULL, 413327, 'Documentos/Bitacoras/1821957340.png'),
(17, 123, 149, '959954609.png', NULL, NULL, 345288, 'Documentos/Bitacoras/959954609.png'),
(18, 125, 159, '731879310.jpeg', NULL, NULL, 167747, 'Documentos/Bitacoras/731879310.jpeg'),
(19, 127, 172, '1554221271.png', NULL, NULL, 11415, 'Documentos/Bitacoras/1554221271.png'),
(20, 130, 183, '1117960107.pdf', NULL, NULL, 87000, 'Documentos/Bitacoras/1117960107.pdf'),
(21, 130, 185, '797761635.pdf', NULL, NULL, 87000, 'Documentos/Bitacoras/797761635.pdf'),
(22, 132, 227, '1924552105.xlsx', NULL, NULL, 43114, 'Documentos/Bitacoras/1924552105.xlsx'),
(23, 134, 228, '231411331.xlsx', NULL, NULL, 43114, 'Documentos/Bitacoras/231411331.xlsx'),
(24, 143, 247, '643263400.jpg', NULL, NULL, 21032, 'Documentos/Bitacoras/643263400.jpg'),
(25, 156, 322, '301980099.png', NULL, NULL, 90137, 'Documentos/Bitacoras/301980099.png'),
(26, 174, 406, '2127237362.pdf', NULL, NULL, 56376, 'Documentos/Bitacoras/2127237362.pdf'),
(27, 170, 412, '873262527.pdf', NULL, NULL, 48832, 'Documentos/Bitacoras/873262527.pdf'),
(28, 170, 413, '1438964004.pdf', NULL, NULL, 51789, 'Documentos/Bitacoras/1438964004.pdf'),
(29, 173, 420, '1796424384.pdf', NULL, NULL, 53189, 'Documentos/Bitacoras/1796424384.pdf'),
(30, 209, 534, '2030849311.jpg', NULL, NULL, 179245, 'Documentos/Bitacoras/2030849311.jpg'),
(31, 216, 560, '757037156.png', NULL, NULL, 314778, 'Documentos/Bitacoras/757037156.png'),
(32, 333, 1027, '1373563224.docx', NULL, NULL, 1438796, 'Documentos/Bitacoras/1373563224.docx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentsallowed`
--

CREATE TABLE `documentsallowed` (
  `iddocumentsallowed` int(11) NOT NULL,
  `extention` varchar(45) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentsallowed`
--

INSERT INTO `documentsallowed` (`iddocumentsallowed`, `extention`, `active`) VALUES
(1, '.jpg', 1),
(2, '.png', 1),
(3, '.pdf', 1),
(4, '.docx', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentticket`
--

CREATE TABLE `documentticket` (
  `iddocumentTicket` int(11) NOT NULL,
  `idTicket` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `mimeType` varchar(100) DEFAULT NULL,
  `sizeKB` int(11) DEFAULT NULL,
  `urlDocument` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentticket`
--

INSERT INTO `documentticket` (`iddocumentTicket`, `idTicket`, `name`, `extension`, `mimeType`, `sizeKB`, `urlDocument`) VALUES
(1, 100, 'evidencia.png', NULL, NULL, 15801, 'Documentos/Tickets/evidencia.png'),
(2, 103, 'df70e069-b1f2-469a-bfea-5b98382eaa19.jpg', NULL, NULL, 134362, 'Documentos/Tickets/df70e069-b1f2-469a-bfea-5b98382eaa19.jpg'),
(3, 114, '1.png', NULL, NULL, 132324, 'Documentos/Tickets/1.png'),
(4, 131, 'PRUEBA COVID I.jpg', NULL, NULL, 82535, 'Documentos/Tickets/PRUEBA COVID I.jpg'),
(5, 131, 'DESCANSO MEDICO.jpg', NULL, NULL, 65307, 'Documentos/Tickets/DESCANSO MEDICO.jpg'),
(6, 141, 'paul.jpeg', NULL, NULL, 126525, 'Documentos/Tickets/paul.jpeg'),
(7, 142, 'inventor.jpeg', NULL, NULL, 131155, 'Documentos/Tickets/inventor.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `error`
--

CREATE TABLE `error` (
  `idError` int(11) NOT NULL,
  `Mensaje` varchar(250) DEFAULT NULL,
  `Cadena` varchar(250) DEFAULT NULL,
  `Metodo` varchar(250) DEFAULT NULL,
  `Tipo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historyresetpwd`
--

CREATE TABLE `historyresetpwd` (
  `idHistoryResetPwd` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `dateRequest` datetime DEFAULT NULL,
  `dateExpire` datetime DEFAULT NULL,
  `passwordOld` varchar(100) DEFAULT NULL,
  `passwordNew` varchar(100) DEFAULT NULL,
  `dateReset` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impact`
--

CREATE TABLE `impact` (
  `idImpact` int(11) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `impact`
--

INSERT INTO `impact` (`idImpact`, `Description`, `Active`) VALUES
(1, 'Critico', 1),
(2, 'Alta', 1),
(3, 'Media', 1),
(4, 'Baja', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresoras`
--

CREATE TABLE `impresoras` (
  `id` int(11) NOT NULL,
  `equipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `responsable` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci,
  `adjunto2` text COLLATE utf8_spanish_ci,
  `adjunto3` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `impresoras`
--

INSERT INTO `impresoras` (`id`, `equipo`, `responsable`, `departamento`, `sucursal`, `categoria`, `descripcion`, `marca`, `modelo`, `ip`, `estado`, `adjunto1`, `adjunto2`, `adjunto3`) VALUES
(2, 'Impresora', 'cgomez', 'Oficina San Isidro', 'Lima', 'Accesorio informatico', 'Kyocera', 'Kyocera', '192.168.80.234', 'Lima', 'Bueno', NULL, NULL, NULL),
(4, 'Impresora', 'cgomez', 'Oficina San Isidro', 'Lima', 'Accesorio informatico', 'Kyocera', 'Kyocera', '192.168.80.235', 'Lima', 'Bueno', NULL, NULL, NULL),
(5, 'Impresora', 'Samuel Sotelo Vasquez', 'Almacen', 'Arequipa', 'Accesorio informatico', 'Epson', 'Epson', 'L6171', 'Arequipa', 'Bueno', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencias`
--

CREATE TABLE `licencias` (
  `id` int(11) NOT NULL,
  `equipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `responsable` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `programa` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `licencia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechareg` date NOT NULL,
  `fechaven` date NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nompro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numpro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci,
  `adjunto2` text COLLATE utf8_spanish_ci,
  `adjunto3` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `licencias`
--

INSERT INTO `licencias` (`id`, `equipo`, `responsable`, `departamento`, `sucursal`, `programa`, `licencia`, `correo`, `clave`, `fechareg`, `fechaven`, `estado`, `observacion`, `nompro`, `numpro`, `adjunto1`, `adjunto2`, `adjunto3`) VALUES
(2, 'Laptop', 'Luis Porras Loyola', 'T.I.', 'Lima', 'Microsoft Office Hogar y Empresas', '-', 'calquipaaqp@hotmail.com', '-', '2021-07-04', '0000-00-00', 'Bueno', 'Licencia perpetua', 'Claudia', '+51 933 074 322', 'Documentos/Datos/22916.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasfijas`
--

CREATE TABLE `lineasfijas` (
  `id` int(11) NOT NULL,
  `MONTO_TOTAL_CON_IGV` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_DE_RECIBO` date NOT NULL,
  `MES` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `SERVICIO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `MB` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `RESPONSABLE` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `UBICACION` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `AREA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_bitacora`
--

CREATE TABLE `log_bitacora` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `comment` text,
  `created_at` datetime NOT NULL,
  `dateBitacora` datetime DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `log_bitacora`
--

INSERT INTO `log_bitacora` (`id`, `ticket_id`, `comment`, `created_at`, `dateBitacora`, `idUser`, `idStatus`) VALUES
(1219, 100, 'Ticket registrado', '2024-02-16 10:35:16', '2024-02-16 10:35:16', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` int(11) NOT NULL,
  `oficina` text COLLATE utf8_spanish_ci NOT NULL,
  `tarea` text COLLATE utf8_spanish_ci NOT NULL,
  `manual` text COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` int(11) NOT NULL,
  `frecuencia` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `area` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` text COLLATE utf8_spanish_ci NOT NULL,
  `ocultar` year(4) NOT NULL DEFAULT '0000',
  `empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_frecuencia`
--

CREATE TABLE `mantenimiento_frecuencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mantenimiento_frecuencia`
--

INSERT INTO `mantenimiento_frecuencia` (`id`, `nombre`) VALUES
(1, 'Diario'),
(2, 'Semanal'),
(3, 'Mensual'),
(4, 'Anual'),
(5, 'Trienal'),
(6, 'Cuatrienal'),
(7, 'Semestral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobileplatform`
--

CREATE TABLE `mobileplatform` (
  `idMobilePlatform` int(11) NOT NULL,
  `Description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mobileplatform`
--

INSERT INTO `mobileplatform` (`idMobilePlatform`, `Description`) VALUES
(1, 'Android'),
(2, 'iOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordendecompra`
--

CREATE TABLE `ordendecompra` (
  `id` int(11) NOT NULL,
  `area` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `bienservicio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ptsoles` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ptdolares` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ordendecompra`
--

INSERT INTO `ordendecompra` (`id`, `area`, `usuario`, `numero`, `proveedor`, `fecha`, `bienservicio`, `categoria`, `marca`, `descripcion`, `cantidad`, `ptsoles`, `ptdolares`, `adjunto1`) VALUES
(1, 'Logistica', 'Carlos Romero Murillo', 'P2022-01053', 'AITEC', '2022-05-27', 'Bien', 'Laptop', 'Dell', 'Notebook Dell Inspiron 5410 (2-en-1) 14'''' con adaptador de red', '1', '', '1,505.67', 'https://ticket.calidraperu.com.pe/Documentos/Datos/328923685.pdf'),
(2, 'Comercial', 'Joel Jafet Encinas Yanarico', 'P2022-01052', 'LOBO SISTEMAS', '2022-05-27', 'Bien', 'Laptop', 'Dell', 'Dell Latitude 5420', '1', '', '1,465.65', 'https://ticket.calidraperu.com.pe/Documentos/Datos/1963786934.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `priority`
--

CREATE TABLE `priority` (
  `idPriority` int(11) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `priority`
--

INSERT INTO `priority` (`idPriority`, `Description`, `Active`) VALUES
(1, 'Critico', 1),
(2, 'Alta', 1),
(3, 'Media', 1),
(4, 'Baja', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioritymatrix`
--

CREATE TABLE `prioritymatrix` (
  `idMatrix` int(11) NOT NULL,
  `idImpact` int(11) DEFAULT NULL,
  `idUrgency` int(11) DEFAULT NULL,
  `idPriority` int(11) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prioritymatrix`
--

INSERT INTO `prioritymatrix` (`idMatrix`, `idImpact`, `idUrgency`, `idPriority`, `Active`) VALUES
(1, 4, 4, 4, 1),
(2, 4, 3, 3, 1),
(3, 4, 2, 3, 1),
(4, 4, 1, 2, 1),
(5, 3, 4, 2, 1),
(6, 3, 3, 3, 1),
(7, 3, 2, 3, 1),
(8, 3, 1, 4, 1),
(9, 2, 4, 2, 1),
(10, 2, 3, 3, 1),
(11, 2, 2, 3, 1),
(12, 2, 1, 1, 1),
(13, 1, 4, 2, 1),
(14, 1, 3, 2, 1),
(15, 1, 2, 1, 1),
(16, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `razon` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto1` text COLLATE utf8_spanish_ci,
  `adjunto2` text COLLATE utf8_spanish_ci,
  `adjunto3` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reasoncancellation`
--

CREATE TABLE `reasoncancellation` (
  `idReasonCancellation` int(11) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reasoncancellation`
--

INSERT INTO `reasoncancellation` (`idReasonCancellation`, `Description`, `Active`) VALUES
(1, 'Resuelto por el usuario', 1),
(2, 'Cancelado por el usuario', 1),
(3, 'Solicitud incorrecta', 1),
(4, 'Error al ingresar datos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recover`
--

CREATE TABLE `recover` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrationdevice`
--

CREATE TABLE `registrationdevice` (
  `idRegistrationDevice` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idPlatform` int(11) DEFAULT NULL,
  `idIdentifierDevice` int(11) DEFAULT NULL,
  `RegistrationDate` datetime DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_ventas`
--

CREATE TABLE `reporte_ventas` (
  `id` bigint(11) NOT NULL,
  `dia` text,
  `volumen` text,
  `tendencia` text,
  `pronostico` text,
  `cumplimiento` text,
  `precio` text,
  `tendencia2` text,
  `costo_proceso` text,
  `costo_total` text,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`, `created_at`) VALUES
(1, 'Registrado', '2018-03-26 11:07:50'),
(2, 'Asignado', '2018-03-26 11:07:50'),
(3, 'En Proceso', '2018-03-26 11:07:50'),
(4, 'Finalizado', '2018-03-26 11:07:50'),
(5, 'Cancelado', '2018-08-07 14:42:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `survey`
--

CREATE TABLE `survey` (
  `idSurvey` int(11) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveycategory`
--

CREATE TABLE `surveycategory` (
  `idSurveyCategory` int(11) NOT NULL,
  `IdCategory` int(11) DEFAULT NULL,
  `idSurvey` int(11) DEFAULT NULL,
  `DateRegister` datetime DEFAULT NULL,
  `ExpireDateStar` datetime DEFAULT NULL,
  `ExpireDateEnd` datetime DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveyquestions`
--

CREATE TABLE `surveyquestions` (
  `idQuestion` int(11) NOT NULL,
  `idSurvey` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveyresponse`
--

CREATE TABLE `surveyresponse` (
  `idResponse` int(11) NOT NULL,
  `idQuestion` int(11) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `SatisfactionPorcentage` int(11) DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveyticket`
--

CREATE TABLE `surveyticket` (
  `idSurveyTicket` int(11) NOT NULL,
  `idSurvey` int(11) DEFAULT NULL,
  `IdTicket` int(11) DEFAULT NULL,
  `IdUserClient` int(11) DEFAULT NULL,
  `IdUserAgent` int(11) DEFAULT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `DateSend` datetime DEFAULT NULL,
  `DateCompleted` datetime DEFAULT NULL,
  `Porcentage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveyticketquestion`
--

CREATE TABLE `surveyticketquestion` (
  `idQuestion` int(11) NOT NULL,
  `idSurvey` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `idTicket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveyticketresponse`
--

CREATE TABLE `surveyticketresponse` (
  `idResponse` int(11) NOT NULL,
  `idQuestion` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Porcentage` int(11) DEFAULT NULL,
  `Selected` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8,
  `image` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `asunt` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `number_ticket` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `asigned_id` int(11) DEFAULT NULL,
  `tipo_requerimiento` int(11) NOT NULL DEFAULT '0',
  `area_id` int(11) NOT NULL DEFAULT '0',
  `date_atendid` datetime DEFAULT NULL,
  `finalizado` text CHARACTER SET utf8,
  `date_finish` date DEFAULT NULL,
  `status_ticket` int(11) NOT NULL DEFAULT '0',
  `idImpact` int(11) DEFAULT NULL,
  `idUrgency` int(11) DEFAULT NULL,
  `idPriority` int(11) DEFAULT NULL,
  `idReasonCancellation` int(11) DEFAULT NULL,
  `descriptionReasonCancellation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `idCauseSolution` int(11) DEFAULT NULL,
  `ticketscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asignado` datetime DEFAULT NULL,
  `final` datetime DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `comment`, `image`, `area`, `asunt`, `client_id`, `created_at`, `status_id`, `number_ticket`, `asigned_id`, `tipo_requerimiento`, `area_id`, `date_atendid`, `finalizado`, `date_finish`, `status_ticket`, `idImpact`, `idUrgency`, `idPriority`, `idReasonCancellation`, `descriptionReasonCancellation`, `idCauseSolution`, `ticketscol`, `asignado`, `final`, `calificacion`) VALUES
(100, 'Favor configurar la impresora', NULL, 1, 'Favor configurar la impresora', 3, '2024-02-16 10:34:33', 1, 'INC100', NULL, 1, 0, NULL, NULL, NULL, 1, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_requerimientos`
--

CREATE TABLE `tipos_requerimientos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `area_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `idType` int(11) DEFAULT NULL,
  `idImpact` int(11) DEFAULT NULL,
  `idUrgency` int(11) DEFAULT NULL,
  `idPriority` int(11) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_requerimientos`
--

INSERT INTO `tipos_requerimientos` (`id`, `name`, `area_id`, `created_at`, `idType`, `idImpact`, `idUrgency`, `idPriority`, `Active`) VALUES
(1, 'Configuración de impresora', 1, '2021-10-04 21:48:27', 1, 3, 3, 3, 1),
(2, 'Actualizaciones de windows', 1, '2021-10-04 22:11:27', 1, 3, 3, 3, 1),
(3, 'Instalacion de antivirus licencia original', 1, '2021-11-02 09:00:32', 1, 3, 3, 3, 1),
(4, 'Instalacion de office', 1, '2021-11-02 09:01:37', 1, 3, 3, 3, 1),
(5, 'Correos electronicos', 1, '2021-11-02 09:03:12', 1, 3, 3, 3, 1),
(6, 'Instalacion de otras aplicaciones', 1, '2021-11-02 09:04:23', 2, 3, 3, 3, 1),
(7, 'Fallas con el hardware', 1, '2021-11-02 09:06:14', 1, 3, 3, 3, 1),
(8, 'Fallas con el software', 1, '2021-11-02 09:07:05', 1, 3, 3, 3, 1),
(9, 'Licencias de Autodesk por expirar', 1, '2021-11-02 09:09:03', 1, 3, 3, 3, 1),
(10, 'Botellas de tinta para impresora', 1, '2021-11-02 09:10:57', 2, 3, 3, 3, 1),
(11, 'Excel Lento', 1, '2021-11-02 09:12:09', 1, 3, 3, 3, 1),
(12, 'Compartir una carpeta en red local', 1, '2021-11-02 09:15:07', 2, 3, 3, 3, 1),
(13, 'Escanear a una carpeta de red', 1, '2021-11-02 09:22:43', 1, 3, 3, 3, 1),
(14, 'Formatear la computadora', 1, '2021-11-02 09:28:13', 2, 3, 3, 3, 1),
(15, 'Errores de pantalla azul', 1, '2021-11-02 09:30:10', 1, 3, 3, 3, 1),
(16, 'Retiro de atasco de papel', 1, '2021-11-02 09:31:17', 1, 3, 3, 3, 1),
(17, 'Instalar One Drive', 1, '2021-11-02 09:32:23', 1, 3, 3, 3, 1),
(18, 'Almacenamiento en la nube 1TB', 1, '2021-11-02 09:33:37', 1, 3, 3, 3, 1),
(19, 'Otros', 1, '2021-11-19 15:52:08', 1, 3, 3, 3, 1),
(20, 'Fallas con el teams', 1, '2021-12-09 08:55:15', 1, 3, 3, 3, 1),
(21, 'Instalacion de otras herramientas', 1, '2021-12-09 11:24:03', 1, 3, 3, 3, 1),
(22, 'Liberar espacio en disco C', 1, '2021-12-20 16:11:29', 1, 3, 3, 3, 1),
(23, 'Cambio de caja de mantenimiento Impresoras', 1, '2021-12-21 20:32:26', 2, 3, 3, 3, 1),
(24, 'Respaldo o copia de seguridad de archivos', 1, '2021-12-28 19:08:40', 1, 3, 3, 3, 1),
(25, 'Problemas con office', 1, '2021-12-29 17:50:31', 1, 3, 3, 3, 1),
(26, 'Recuperar archivos de USB dañado', 1, '2022-01-12 21:02:49', 1, 2, 3, 3, 1),
(27, 'No se escucha el audio', 1, '2022-01-31 21:00:42', 1, 3, 2, 3, 1),
(28, 'Acceso al servidor desde casa', 1, '2022-01-31 21:05:16', 1, 2, 2, 3, 1),
(29, 'Instalar Adobe AIR', 1, '2022-02-15 11:09:26', 1, 3, 3, 3, 1),
(30, 'No puedo abrir un archivo de power point', 1, '2022-02-22 15:14:17', 1, 3, 3, 3, 1),
(31, 'Adquisicion de Laptop o Desktop', 1, '2022-02-24 16:07:48', 2, 2, 2, 3, 1),
(32, 'Convertir JPG,PNG A PDF', 1, '2022-02-25 15:46:01', 1, 4, 4, 4, 1),
(33, 'Lentitud de computadora', 1, '2022-02-28 08:53:39', 1, 3, 3, 3, 1),
(34, 'Toner para impresora', 1, '2022-02-28 15:07:37', 2, 3, 3, 3, 1),
(35, 'Equipo bloqueado por bitlocker', 1, '2022-02-28 15:13:08', 2, 3, 3, 3, 1),
(36, 'No tengo permisos para guardar archivos', 1, '2022-03-21 10:53:02', 1, 3, 3, 3, 1),
(37, 'Problemas con el autodesk', 1, '2022-03-21 13:05:45', 1, 3, 3, 3, 1),
(38, 'Renovacion de celular', 1, '2022-04-06 09:35:13', 2, 2, 2, 3, 1),
(39, 'Celular y linea nueva', 1, '2022-04-06 09:39:07', 2, 2, 1, 1, 1),
(40, 'Accesos al BI360', 1, '2022-04-06 12:02:35', 2, 2, 1, 1, 1),
(41, 'Actualizacion de antivirus ESETNOD32', 1, '2022-04-06 12:10:22', 2, 3, 3, 3, 1),
(42, 'Instalar pdf Pro', 1, '2022-04-07 15:46:41', 1, 2, 3, 3, 1),
(43, 'Instalar adobe Pro', 1, '2022-04-18 14:58:33', 1, 1, 2, 1, 1),
(44, 'Instalar MS project', 1, '2022-04-25 13:25:51', 1, 2, 2, 3, 1),
(45, 'Re activar correo', 1, '2022-04-26 14:32:18', 1, 3, 2, 3, 1),
(46, 'Instalacion de utilitarios (Office 365, Power BI, ESET NOD 32 y Teams)', 1, '2022-04-28 15:30:20', 2, 3, 3, 3, 1),
(47, 'Crear correo corporativo nuevo usuario', 1, '2022-05-02 12:12:52', 2, 3, 3, 3, 1),
(48, 'Bateria de laptop se descarga rapido', 1, '2022-05-26 10:46:18', 1, 2, 2, 3, 1),
(49, 'Adquisicion de equipo movil', 1, '2022-06-01 14:40:29', 2, 3, 3, 3, 1),
(50, 'Restablecer contrasena de correo', 1, '2022-06-06 16:14:14', 2, 3, 3, 3, 1),
(51, 'Pantalla de laptop parpadea', 1, '2022-06-10 08:18:48', 1, 3, 3, 3, 1),
(52, 'Adaptador de red', 1, '2022-06-16 08:12:44', 2, 3, 3, 3, 1),
(53, 'Microfono del teams no funciona', 1, '2022-06-16 10:45:05', 1, 3, 3, 3, 1),
(54, 'Restablecer equipo de computo', 1, '2022-06-24 12:55:36', 2, 3, 3, 3, 1),
(55, 'Pasar de windows 10 a windows 11', 1, '2022-06-24 15:00:25', 2, 3, 3, 3, 1),
(56, 'Asignar laptop a personal nuevo', 1, '2022-06-30 17:02:24', 2, 3, 3, 3, 1),
(57, 'Cambiar nombre a mi numero de anexo', 1, '2022-06-30 17:08:07', 2, 3, 3, 3, 1),
(58, 'Asignar equipo movil a personal nuevo', 1, '2022-07-15 10:40:27', 2, 3, 2, 3, 1),
(59, 'Instalar Herramienta Microsoft Visio', 1, '2022-07-19 16:09:19', 2, 3, 3, 3, 1),
(60, 'Insertar nueva memoria RAM', 1, '2022-07-20 11:05:20', 2, 3, 3, 3, 1),
(61, 'Activar licencia de power bi Pro', 1, '2022-07-21 10:17:15', 2, 3, 3, 3, 1),
(62, 'No puedo adjuntar archivos al outlook', 1, '2022-07-22 10:09:35', 1, 3, 3, 3, 1),
(63, 'Enviar respaldo de archivos de un usuario', 1, '2022-08-01 12:58:07', 2, 3, 3, 3, 1),
(64, 'Compra de mouse para computadora de escritorio del area de laboratorio', 1, '2022-08-03 10:10:08', 2, 3, 3, 3, 1),
(65, 'Cambiar de disco HDD a Disco solido de antigua laptop Inspiron 5570', 1, '2022-08-08 10:08:12', 2, 2, 1, 1, 1),
(66, 'Instalar visualizador de proyectos en Autocad', 1, '2022-08-09 14:59:52', 2, 3, 3, 3, 1),
(67, 'Dar de baja correo', 1, '2022-08-10 11:18:59', 2, 3, 3, 3, 1),
(68, 'Cambio de teclado laptop Dell', 1, '2022-08-11 15:18:26', 2, 3, 3, 3, 1),
(69, 'Compartir mis archivos / Carpetas a computadora de otro usuario', 1, '2022-08-16 11:11:54', 2, 4, 4, 4, 1),
(70, 'Instalar AnyConnect', 1, '2022-08-17 11:22:35', 2, 3, 3, 3, 1),
(71, 'Dar acceso de un correo existente a personal de contabilidad', 1, '2022-08-18 10:30:21', 2, 3, 3, 3, 1),
(72, 'Dar acceso al servidor de oficina a personal de contabilidad', 1, '2022-08-18 10:37:28', 2, 3, 3, 3, 1),
(73, 'No puedo escanear en impresora de oficina Lima', 1, '2022-08-23 12:17:20', 1, 2, 3, 3, 1),
(74, 'Solucion cuando el proveedor suba sus archivos y llegue una alerta al correo', 1, '2022-08-23 15:45:52', 2, 3, 3, 3, 1),
(75, 'Tenemos problemas con MSTRUCK sale ventana de error', 1, '2022-08-23 17:03:35', 1, 3, 3, 3, 1),
(76, 'No puedo imprimir en impresora EPSON L6171', 1, '2022-08-26 12:22:55', 1, 3, 3, 3, 1),
(77, 'No puedo iniciar sesión en Outlook, teams y onedrive de escritorio ', 1, '2022-08-31 18:19:06', 1, 3, 3, 3, 1),
(78, 'Crear grupos de contactos en OutLook', 1, '2022-09-14 15:55:58', 2, 3, 3, 3, 1),
(79, 'Conectar a la carpeta de gases de combustion', 1, '2022-09-22 12:55:18', 2, 2, 2, 3, 1),
(80, 'No se escuchan los auriculares', 1, '2022-09-23 08:27:13', 1, 1, 1, 1, 1),
(81, 'Tengo problemas con mi teclado, no escribe por momentos', 1, '2022-09-23 10:34:21', 1, 1, 1, 1, 1),
(82, 'No puedo visualizar los correos', 1, '2022-09-26 17:02:00', 1, 2, 2, 3, 1),
(83, 'Actualizacion de la bios', 1, '2022-09-26 17:30:06', 1, 1, 2, 1, 1),
(84, 'No puedo cargar la laptop, la entrada para cargar la laptop esta daniado', 1, '2022-10-03 14:43:54', 1, 3, 3, 3, 1),
(85, 'No puedo imprimir en impresora EPSON L1455', 1, '2022-10-12 10:19:54', 1, 2, 2, 3, 1),
(86, 'No puedo ingresar al PI VISION', 1, '2022-10-17 09:41:57', 1, 2, 1, 1, 1),
(87, 'Proyectar mi pantalla a otra laptop', 1, '2022-10-17 15:38:21', 2, 1, 1, 1, 1),
(88, 'No puedo abrir el archivo de one drive, al abrir dice que el nombre del archivo son demasiado largo', 1, '2022-10-18 14:59:55', 1, 2, 1, 1, 1),
(89, 'Instalar Acrobat Adobe Pro', 1, '2022-10-21 08:33:44', 2, 2, 2, 3, 1),
(90, 'Instalar firma digital Ondesk', 1, '2022-10-21 08:42:44', 2, 1, 2, 1, 1),
(91, 'No puedo iniciar sesion en el outlook aplicacion', 1, '2022-10-24 14:51:02', 1, 3, 3, 3, 1),
(92, 'No emite sonido en los grupos de Outlook que he creado', 1, '2022-10-28 17:37:57', 1, 3, 3, 3, 1),
(93, 'No puedo generar ticket en la macro', 1, '2022-11-02 17:29:23', 1, 3, 2, 3, 1),
(94, 'Producto descativado al abrir Office', 1, '2023-01-09 10:01:53', 1, 2, 2, 3, 1),
(95, 'Impresora de cuarto de control presenta fallas', 1, '2023-01-09 14:48:33', 1, 2, 2, 3, 1),
(96, 'Licencia para antivirus ESET NOD 32', 1, '2023-01-16 10:50:26', 2, 3, 1, 4, 1),
(97, 'El equipo no se conecta al internet mediante WiFi', 1, '2023-01-16 11:43:05', 1, 2, 2, 3, 1),
(98, 'Buzon de correo lleno, no puedo enviar correos', 1, '2023-01-16 17:59:34', 1, 3, 3, 3, 1),
(99, 'Estabilizador, mouse y cable de red', 1, '2023-01-24 11:21:34', 2, 3, 3, 3, 1),
(100, 'Telefono movil con MDM', 1, '2023-01-25 15:30:32', 1, 3, 2, 3, 1),
(101, 'No podemos impresora, el modelo del equipo es Epson Ecotank L8160', 1, '2023-01-26 09:59:51', 1, 3, 3, 3, 1),
(102, 'Tengo problemas con las teclas de la laptop', 1, '2023-01-26 17:21:48', 1, 3, 3, 3, 1),
(103, 'Telefono bloqueado', 1, '2023-03-17 15:57:16', 1, 2, 2, 3, 1),
(104, 'CPU se quemo', 1, '2023-03-17 16:11:53', 1, 3, 2, 3, 1),
(105, 'Revisión de equipos de laboratorio', 1, '2023-03-17 16:19:52', 2, 1, 1, 1, 1),
(106, 'No puedo abrir archivos en PDF', 1, '2023-03-24 16:56:19', 1, 2, 2, 3, 1),
(107, 'Pantalla de laptop daniado', 1, '2023-03-24 16:59:48', 1, 1, 1, 1, 1),
(108, 'Proceso de archivado buzon lleno', 1, '2023-03-28 11:38:27', 1, 1, 1, 1, 1),
(109, 'Desarrollo de aplicacion web', 1, '2023-03-31 11:24:05', 2, 2, 2, 3, 1),
(110, 'Capacitacion con el Sharepoint', 1, '2023-03-31 11:28:17', 2, 2, 2, 3, 1),
(111, 'Error en la paqueteria de Office', 1, '2023-03-31 11:28:58', 1, 2, 1, 1, 1),
(112, 'No podemos conectarnos a internet', 1, '2023-04-04 16:06:12', 1, 2, 1, 1, 1),
(113, 'No puedo subir archivos en el sharepoint', 1, '2023-04-04 16:07:34', 1, 2, 1, 1, 1),
(114, 'No actualiza un archivo localizado en el sharepoint', 1, '2023-04-17 15:45:27', 1, 2, 2, 3, 1),
(115, 'Usuario de administrador bloqueado', 1, '2023-04-19 09:48:24', 1, 3, 2, 3, 1),
(116, 'Cartucho de tambor R1 alcanzo su vida util', 1, '2023-04-24 08:46:20', 1, 1, 1, 1, 1),
(117, 'Periferico para cargar laptop esta daniado', 1, '2023-05-17 17:10:28', 1, 2, 3, 3, 1),
(118, 'Se requiere licencia para autocad', 1, '2023-05-22 09:18:00', 2, 3, 3, 3, 1),
(119, 'Touchpad de laptop en mal estado', 1, '2023-05-30 16:36:28', 1, 2, 1, 1, 1),
(120, 'En pantalla azul aparece lo siguiente ATTEMPTED_WRITE_TO_READONLY_MEMORY', 1, '2023-05-30 16:44:22', 1, 2, 2, 3, 1),
(121, 'Pantalla negra teclados encendido', 1, '2023-06-01 10:01:27', 1, 3, 2, 3, 1),
(122, 'Unir multiples PDFs', 1, '2023-06-01 17:02:48', 2, 2, 2, 3, 1),
(123, 'Cambiar cuenta de becario a cuenta personal', 1, '2023-06-01 17:23:41', 2, 2, 2, 3, 1),
(124, 'Nueva cuenta de correo corporativo para Olger Aragon', 1, '2023-06-01 17:25:04', 2, 3, 2, 3, 1),
(125, 'Indica suscripcion caduca en el Adobe Acrobat Pro', 1, '2023-06-26 17:41:03', 1, 2, 2, 3, 1),
(126, 'No contamos con internet en la parroquia Callalli', 1, '2023-06-26 17:43:07', 1, 2, 2, 3, 1),
(127, 'Cambiar el idioma de Microsoft Office 365', 1, '2023-06-30 08:18:07', 1, 2, 1, 1, 1),
(128, 'Instalar herramientas Arcgis y Autocad 3D', 1, '2023-06-30 12:08:26', 2, 2, 2, 3, 1),
(129, 'Configurar laptop para imprimir en Oficina Lima', 1, '2023-06-30 12:48:23', 2, 2, 1, 1, 1),
(130, 'Configurar laptop para escanear en oficina de lima', 1, '2023-06-30 12:48:46', 2, 1, 1, 1, 1),
(131, 'Se requiere instalacion de la herramienta arcGIS', 1, '2023-07-02 11:45:16', 2, 2, 2, 3, 1),
(132, 'En la computadora aparecio el mensaje HTTP BOOTS-FAILED TO INITIALIZE NETWORK CONNECTION', 1, '2023-07-03 16:03:59', 1, 2, 2, 3, 1),
(133, 'Impresora Epson L1455 muestra error 0xEA', 1, '2023-07-05 08:37:19', 1, 2, 3, 3, 1),
(134, 'Impresora EPSON ECOTANK L8160 se atasca el papel continuamente', 1, '2023-07-05 08:41:04', 1, 2, 2, 3, 1),
(135, 'Configurar impresora Epson L3250 para imprimir y escanear', 1, '2023-07-05 11:11:50', 2, 2, 2, 3, 1),
(136, 'Se requiere botellas de tinta para impresor Epson 6171', 1, '2023-07-10 12:33:11', 2, 3, 2, 3, 1),
(137, 'Se requiere caja de mantenimiento para Epson L6171', 1, '2023-07-10 12:33:46', 2, 2, 1, 1, 1),
(138, 'Se requiere monitor para proyectar graficas y rangos de operacion con el PIVISION', 1, '2023-07-11 10:17:21', 2, 1, 2, 1, 1),
(139, 'No puedo imprimir en la impresora Kyocera M8124cidn', 1, '2023-07-11 14:46:42', 1, 2, 2, 3, 1),
(140, 'No puedo escanear en la impresora Kyocera M3550idn', 1, '2023-07-12 11:56:37', 1, 3, 1, 4, 1),
(141, 'Favor requiero enviar correos masivos a unos proveedores', 1, '2023-07-13 15:51:09', 2, 1, 3, 2, 1),
(142, 'Se desprendio la tecla N de la laptop', 1, '2023-07-14 08:58:22', 1, 2, 2, 3, 1),
(143, 'Compartir respaldo de informacion del equipo de Juan Alberto Gutierrez', 1, '2023-07-17 08:38:02', 2, 1, 4, 2, 1),
(144, 'Cuando re envio un correo con archivos adjuntos, los archivos desaparecen', 1, '2023-08-04 09:07:35', 1, 2, 1, 1, 1),
(145, 'No puedo imprimir a colores en impresora de la oficina Lima', 1, '2023-08-04 09:09:24', 1, 2, 2, 3, 1),
(146, 'Evaluar cambio de laptop a Rober Lescano por el tiempo de uso que tiene su equipo', 1, '2023-08-04 09:14:28', 2, 3, 4, 2, 1),
(147, 'Se requie soportes plegables para laptops en Arequipa', 1, '2023-08-04 09:17:48', 2, 3, 2, 3, 1),
(148, 'Los teclados del Telefono IP de almacen esta boqueado', 1, '2023-08-04 09:21:32', 1, 2, 2, 3, 1),
(149, 'La herramienta Power bi pro indica que se debe actualizar la licencia a la version PRO', 1, '2023-08-07 10:00:05', 1, 2, 2, 3, 1),
(150, 'Cargador no es compatible con la laptop', 1, '2023-08-11 09:22:46', 1, 1, 2, 1, 1),
(151, 'Celular bloqueado con el MDM CLARO', 1, '2023-08-15 11:50:16', 1, 1, 2, 1, 1),
(152, 'Presento lentitud en la herramienta Intellisign OnSign', 1, '2023-08-16 10:13:10', 1, 1, 2, 1, 1),
(153, 'No puedo ingresar a la pagina de calidadpi', 1, '2023-08-17 15:59:42', 1, 2, 2, 3, 1),
(154, 'Se requiere toner para impresora XEROX C405', 1, '2023-08-17 16:09:43', 2, 2, 1, 1, 1),
(155, 'No puedo enviar correos', 1, '2023-08-25 09:52:41', 1, 2, 1, 1, 1),
(156, 'Se requiere la herramienta de AUTOCAD', 1, '2023-08-29 08:58:25', 2, 3, 2, 3, 1),
(157, 'Laptop no enciende', 1, '2023-09-11 20:52:55', 1, 3, 3, 3, 1),
(158, 'Se rompio carcasa de laptop Dell', 1, '2023-09-21 09:10:52', 1, 3, 2, 3, 1),
(159, 'Laptop solo enciende los led del teclado, no enciende pantalla', 1, '2023-09-25 11:01:06', 1, 2, 2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type`
--

CREATE TABLE `type` (
  `idType` int(11) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `type`
--

INSERT INTO `type` (`idType`, `Description`, `Active`) VALUES
(1, 'Incidente', 0),
(2, 'Requerimiento', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typemobiledevice`
--

CREATE TABLE `typemobiledevice` (
  `idTypeMobileDevice` int(11) NOT NULL,
  `Description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `typemobiledevice`
--

INSERT INTO `typemobiledevice` (`idTypeMobileDevice`, `Description`) VALUES
(1, 'Smartphones'),
(2, 'Tablet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urgency`
--

CREATE TABLE `urgency` (
  `idUrgency` int(11) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `urgency`
--

INSERT INTO `urgency` (`idUrgency`, `Description`, `Active`) VALUES
(1, 'Critico', 1),
(2, 'Alta', 1),
(3, 'Media', 1),
(4, 'Baja', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_admin` tinyint(1) DEFAULT '0',
  `kind` int(11) DEFAULT '1',
  `phone` varchar(50) DEFAULT NULL,
  `business` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `ruc` varchar(50) DEFAULT NULL,
  `ban` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `is_client` tinyint(1) NOT NULL DEFAULT '0',
  `latitude` varchar(200) DEFAULT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  `file1` text,
  `file2` text,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `is_agente` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `lastname`, `email`, `password`, `profile_pic`, `is_active`, `is_admin`, `kind`, `phone`, `business`, `fullname`, `ruc`, `ban`, `created_at`, `is_client`, `latitude`, `longitude`, `file1`, `file2`, `last_login`, `last_logout`, `is_agente`) VALUES
(1, 'admin', 'Administrador', 'T.I.', 'admin@admin.com', 'VqHYiK/liiSZITtppJB49Q==', 'descarga.jpeg', 1, 1, 1, '49899115', 'Abisoft', '', 'LOL', 0, '2018-03-26 11:07:50', 0, '-12.0467385', '-77.04343159999999', NULL, NULL, NULL, NULL, 0),
(2, 'lporras', 'Luis Enrique', 'Porras Loyola', 'lporras@gmail.com', 'mnxcpCV1k9cNtnucPcXhug==', 'default.png', 1, 0, 1, NULL, NULL, NULL, NULL, 0, '2021-10-04 22:12:18', 0, '-12.046379', '-77.0418316', NULL, NULL, NULL, NULL, 0),
(3, NULL, 'Empleado', 'Empleado empleado', 'empleado@gmail.com', 'H7bNTRHUGC8whtAIg0M4AA==', NULL, 1, 0, 1, '92983918319', 'TEST SAC', NULL, '123456', 0, '2021-10-04 22:16:29', 1, '-12.0463731', '-77.042754', 'Documentos/Empleados/16270.xlsx', NULL, '2024-02-16 10:34:24', '2023-08-04 09:13:52', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usermobiledevice`
--

CREATE TABLE `usermobiledevice` (
  `idUserMobileDevice` int(11) NOT NULL,
  `IdUser` int(11) DEFAULT NULL,
  `MobileIdentifier` varchar(500) DEFAULT NULL,
  `IdTypeMobileDevice` int(11) DEFAULT NULL,
  `IdMobilePlatform` int(11) DEFAULT NULL,
  `VersionOS` varchar(50) DEFAULT NULL,
  `RegisterDate` datetime DEFAULT NULL,
  `Notification` bit(1) DEFAULT NULL,
  `Token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_areas`
--

CREATE TABLE `usuarios_areas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_areas`
--

INSERT INTO `usuarios_areas` (`id`, `user_id`, `area_id`, `created_at`) VALUES
(30, 2, 1, '2024-02-16 10:33:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorycausesolution`
--
ALTER TABLE `categorycausesolution`
  ADD PRIMARY KEY (`idCategoryCauseSolution`);

--
-- Indices de la tabla `causesolution`
--
ALTER TABLE `causesolution`
  ADD PRIMARY KEY (`idCauseSolution`);

--
-- Indices de la tabla `celulares`
--
ALTER TABLE `celulares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `danados`
--
ALTER TABLE `danados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentbitacora`
--
ALTER TABLE `documentbitacora`
  ADD PRIMARY KEY (`iddocumentBitacora`);

--
-- Indices de la tabla `documentsallowed`
--
ALTER TABLE `documentsallowed`
  ADD PRIMARY KEY (`iddocumentsallowed`);

--
-- Indices de la tabla `documentticket`
--
ALTER TABLE `documentticket`
  ADD PRIMARY KEY (`iddocumentTicket`);

--
-- Indices de la tabla `error`
--
ALTER TABLE `error`
  ADD PRIMARY KEY (`idError`);

--
-- Indices de la tabla `historyresetpwd`
--
ALTER TABLE `historyresetpwd`
  ADD PRIMARY KEY (`idHistoryResetPwd`);

--
-- Indices de la tabla `impact`
--
ALTER TABLE `impact`
  ADD PRIMARY KEY (`idImpact`);

--
-- Indices de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineasfijas`
--
ALTER TABLE `lineasfijas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log_bitacora`
--
ALTER TABLE `log_bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Frecuencia` (`frecuencia`),
  ADD KEY `empleado` (`empleado`);

--
-- Indices de la tabla `mantenimiento_frecuencia`
--
ALTER TABLE `mantenimiento_frecuencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mobileplatform`
--
ALTER TABLE `mobileplatform`
  ADD PRIMARY KEY (`idMobilePlatform`);

--
-- Indices de la tabla `ordendecompra`
--
ALTER TABLE `ordendecompra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`idPriority`);

--
-- Indices de la tabla `prioritymatrix`
--
ALTER TABLE `prioritymatrix`
  ADD PRIMARY KEY (`idMatrix`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reasoncancellation`
--
ALTER TABLE `reasoncancellation`
  ADD PRIMARY KEY (`idReasonCancellation`);

--
-- Indices de la tabla `recover`
--
ALTER TABLE `recover`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registrationdevice`
--
ALTER TABLE `registrationdevice`
  ADD PRIMARY KEY (`idRegistrationDevice`);

--
-- Indices de la tabla `reporte_ventas`
--
ALTER TABLE `reporte_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`idSurvey`);

--
-- Indices de la tabla `surveycategory`
--
ALTER TABLE `surveycategory`
  ADD PRIMARY KEY (`idSurveyCategory`);

--
-- Indices de la tabla `surveyquestions`
--
ALTER TABLE `surveyquestions`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Indices de la tabla `surveyresponse`
--
ALTER TABLE `surveyresponse`
  ADD PRIMARY KEY (`idResponse`);

--
-- Indices de la tabla `surveyticket`
--
ALTER TABLE `surveyticket`
  ADD PRIMARY KEY (`idSurveyTicket`);

--
-- Indices de la tabla `surveyticketquestion`
--
ALTER TABLE `surveyticketquestion`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Indices de la tabla `surveyticketresponse`
--
ALTER TABLE `surveyticketresponse`
  ADD PRIMARY KEY (`idResponse`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_requerimientos`
--
ALTER TABLE `tipos_requerimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Indices de la tabla `typemobiledevice`
--
ALTER TABLE `typemobiledevice`
  ADD PRIMARY KEY (`idTypeMobileDevice`);

--
-- Indices de la tabla `urgency`
--
ALTER TABLE `urgency`
  ADD PRIMARY KEY (`idUrgency`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usermobiledevice`
--
ALTER TABLE `usermobiledevice`
  ADD PRIMARY KEY (`idUserMobileDevice`);

--
-- Indices de la tabla `usuarios_areas`
--
ALTER TABLE `usuarios_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `area_id` (`area_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categorycausesolution`
--
ALTER TABLE `categorycausesolution`
  MODIFY `idCategoryCauseSolution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT de la tabla `causesolution`
--
ALTER TABLE `causesolution`
  MODIFY `idCauseSolution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT de la tabla `celulares`
--
ALTER TABLE `celulares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `danados`
--
ALTER TABLE `danados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT de la tabla `documentbitacora`
--
ALTER TABLE `documentbitacora`
  MODIFY `iddocumentBitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `documentsallowed`
--
ALTER TABLE `documentsallowed`
  MODIFY `iddocumentsallowed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `documentticket`
--
ALTER TABLE `documentticket`
  MODIFY `iddocumentTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `error`
--
ALTER TABLE `error`
  MODIFY `idError` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historyresetpwd`
--
ALTER TABLE `historyresetpwd`
  MODIFY `idHistoryResetPwd` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `impact`
--
ALTER TABLE `impact`
  MODIFY `idImpact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `licencias`
--
ALTER TABLE `licencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `lineasfijas`
--
ALTER TABLE `lineasfijas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `log_bitacora`
--
ALTER TABLE `log_bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1220;
--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
--
-- AUTO_INCREMENT de la tabla `mantenimiento_frecuencia`
--
ALTER TABLE `mantenimiento_frecuencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `mobileplatform`
--
ALTER TABLE `mobileplatform`
  MODIFY `idMobilePlatform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ordendecompra`
--
ALTER TABLE `ordendecompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT de la tabla `priority`
--
ALTER TABLE `priority`
  MODIFY `idPriority` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `prioritymatrix`
--
ALTER TABLE `prioritymatrix`
  MODIFY `idMatrix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reasoncancellation`
--
ALTER TABLE `reasoncancellation`
  MODIFY `idReasonCancellation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `recover`
--
ALTER TABLE `recover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `registrationdevice`
--
ALTER TABLE `registrationdevice`
  MODIFY `idRegistrationDevice` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reporte_ventas`
--
ALTER TABLE `reporte_ventas`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `survey`
--
ALTER TABLE `survey`
  MODIFY `idSurvey` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `surveycategory`
--
ALTER TABLE `surveycategory`
  MODIFY `idSurveyCategory` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `surveyquestions`
--
ALTER TABLE `surveyquestions`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `surveyresponse`
--
ALTER TABLE `surveyresponse`
  MODIFY `idResponse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `surveyticket`
--
ALTER TABLE `surveyticket`
  MODIFY `idSurveyTicket` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `surveyticketquestion`
--
ALTER TABLE `surveyticketquestion`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `surveyticketresponse`
--
ALTER TABLE `surveyticketresponse`
  MODIFY `idResponse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;
--
-- AUTO_INCREMENT de la tabla `tipos_requerimientos`
--
ALTER TABLE `tipos_requerimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `typemobiledevice`
--
ALTER TABLE `typemobiledevice`
  MODIFY `idTypeMobileDevice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `urgency`
--
ALTER TABLE `urgency`
  MODIFY `idUrgency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `usermobiledevice`
--
ALTER TABLE `usermobiledevice`
  MODIFY `idUserMobileDevice` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios_areas`
--
ALTER TABLE `usuarios_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`frecuencia`) REFERENCES `mantenimiento_frecuencia` (`id`),
  ADD CONSTRAINT `mantenimiento_ibfk_2` FOREIGN KEY (`empleado`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `tipos_requerimientos`
--
ALTER TABLE `tipos_requerimientos`
  ADD CONSTRAINT `tipos_requerimientos_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);

--
-- Filtros para la tabla `usuarios_areas`
--
ALTER TABLE `usuarios_areas`
  ADD CONSTRAINT `usuarios_areas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `usuarios_areas_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
