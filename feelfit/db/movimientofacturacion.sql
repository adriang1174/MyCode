delimiter $$

CREATE TABLE `movimientofacturacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipomov` char(1) CHARACTER SET utf8 DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `importe` int(1) DEFAULT NULL,
  `idAlumno` int(11) DEFAULT NULL,
  `idTurno` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idInstructor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1078 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

