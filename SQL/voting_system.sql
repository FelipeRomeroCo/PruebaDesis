-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2023 a las 00:25:12
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `voting_system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_name`) VALUES
(1, 'Manuel Blanco Encalada'),
(2, 'Ramón Freire Serrano'),
(3, 'Francisco Antonio Pinto Díaz'),
(4, 'José Joaquín Prieto Vial'),
(5, 'Manuel Bulnes Prieto'),
(6, 'Manuel Montt Torres'),
(7, 'José Joaquín Pérez Mascayano'),
(8, 'Federico Errázuriz Zañartu'),
(9, 'Agustín Eyzaguirre'),
(10, 'Aníbal Pinto Garmendia'),
(11, 'Domingo Santa María González'),
(12, 'José Manuel Balmaceda Fernández'),
(13, 'Jorge Montt Álvarez'),
(14, 'Federico Errázuriz Echaurren'),
(15, 'Emiliano Figueroa Larraín'),
(16, 'Pedro Montt Montt'),
(17, 'Ramón Barros Luco'),
(18, 'Juan Luis Sanfuentes Andonaegui'),
(19, 'Arturo Alessandri Palma'),
(20, 'Luis Enrique Sanfuentes Vergara'),
(21, 'Carlos Ibáñez del Campo'),
(22, 'Pedro Aguirre Cerda'),
(23, 'Juan Antonio Ríos Morales'),
(24, 'Gabriel González Videla'),
(25, 'Jorge Alessandri Rodríguez'),
(26, 'Eduardo Frei Montalva'),
(27, 'Salvador Allende Gossens'),
(28, 'Augusto Pinochet Ugarte'),
(29, 'Patricio Aylwin Azócar'),
(30, 'Eduardo Frei Ruiz-Tagle'),
(31, 'Ricardo Lagos Escobar'),
(32, 'Michelle Bachelet Jeria'),
(33, 'Sebastián Piñera Echenique'),
(34, 'Gabriel Boric Font');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `communes`
--

CREATE TABLE `communes` (
  `id` int(11) NOT NULL,
  `commune_name` varchar(100) NOT NULL,
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `communes`
--

INSERT INTO `communes` (`id`, `commune_name`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Putre', 1),
(3, 'Camarones', 1),
(4, 'General Lagos', 1),
(5, 'Arica', 1),
(6, 'Iquique', 2),
(7, 'Alto Hospicio', 2),
(8, 'Pica', 2),
(9, 'Pozo Almonte', 2),
(10, 'Huara', 2),
(11, 'Antofagasta', 3),
(12, 'Calama', 3),
(13, 'Tocopilla', 3),
(14, 'Mejillones', 3),
(15, 'Taltal', 3),
(16, 'Copiapó', 4),
(17, 'Vallenar', 4),
(18, 'Caldera', 4),
(19, 'Chañaral', 4),
(20, 'Diego de Almagro', 4),
(21, 'La Serena', 5),
(22, 'Coquimbo', 5),
(23, 'Illapel', 5),
(24, 'Ovalle', 5),
(25, 'Salamanca', 5),
(26, 'Valparaíso', 6),
(27, 'Viña del Mar', 6),
(28, 'Quillota', 6),
(29, 'San Antonio', 6),
(30, 'Villa Alemana', 6),
(31, 'Santiago', 7),
(32, 'Puente Alto', 7),
(33, 'Maipú', 7),
(34, 'San Bernardo', 7),
(35, 'La Florida', 7),
(36, 'Rancagua', 8),
(37, 'Rengo', 8),
(38, 'San Fernando', 8),
(39, 'Santa Cruz', 8),
(40, 'Pichilemu', 8),
(41, 'Talca', 9),
(42, 'Linares', 9),
(43, 'Curicó', 9),
(44, 'Constitución', 9),
(45, 'San Clemente', 9),
(46, 'Chillán', 10),
(47, 'Bulnes', 10),
(48, 'Quillón', 10),
(49, 'San Carlos', 10),
(50, 'Yungay', 10),
(51, 'Concepción', 11),
(52, 'Los Ángeles', 11),
(53, 'Chillán Viejo', 11),
(54, 'Coronel', 11),
(55, 'Talcahuano', 11),
(56, 'Temuco', 12),
(57, 'Padre Las Casas', 12),
(58, 'Angol', 12),
(59, 'Villarrica', 12),
(60, 'Lautaro', 12),
(61, 'Valdivia', 13),
(62, 'La Unión', 13),
(63, 'Panguipulli', 13),
(64, 'Los Lagos', 13),
(65, 'Río Bueno', 13),
(66, 'Puerto Montt', 14),
(67, 'Osorno', 14),
(68, 'Castro', 14),
(69, 'Ancud', 14),
(70, 'Quellón', 14),
(71, 'Coyhaique', 15),
(72, 'Aysén', 15),
(73, 'Chile Chico', 15),
(74, 'Cochrane', 15),
(75, 'Puerto Aysén', 15),
(76, 'Punta Arenas', 16),
(77, 'Puerto Natales', 16),
(78, 'Porvenir', 16),
(79, 'Puerto Williams', 16),
(80, 'San Gregorio', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `region_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `regions`
--

INSERT INTO `regions` (`id`, `region_name`) VALUES
(1, 'Arica y Parinacota'),
(2, 'Tarapacá'),
(3, 'Antofagasta'),
(4, 'Atacama'),
(5, 'Coquimbo'),
(6, 'Valparaíso'),
(7, 'Metropolitana de Santiago'),
(8, 'Libertador General Bernardo O\'Higgins'),
(9, 'Maule'),
(10, 'Ñuble'),
(11, 'Biobío'),
(12, 'Araucanía'),
(13, 'Los Ríos'),
(14, 'Los Lagos'),
(15, 'Aysén del General Carlos Ibáñez del Campo'),
(16, 'Magallanes y de la Antártica Chilena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_nickname` varchar(255) DEFAULT NULL,
  `rut` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `web` tinyint(1) DEFAULT NULL,
  `tv` tinyint(1) DEFAULT NULL,
  `social_media` tinyint(1) DEFAULT NULL,
  `friend` tinyint(1) DEFAULT NULL,
  `region_id` int(11) NOT NULL,
  `commune_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_nickname`, `rut`, `email`, `web`, `tv`, `social_media`, `friend`, `region_id`, `commune_id`, `candidate_id`) VALUES
(1, 'Felipe Romero Contreras', 'Felipe1', '172521584', 'dev.fromero@gmail.com', 1, 0, 0, 1, 14, 66, 10),
(2, 'Carmelina Arias', 'Carmela5', '55340285', 'carmelina@gmail.com', 0, 1, 1, 0, 3, 12, 16),
(3, 'Nora Pata', 'NoritaP7', '114092487', 'norap@gmail.com', 0, 1, 1, 0, 7, 34, 1),
(4, 'José Arriagada', 'JoséJosé15', '142552353', 'josea@gmail.com', 1, 1, 0, 0, 9, 42, 14),
(5, 'Lilian Mena Igor', 'Lilianita13', '127576297', 'lilianmena@gmail.com', 1, 0, 1, 0, 12, 58, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `communes`
--
ALTER TABLE `communes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indices de la tabla `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `commune_id` (`commune_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `communes`
--
ALTER TABLE `communes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `communes`
--
ALTER TABLE `communes`
  ADD CONSTRAINT `communes_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
