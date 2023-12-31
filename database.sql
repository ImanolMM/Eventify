-- phpMyAdmin SQL Dump

-- version 5.2.1

-- https://www.phpmyadmin.net/

--

-- Host: db

-- Generation Time: Nov 02, 2023 at 12:47 PM

-- Server version: 10.8.2-MariaDB-1:10.8.2+maria~focal

-- PHP Version: 8.2.8



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";





/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;



--

-- Database: `database`

--



-- --------------------------------------------------------



--

-- Table structure for table `eventos`

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

-- Dumping data for table `eventos`

--



INSERT INTO `eventos` (`usuario`, `titulo`, `enunciado`, `opcion1`, `resultado1`, `opcion2`, `resultado2`) VALUES

('Imanol', 'Las aventuras de WIP games', 'Era un día soleado cuando nos encontramos una cueva misteriosa, estaba muy oscura y nos dieron ganas de entrar. Poco a poco se hacía la luz dentro de la cueva y de repente vimos una estatua gigante rodeada de oro', 'Oro! Tenemos que coger todo lo que podamos! Nos haremos ricos!!', 'Era una trampa, hemos caido en un agujero sin salida...', 'No hacemos nada, podría ser una trampa', 'Nos vamos con las manos vacías pero con una increible historia que contar a nuestros hijos'),

('ImanolMM', '¡¡Enanos!!', 'Te despiertas de una larga siesta y estas rodeado de enanos, Quita! Son demasiados y te estan intentando agarrar para meterte en una caja! Despues de un tiempo siendo transportado ves que te han llevado a su aldea.', 'Te intentas liberar y peleas contra ellos', 'Te dañan pero consigues escapar', 'Usas tu linterna para intentar sorprenderles', 'Están sorprendidos. Nunca antes habían visto algo así,  te toman por su dios y te dan de comer y beber'),

('invitado', 'Cueva misteriosa', 'Mientras dabas un paseo para pasar el tiempo te encuentras con la entrada de una cueva y como no tenias nada mejor que hacer te adentras en ella. Ves una puerta metálica', 'intentas entrar (podría ser peligroso)', 'La puerta está tan dura que nos consigues abrirla', 'Esperas un rato a ver que pasa', 'Tras esperar un par de horas se habre la puerta donde sale un hombre vestido de negro, sin que se diera cuenta te escabulles denro de la sala. Dentro consigues reunir materiales y escapas de la isla.');



-- --------------------------------------------------------



--

-- Table structure for table `usuarios`

--



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

-- Dumping data for table `usuarios`

--



INSERT INTO `usuarios` (`nombre`, `telef`, `dni`, `email`, `nacimiento`, `usuario`, `passwd`, `sal`) VALUES

('aa', 688851580, '79113393-V', 'aa@gmail.com', '2003-04-28', 'aa', '$2y$10$sDdSOWniZIaNYIGH1aYQBu52KkTCFPTdOFHadxAr/GmWTD63l6ZeC', '5df8b35febda1121a42f85aa12e8922f'),

('Imanol Martinez', 684399392, '46368446-D', 'imanolm.upv@gmail.com', '2003-08-08', 'ImanolMM', 'imanolMM', 'a'),

('oo', 688851580, '79113393-V', 'oo@gmail.com', '2003-04-28', 'oo', '$2y$10$OQMiQNdemcoM3pZW2agDkeVHEm6H2Yd50V7RY1PuIA2kL9ymtWkZq', '0370e74811c42f96c58f33b58f819554');



--

-- Indexes for dumped tables

--



--

-- Indexes for table `eventos`

--

ALTER TABLE `eventos`

  ADD PRIMARY KEY (`usuario`,`titulo`);



--

-- Indexes for table `usuarios`

--

ALTER TABLE `usuarios`

  ADD PRIMARY KEY (`usuario`);

COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

