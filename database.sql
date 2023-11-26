-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 19-11-2023 a las 16:52:19
-- Versión del servidor: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--
DROP TABLE IF EXISTS `accesos`;
CREATE TABLE `accesos` (
  `usuario` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `intentos` int(11) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`usuario`, `ip`, `intentos`, `fecha`) VALUES
('antonin', '172.17.0.1', 5, '2023-11-08'),
('jon', '172.17.0.1', 6, '2023-11-06'),
('rodolfo', '172.17.0.1', 1, '2023-11-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `usuario` varchar(50) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `enunciado` varchar(255) NOT NULL,
  `opcion1` varchar(255) NOT NULL,
  `resultado1` varchar(255) NOT NULL,
  `opcion2` varchar(255) NOT NULL,
  `resultado2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`usuario`, `titulo`, `enunciado`, `opcion1`, `resultado1`, `opcion2`, `resultado2`) VALUES
('Imanol', 'Las aventuras de WIP games', 'Era un día soleado cuando nos encontramos una cueva misteriosa, estaba muy oscura y nos dieron ganas de entrar. Poco a poco se hacía la luz dentro de la cueva y de repente vimos una estatua gigante rodeada de oro', 'Oro! Tenemos que coger todo lo que podamos! Nos haremos ricos!!', 'Era una trampa, hemos caido en un agujero sin salida...', 'No hacemos nada, podría ser una trampa', 'Nos vamos con las manos vacías pero con una increible historia que contar a nuestros hijos'),
('ImanolMM', '¡¡Enanos!!', 'Te despiertas de una larga siesta y estas rodeado de enanos, Quita! Son demasiados y te estan intentando agarrar para meterte en una caja! Despues de un tiempo siendo transportado ves que te han llevado a su aldea.', 'Te intentas liberar y peleas contra ellos', 'Te dañan pero consigues escapar', 'Usas tu linterna para intentar sorprenderles', 'Están sorprendidos. Nunca antes habían visto algo así,  te toman por su dios y te dan de comer y beber'),
('invitado', 'Cueva misteriosa', 'Mientras dabas un paseo para pasar el tiempo te encuentras con la entrada de una cueva y como no tenias nada mejor que hacer te adentras en ella. Ves una puerta metálica', 'intentas entrar (podría ser peligroso)', 'La puerta está tan dura que nos consigues abrirla', 'Esperas un rato a ver que pasa', 'Tras esperar un par de horas se habre la puerta donde sale un hombre vestido de negro, sin que se diera cuenta te escabulles denro de la sala. Dentro consigues reunir materiales y escapas de la isla.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `nombre` text NOT NULL,
  `telef` int(11) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nacimiento` date NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `sal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `telef`, `dni`, `email`, `nacimiento`, `usuario`, `passwd`, `sal`) VALUES
('oo', 123456789, '79113393-V', 'aaaaaaaaaaaaaa@scadcads', '2023-11-13', 'oo', '$2y$10$vPnqsCWlzmLlkyySjQHgI.cuH.uUM5cqlIbh0uXsmpLyLX4vDUf1q', '111942044a91deb3106547063d54fb35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`usuario`,`ip`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`usuario`,`titulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD CONSTRAINT `accesos_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
