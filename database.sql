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
('invitado', 'Cueva misteriosa', 'Mientras dabas un paseo para pasar el tiempo te encuentras con la entrada de una cueva y como no tenias nada mejor que hacer te adentras en ella. Ves una puerta metálica', 'intentas entrar (podría ser peligroso)', 'La puerta está tan dura que nos consigues abrirla', 'Esperas un rato a ver que pasa', 'Tras esperar un par de horas se habre la puerta donde sale un hombre vestido de negro, sin que se diera cuenta te escabulles denro de la sala. Dentro consigues reunir materiales y escapas de la isla.'),
('JONDOWN', 'poronga', 'LA PORONGA ES BUENA', 'TE LA TOMAS', 'ÑAÑA', 'NO LO HACES', 'TE MUERES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` text NOT NULL,
  `telef` int(11) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nacimiento` date NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `sal` varchar(50) NOT NULL,
  `cookie` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `telef`, `dni`, `email`, `nacimiento`, `usuario`, `passwd`, `sal`, `cookie`) VALUES
('aa', 688851580, '79113393-V', 'aa@gmail.com', '2003-04-28', 'aa', '$2y$10$sDdSOWniZIaNYIGH1aYQBu52KkTCFPTdOFHadxAr/GmWTD63l6ZeC', '5df8b35febda1121a42f85aa12e8922f', ''),
('ab', 688851580, '79113393-V', 'ab@gmail.com', '2003-04-28', 'ab', '$2y$10$V3vdCr.CCbwgjj99XlZrjuNeXLtu/wujhPhh41NCe96xkZtPKIayC', '2fa2c408eb45b956fdd61bcfb6400e89', ''),
('abc', 688851580, '79113393-V', 'abc@gmail.com', '2003-04-28', 'abc', '$2y$10$paatFG/fXpXYNBAZ8VMB.eKqO4nb3RvOi3b.mZPTsbTQnvl4YrfIC', 'a4edc548dc68b0ef0d876c274b3b2842', ''),
('antonio', 688851580, '79113393-V', 'antonio@gmail.com', '2003-04-28', 'antonin', '$2y$10$rqpXA023zDVOq7tQ9oKpU.qaBNnahRHsXe4RaeQ6ijOVtglXJKde6', '8e0120c0d75d07840f8041dffbb6ccf3', ''),
('Imanol Martinez', 684399392, '46368446-D', 'imanolm.upv@gmail.com', '2003-08-08', 'ImanolMM', 'imanolMM', 'a', ''),
('jon', 688851580, '79113393-V', 'jon@gmail.com', '2003-04-28', 'jon', '$2y$10$L1LkaUg9mlbEMXOhrlVQeuQuw8BqnVvH0SLHwXg8sFueuZgtTL21O', 'a9cd41f2b3519f8a4e03e0a9870bd105', ''),
('añañin', 688851580, '79113393-V', 'mikel@gmail.com', '2003-04-28', 'JONDOWN', 'RACISTA', 'a', ''),
('oo', 688851580, '79113393-V', 'oo@gmail.com', '2003-04-28', 'oo', '$2y$10$OQMiQNdemcoM3pZW2agDkeVHEm6H2Yd50V7RY1PuIA2kL9ymtWkZq', '0370e74811c42f96c58f33b58f819554', ''),
('rodolfo', 688851580, '79113393-V', 'rodolfo@gmail.com', '2003-04-28', 'rodolfo', '$2y$10$yN5jS9mkaWhunWmQGDGOkOlXKyfI6jO/aJkCFuOnwmFHGjv107S1u', 'be86af13c6290d8d5562f1326a8a588c', '');

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
