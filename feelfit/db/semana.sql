delimiter $$

CREATE TABLE `semana` (
  `dia` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

--
-- Volcado de datos para la tabla `semana`
--

INSERT INTO `semana` (`dia`, `nombre`) VALUES
(1, 'Domingo'),
(2, 'Lunes'),
(3, 'Martes'),
(4, 'Miercoles'),
(5, 'Jueves'),
(6, 'Viernes'),
(7, 'Sabado')$$
