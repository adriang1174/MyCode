delimiter $$

CREATE TABLE `meses` (
  `nro` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`nro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1$$

--
-- Volcado de datos para la tabla `meses`
--

INSERT INTO `meses` (`nro`, `nombre`) VALUES
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo'),
(6, 'Junio'),
(7, 'Julio'),
(8, 'Agosto'),
(9, 'Setiembre'),
(10, 'Octubre'),
(11, 'Noviembre'),
(12, 'Diciembre')$$
